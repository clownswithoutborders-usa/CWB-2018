<?php

class TucCleaner {
	const ROWS_PER_SCAN = 1000;
	const MAX_EXECUTION_SECONDS = 10;

	public static function doCleaningStep() {
		global $wpdb;

		$startTime     = microtime( true );
		$maxTime       = ( (int) ini_get( 'max_execution_time' ) ) - 2;
		$maxTime       = $maxTime <= 0 ? TucCleaner::MAX_EXECUTION_SECONDS : min( TucCleaner::MAX_EXECUTION_SECONDS, $maxTime );
		$calculateOnly = $_POST['calculate_only'] === 'true';
		$startOver     = $_POST['start_over'] === 'true';

		// Check nonce.
		check_admin_referer( 'tuc-calculate-cleanup-size' );

		$fileManager = new TucFileManager();

		// Check cleaner progress.
		/* @var TucCleanerProgress $cleanerProgress */
		if ( $startOver ) {
			$cleanerProgress = null;
		} else {
			$cleanerProgress = self::getProgress( $fileManager );
		}

		// Have we just started?
		if ( $startOver || ! $cleanerProgress || get_class( $cleanerProgress ) !== 'TucCleanerProgress' ) {
			$cleanerProgress = new TucCleanerProgress();

			// Get all files from uploads directory.
			$cleanerProgress->filesToDelete                   = $fileManager->getFilesFromUploadFolder();
			$cleanerProgress->countOfFilesFoundInUploadFolder = count( $cleanerProgress->filesToDelete );

			// Get list of tables.
			$tablesToCleanUp = TucOptions::getTablesToCleanUp();
			foreach ( $tablesToCleanUp as $table ) {
				$cleanerProgress->tables[ $table ] = new TucCleanerTableToScan();
			}
			$cleanerProgress->tablesLeftToScan = array_keys( $cleanerProgress->tables );

			// Get estimated number of rows.
			$rows = $wpdb->get_results( "SELECT TABLE_ROWS, TABLE_NAME FROM information_schema.tables WHERE TABLE_SCHEMA = '" . DB_NAME . "' ", ARRAY_A );
			foreach ( $rows as $r ) {
				if ( ! array_key_exists( $r['TABLE_NAME'], $cleanerProgress->tables ) ) {
					continue;
				}

				$cleanerProgress->tables[ $r['TABLE_NAME'] ]->totalRows = (int) $r['TABLE_ROWS'];
			}

			// Save progress.
			$cleanerProgress->step = TucCleanerProgress::STEP_SCAN_MEDIA_GALLERY;
			self::saveProgress( $fileManager, $cleanerProgress );
		} else {
			switch ( $cleanerProgress->step ) {
				case TucCleanerProgress::STEP_SCAN_MEDIA_GALLERY:
					do {
						// Get files from the media gallery.
						$files = array();
						$count = $fileManager->getFilesFromMediaGallery( self::ROWS_PER_SCAN, $cleanerProgress->mediaGalleryOffset, $files );
						$cleanerProgress->countOfMediaGalleryItems += $count;

						// Substract files.
						$cleanerProgress->filesToDelete = self::substractFiles( $cleanerProgress->filesToDelete, $files );

						// Update progress.
						$cleanerProgress->mediaGalleryOffset += self::ROWS_PER_SCAN;
						self::saveProgress( $fileManager, $cleanerProgress );

						// Check time.
						if ( microtime( true ) - $startTime >= $maxTime ) {
							break;
						}
					} while ( $count == self::ROWS_PER_SCAN );

					if ( $count < self::ROWS_PER_SCAN ) {
						// Finish step.
						$cleanerProgress->step = TucCleanerProgress::STEP_SCAN_TABLES;
						self::saveProgress( $fileManager, $cleanerProgress );
					}

					break;

				case TucCleanerProgress::STEP_SCAN_TABLES:
					// Scan tables.
					while ( count( $cleanerProgress->tablesLeftToScan ) > 0 ) {
						$currentTable = $cleanerProgress->tablesLeftToScan[0];
						/* @var TucCleanerTableToScan $tableToScan */
						$tableToScan = $cleanerProgress->tables[ $currentTable ];

						// Fetch rows.
						$results = $wpdb->get_results( "SELECT * FROM " . esc_sql( $currentTable ) . " LIMIT " . esc_sql( $tableToScan->currentRow ) . ", " . TucCleaner::ROWS_PER_SCAN, ARRAY_N );

						// Get files from rows.
						$filesFromDatabase = array();
						$scannedRows       = 0;
						foreach ( $results as $result ) {
							$fileManager->getFilesFromDatabaseRow( $result, $filesFromDatabase );

							$scannedRows ++;

							// Check time.
							if ( microtime( true ) - $startTime >= $maxTime ) {
								break;
							}
						}

						$cleanerProgress->tables[ $currentTable ]->currentRow += $scannedRows;
						$cleanerProgress->countOfFilesFoundInDatabase += count( $filesFromDatabase );

						// See if there are any more rows.
						if ( $scannedRows === count( $results ) && count( $results ) < TucCleaner::ROWS_PER_SCAN ) {
							array_shift( $cleanerProgress->tablesLeftToScan );
						}

						// Substract files.
						$cleanerProgress->filesToDelete = self::substractFiles( $cleanerProgress->filesToDelete, $filesFromDatabase );

						// Check if this was the last table.
						if ( count( $cleanerProgress->tablesLeftToScan ) == 0 ) {
							if ( $calculateOnly ) {
								$cleanerProgress->step = TucCleanerProgress::STEP_GET_SIZE_OF_FILES;
							} else {
								$cleanerProgress->step = TucCleanerProgress::STEP_SOFT_DELETE_FILES;
							}
						}

						// Save progress.
						self::saveProgress( $fileManager, $cleanerProgress );

						// Check time.
						if ( microtime( true ) - $startTime >= $maxTime ) {
							break;
						}
					}
					break;

				case TucCleanerProgress::STEP_GET_SIZE_OF_FILES :
					// Get size of files.
					$cleanerProgress->sizeOfFiles = $fileManager->getSizeOfFiles( $cleanerProgress->filesToDelete );

					// Update progress.
					$cleanerProgress->step = TucCleanerProgress::STEP_DONE;
					self::clearProgress( $fileManager );
					break;

				case TucCleanerProgress::STEP_SOFT_DELETE_FILES :
					if ( count( $cleanerProgress->filesToDelete ) > 0 ) {
						// Move files to new backup folder.
						$backupFolder = $fileManager->createNewBackupFolder();
						$fileManager->moveUploadedFilesToFolder( $cleanerProgress->filesToDelete, $backupFolder );

						// Get backup size.
						$cleanerProgress->sizeOfFiles = $fileManager->getFolderSize( $backupFolder );
					} else {
						$cleanerProgress->sizeOfFiles = 0;
					}

					// Update progress.
					$cleanerProgress->step = TucCleanerProgress::STEP_DONE;
					self::clearProgress( $fileManager );
					break;
			}
		}

		// Return result.
		{
			$result = array(
				'step' => $cleanerProgress->step
			);

			// Size of files
			if ( $cleanerProgress->sizeOfFiles !== null ) {
				$result['sizeOfFiles'] = $fileManager->getHumanSize( $cleanerProgress->sizeOfFiles ) . ' (' . count( $cleanerProgress->filesToDelete ) . ' files)';
			}

			// Statistics
			$result['countOfFilesFoundInUploadFolder'] = $cleanerProgress->countOfFilesFoundInUploadFolder;
			$result['countOfMediaGalleryItems']        = $cleanerProgress->countOfMediaGalleryItems;
			$result['countOfFilesFoundInDatabase']     = $cleanerProgress->countOfFilesFoundInDatabase;

			switch ( $cleanerProgress->step ) {
				case TucCleanerProgress::STEP_SCAN_MEDIA_GALLERY:
					$result['currentRow'] = $cleanerProgress->mediaGalleryOffset;
					break;

				case TucCleanerProgress::STEP_SCAN_TABLES:
					reset( $cleanerProgress->tables );

					/* @var TucCleanerTableToScan $tableToScan */
					$tableToScan = $cleanerProgress->tables[ $cleanerProgress->tablesLeftToScan[0] ];

					$result['currentRow']   = max( 1, $tableToScan->currentRow ) . ' / ' . $tableToScan->totalRows . ' (approx.)';
					$result['currentTable'] =
						$cleanerProgress->tablesLeftToScan[0] . ' (' .
						( 1 + count( $cleanerProgress->tables ) - count( $cleanerProgress->tablesLeftToScan ) ) . ' / ' .
						count( $cleanerProgress->tables ) . ')';

					// Get progress.
					$scannedRows = 0;
					$totalRows   = 0;
					/* @var TucCleanerTableToScan $tableToScan */
					foreach ( $cleanerProgress->tables as $tableToScan ) {
						// There might be more rows than total estimated rows.
						$scannedRows += min( $tableToScan->currentRow, $tableToScan->totalRows );
						$totalRows += $tableToScan->totalRows;
					}
					$result['percentage'] = ( ( $totalRows > 0 ) ? ( $scannedRows / $totalRows ) : 1 ) * 100;
					break;
			}
		}

		return $result;
	}

	/**
	 * Get a randomly generated progress file name.
	 * Otherwise anyone could access this file as it is saved publicly in the wp-content/uploads folder.
	 *
	 * @param TucFileManager $fileManager
	 *
	 * @return string
	 */
	protected static function getProgressFile( TucFileManager $fileManager ) {
		$key = 'theia-upload-cleaner-progress-file';

		$value = get_option( $key );
		if ( ! $value ) {
			$value = wp_generate_password( 24, false );
			update_option( $key, $value );
		}

		return $fileManager->getBackupFolder() . '/progress-' . $value;
	}

	/**
	 * @param TucFileManager $fileManager
	 *
	 * @return TucCleanerProgress|null
	 */
	protected static function getProgress( TucFileManager $fileManager ) {
		// Get file contents.
		@$contents = file_get_contents( self::getProgressFile( $fileManager ) );
		if ( $contents === false ) {
			return null;
		}

		// Unserialize into a TucCleanerProgress object.
		@$progress = unserialize( $contents );

		return $progress;
	}

	protected static function saveProgress( TucFileManager $fileManager, TucCleanerProgress $cleanerProgress ) {
		// Serialize progress.
		@$contents = serialize( $cleanerProgress );

		// Save to file.
		@file_put_contents( self::getProgressFile( $fileManager ), $contents );
	}

	protected static function clearProgress( TucFileManager $fileManager ) {
		@unlink( self::getProgressFile( $fileManager ) );
	}

	protected static function substractFiles( $minuend, $subtrahend ) {
		return array_values( array_diff( $minuend, $subtrahend ) );
	}
}