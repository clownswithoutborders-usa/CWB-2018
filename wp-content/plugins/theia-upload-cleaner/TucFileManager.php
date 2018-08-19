<?php

/*
 * Copyright 2016, Theia Upload Cleaner, WeCodePixels, http://wecodepixels.com
 */

add_action( 'wp_ajax_getUploadSubfolders', 'TucFileManager::getUploadSubfolders' );

class TucFileManager {
	// When scanning arrays, we use this property to flag recursive references.
	protected $skipProperty = '___tucSkip';
	protected $uploadDirBaseurls;
	protected $uploadDirBasedir;

	public function __construct() {
		$uploadDir              = wp_upload_dir();
		$this->uploadDirBasedir = $uploadDir ['basedir'];

		// Store baseurl using the default value (in case of weird unparsable URLs),
		// but also as both http and https in order to match files after moving from http to https or vice-versa.
		{
			$this->uploadDirBaseurls = array( $uploadDir ['baseurl'] );
			$url                     = parse_url( $uploadDir ['baseurl'] );
			if ( is_array( $url ) && array_key_exists( 'host', $url ) && array_key_exists( 'path', $url ) ) {
				$this->uploadDirBaseurls[] = 'http://' . $url ['host'] . $url['path'];
				$this->uploadDirBaseurls[] = 'https://' . $url ['host'] . $url['path'];
			}
			$this->uploadDirBaseurls = array_unique( $this->uploadDirBaseurls );
		}
	}

	protected function isPathFromUploadDir( $path ) {
		if ( substr( $path, 0, strlen( $this->uploadDirBasedir ) ) == $this->uploadDirBasedir ) {
			return true;
		}

		return false;
	}

	protected function isUrlFromUploadDir( $url ) {
		foreach ( $this->uploadDirBaseurls as $baseurl ) {
			if ( substr( $url, 0, strlen( $baseurl ) ) == $baseurl ) {
				return true;
			}
		}

		return false;
	}

	protected function convertUrlToPathFromUploadDir( $url ) {
		// Replace baseurl with basedir.
		$path = null;
		foreach ( $this->uploadDirBaseurls as $baseurl ) {
			if ( substr( $url, 0, strlen( $baseurl ) ) == $baseurl ) {
				$path = str_replace( $baseurl, $this->uploadDirBasedir, $url );
				break;
			}
		}

		// Remove query string.
		$pos = strpos( $path, '?' );
		if ( $pos !== false ) {
			$path = substr( $path, 0, $pos );
		}

		return $path;
	}

	// Get URLs or paths from any data (array, classes, etc.).
	protected function getFilesFromData( $data, &$files ) {
		if ( $data === null ) {
			return;
		}

		// Shouldn't ever encounter an object since we convert them to arrays before unserializing them, but just in case.
		if ( is_object( $data ) ) {
			// Cast object to array, including protected/private members.
			$data = (array) ( $data );
		}

		if ( is_array( $data ) ) {
			// Have we scanned this before? Then it's a recursive reference and we should stop.
			if ( array_key_exists( $this->skipProperty, $data ) ) {
				return;
			}

			foreach ( $data as $key => $el ) {
				if ( is_array( $el ) ) {
					// Mark this array with a property to prevent recursive references.
					$el[ $this->skipProperty ] = true;
				}

				$this->getFilesFromData( $el, $files );
			}
		} else if ( is_string( $data ) ) {
			if ( $this->isUrlFromUploadDir( $data ) ) {
				$files[] = $this->convertUrlToPathFromUploadDir( $data );
			} else if ( $this->isPathFromUploadDir( $data ) ) {
				$files[] = $data;
			} else {
				// Consider it a plain-text or HTML that might contain URLs. Look for the upload folder's URL.
				foreach ( $this->uploadDirBaseurls as $baseurl ) {
					$pos = - 1;
					while ( ( $pos = strpos( $data, $baseurl, $pos + 1 ) ) !== false ) {
						// Get URL using a regular expression. Courtesy of http://stackoverflow.com/questions/1547899/which-characters-make-a-url-invalid#comment10512338_1547940
						$matches = array();
						preg_match( '/^([!#$&-;=?-\[\]_a-z~]|%[0-9a-fA-F]{2})+/', substr( $data, $pos ), $matches );
						if ( count( $matches ) > 0 ) {
							$files[] = $this->convertUrlToPathFromUploadDir( $matches[0] );
						}
					}
				}
			}
		}
	}

	public function getFilesFromDatabaseRow( $row, &$files ) {
		// Get each cell.
		foreach ( $row as $key => $value ) {
			$jsonData = json_decode( $value, true );

			// Check for JSON data.
			if ( $jsonData !== null ) {
				$this->getFilesFromData( $jsonData, $files );

				continue;
			}

			// Check for Serialize data.
			if ( is_serialized( $value ) ) {
				// Convert objects to simple arrays as to not call their constructors.
				// Note that this is a naive approach and might invalidate the value.
				$value = preg_replace( "/(O:[0-9]+:\".+?\"):/s", "a:", $value );

				@$serializedData = unserialize( $value );
				if ( false !== $serializedData ) {
					$this->getFilesFromData( $serializedData, $files );

					continue;
				}
			}

			// Check for any data.
			$this->getFilesFromData( $value, $files );
		}
	}

	/**
	 * @param $numberOfFiles
	 * @param $offset
	 * @param array $files
	 *
	 * @return int|void Number of query results.
	 */
	public function getFilesFromMediaGallery( $numberOfFiles, $offset, array &$files ) {
		$files             = array();
		$query_images_args = array(
			'post_type'      => 'attachment',
			'post_status'    => 'inherit',
			'posts_per_page' => $numberOfFiles,
			'offset'         => $offset
		);
		$query_images      = new WP_Query( $query_images_args );

		foreach ( $query_images->posts as $image ) {
			$attachedFile  = get_post_meta( $image->ID, '_wp_attached_file', true );
			$attachedImage = get_post_meta( $image->ID, '_wp_attachment_metadata', true );

			// Continue if no file is attached.
			if ( ! $attachedFile || ! $attachedImage ) {
				continue;
			}

			// Remove absolute uploads path.
			if ( substr( $attachedFile, 0, strlen( $this->uploadDirBasedir ) ) == $this->uploadDirBasedir ) {
				$attachedFile = substr( $attachedFile, strlen( $this->uploadDirBasedir ) );

				// Remove starting slash.
				$attachedFile = trim( $attachedFile, '/' );
			}

			// Add thumbnails.
			$shouldGenerateThumbnailsOnTheFly = TucOptions::get('clean_thumbnails');
			$sizesToExcludeFromCleaning = TucOptions::get('excluded_sizes');
			if ( is_array( $attachedImage ) && array_key_exists( 'sizes', $attachedImage ) && $attachedImage['sizes'] ) {
				foreach ( $attachedImage['sizes'] as $size => $sizeData ) {
					if ( $shouldGenerateThumbnailsOnTheFly === false || in_array( $size, $sizesToExcludeFromCleaning ) ) {
						$file    = dirname( $attachedFile ) . '/' . $sizeData['file'];
						$files[] = $this->uploadDirBasedir . '/' . $file;
					}
				}
			}

			// Add original image.
			$files[] = $this->uploadDirBasedir . '/' . $attachedFile;
		}

		// Clear any cache saved in-memory by WP_Query or get_post_meta. Otherwise we risk running out of memory.
		wp_cache_flush();

		return count( $query_images->posts );
	}

	public function getFilesFromUploadFolder() {
		$files           = array();
		$excludedFolders = $this->getExcludedUploadFolders();

		$objects = new RecursiveIteratorIterator( new RecursiveDirectoryIterator( $this->uploadDirBasedir ) );
		foreach ( $objects as $name => $object ) {
			// Check if this is a file.
			if ( ! $object->isFile() ) {
				continue;
			}

			// Check if this file belongs to an excluded folder.
			foreach ( $excludedFolders as $excludedFolder ) {
				if ( substr( $name, 0, strlen( $excludedFolder ) ) === $excludedFolder ) {
					continue 2;
				}
			}

			// Add file.
			$files[] = $name;
		}

		return $files;
	}

	// Get excluded system folders that the user cannot under no circumstance opt-in to clean.
	public function getSystemExcludedUploadFolders() {
		$excludedFolders = array();

		$excludedFolders[] = $this->getBackupFolder();

		// Skip upload folders from other subsites.
		// i.e. Skip files that belong to other sites in a multisite network.
		if ( is_multisite() ) {
			$currentBlogId = get_current_blog_id();
			$sites         = wp_get_sites();
			foreach ( $sites as $site ) {
				$blogId = absint( $site['blog_id'] );

				// Skip current subsites.
				if ( $currentBlogId === $blogId ) {
					continue;
				}

				// Get upload folder.
				switch_to_blog( $blogId );
				$uploadDirBasedir = wp_upload_dir();
				$uploadDirBasedir = $uploadDirBasedir['basedir'];
				restore_current_blog();

				// Skip if this is a parent folder.
				if ( strlen( $uploadDirBasedir ) < strlen( $this->uploadDirBasedir ) ) {
					continue;
				}

				$excludedFolders[] = $uploadDirBasedir;
			}
		}



		return $excludedFolders;
	}

	// Get excluded folders, including the ones chosen by the user through the admin panel.
	public function getExcludedUploadFolders() {
		$excludedFolders = $this->getSystemExcludedUploadFolders();

		$excludedbyUser = TucOptions::get('excluded_folders' );
		foreach ( $excludedbyUser as $excluded ) {
			$excludedFolders[] = $this->uploadDirBasedir . $excluded;
		}

		return $excludedFolders;
	}

	public function getUploadTree( $file, &$folders, $baseDirLength ) {
		$excludedFolders = $this->getSystemExcludedUploadFolders();
		$dir             = new DirectoryIterator( $file );

		foreach ( $dir as $fileinfo ) {
			if ( $fileinfo->isDir() && ! $fileinfo->isDot() ) {
				// Check if this file belongs to an excluded folder.
				foreach ( $excludedFolders as $excludedFolder ) {
					if ( substr( $fileinfo->getPathname(), 0, strlen( $excludedFolder ) ) === $excludedFolder ) {
						continue 2;
					}
				}

				$f = array(
					'id'       => substr( $fileinfo->getPathname(), $baseDirLength ),
					'text'     => $fileinfo->getFilename(),
					'children' => array()
				);

				$this->getUploadTree( $fileinfo->getPathname(), $f['children'], $baseDirLength );

				if ( count( $f['children'] ) == 0 ) {
					unset( $f['children'] );
				}

				$folders[] = $f;
			}
		}

		return $folders;
	}

	public static function getUploadSubfolders() {
		$uploadDir     = wp_upload_dir();
		$baseDir       = $uploadDir['basedir'];
		$folders       = array();
		$baseDirLength = strlen( $baseDir );

		$fileManager = new TucFileManager();
		$folderList  = $fileManager->getUploadTree( $baseDir, $folders, $baseDirLength );

		echo json_encode( $folderList );
		die();
	}

	public function getBackupFolder() {
		$dirPath = $this->uploadDirBasedir . '/theia-upload-cleaner-backups';

		if ( ! is_dir( $dirPath ) ) {
			mkdir( $dirPath );
		}

		return $dirPath;
	}

	// Courtesy of http://stackoverflow.com/questions/478121/php-get-directory-size/8348396#8348396
	public function getFolderSize( $path ) {
		$bytestotal = 0;

		try {
			$path = realpath( $path );
			if ( $path !== false ) {
				foreach ( new RecursiveIteratorIterator( new RecursiveDirectoryIterator( $path, FilesystemIterator::SKIP_DOTS ) ) as $object ) {
					$bytestotal += $object->getSize();
				}
			}
		} catch ( Exception $e ) {
			return $bytestotal;
		}

		return $bytestotal;
	}

	public function getHumanSize( $bytes, $decimals = 2 ) {
		$size   = array( 'B', 'kB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB' );
		$factor = max( 0, (int) floor( ( strlen( $bytes ) - 1 ) / 3 ) );

		return sprintf( "%.{$decimals}f", $bytes / pow( 1024, $factor ) ) . ' ' . $size[ $factor ];
	}

	/**
	 * @param $files array
	 *
	 * @return int
	 */
	public function getSizeOfFiles( $files ) {
		$size = 0;

		foreach ( $files as $file ) {
			$size += filesize( $file );
		}

		return $size;
	}

	public function moveUploadedFilesToFolder( $files, $folder ) {
		$this->moveFilesToFolderWithBase( $files, $folder, $this->uploadDirBasedir );
	}

	/**
	 * Move all files inside a new folder, while maintaining the same folder structure.
	 *
	 * @param $files array Files to move, must all reside inside the $baseFolder.
	 * @param $folder string Destination folder.
	 * @param $baseFolder string Base folder that contains all files to be moved.
	 */
	protected function moveFilesToFolderWithBase( $files, $folder, $baseFolder ) {
		$folders = array();

		foreach ( $files as $file ) {
			$srcWithoutUploadDir        = substr( $file, strlen( $baseFolder ) );
			$srcDirnameWithoutUploadDir = dirname( $srcWithoutUploadDir );
			$destDirname                = $folder . $srcDirnameWithoutUploadDir;

			// Create identical folder structure.
			if ( ! is_dir( $destDirname ) ) {
				mkdir( $destDirname, 0777, true );
			}

			// Copy file.
			rename( $file, $folder . $srcWithoutUploadDir );

			// Create hash with folders.
			$folders[ dirname( $file ) ] = true;
		}

		foreach ( $folders as $path => $value ) {
			$this->removeEmptyFolders( $path, $baseFolder );
		}
	}

	public function removeEmptyFolders( $path, $baseFolder ) {
		try {
			$isDirEmpty = new \FilesystemIterator( $path );
			$isDirEmpty = ! $isDirEmpty->valid();
		} catch ( Exception $e ) {
			return false;
		}

		if ( $isDirEmpty ) {
			rmdir( $path );

			if ( dirname( $path ) === $baseFolder ) {
				return false;
			}

			$this->removeEmptyFolders( dirname( $path ), $baseFolder );
		}

		return false;
	}

	public function createNewBackupFolder() {
		$backupFolder = $this->getBackupFolder();
		$backupFolder .= '/' . date( 'Y-m-d___H-i-s' );
		mkdir( $backupFolder );

		return $backupFolder;
	}

	public function restoreBackup( $backupName ) {
		$backupFolder     = $this->getBackupFolder();
		$thisBackupFolder = $backupFolder . '/' . $backupName;
		if ( ! is_dir( $thisBackupFolder ) ) {
			return;
		}

		// Get all files.
		$dirIt = new RecursiveDirectoryIterator( $thisBackupFolder, RecursiveDirectoryIterator::SKIP_DOTS );
		$itIt  = new RecursiveIteratorIterator( $dirIt, RecursiveIteratorIterator::CHILD_FIRST );
		$files = array();
		foreach ( $itIt as $name => $object ) {
			// Check if this is a file.
			if ( ! $object->isFile() ) {
				continue;
			}

			$files[] = $name;
		}

		// Move files.
		$this->moveFilesToFolderWithBase( $files, $this->uploadDirBasedir, $thisBackupFolder );

		rmdir( $thisBackupFolder );
	}

	public function deleteBackup( $backupName ) {
		$thisBackupFolder = $this->getBackupFolder() . '/' . $backupName;
		if ( ! is_dir( $thisBackupFolder ) ) {
			return;
		}

		$dirIt = new RecursiveDirectoryIterator( $thisBackupFolder, RecursiveDirectoryIterator::SKIP_DOTS );
		$itIt  = new RecursiveIteratorIterator( $dirIt, RecursiveIteratorIterator::CHILD_FIRST );
		foreach ( $itIt as $file ) {
			if ( $file->isDir() ) {
				rmdir( $file->getRealPath() );
			} else {
				unlink( $file->getRealPath() );
			}
		}
		rmdir( $thisBackupFolder );
	}
}
