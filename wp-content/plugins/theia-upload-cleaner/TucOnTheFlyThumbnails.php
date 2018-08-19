<?php

add_filter( 'image_downsize', 'TucOnTheFlyThumbnails::image_downsize', - 100, 4 );
add_filter( 'intermediate_image_sizes', 'TucOnTheFlyThumbnails::intermediate_image_sizes', - 100, 1 );

class TucOnTheFlyThumbnails {
	public static $sizeOverride = null;

	public static function image_downsize( $result, $id, $size ) {
		require_once( ABSPATH . 'wp-admin/includes/image.php' );

		if ( ! is_string( $size ) ) {
			return $result;
		}

		// Check if file already exists.
		$metadata = wp_get_attachment_metadata( $id );
		if (
			is_array( $metadata ) &&
			array_key_exists( 'sizes', $metadata ) &&
			is_array( $metadata['sizes'] ) &&
			array_key_exists( $size, $metadata['sizes'] )
		) {
			$pathinfo  = pathinfo( $metadata['file'] );
			$uploadDir = wp_upload_dir();
			$file      = $uploadDir['basedir'] . '/' . $pathinfo['dirname'] . '/' . $metadata['sizes'][ $size ]['file'];

			if ( file_exists( $file ) ) {
				return $result;
			} else {
				// If the original file doesn't exist either, don't try to regenerate the thumbnails.
				$originalFile = $uploadDir['basedir'] . '/' . $metadata['file'];
				if ( ! file_exists( $originalFile ) ) {
					return $result;
				}
			}
		} else {
			return $result;
		}

		// Generate thumbnail.
		$fullsizepath       = get_attached_file( $id );
		self::$sizeOverride = $size;
		$newMetadata        = wp_generate_attachment_metadata( $id, $fullsizepath );
		self::$sizeOverride = null;

//		if ( is_wp_error( $metadata ) ) {
//			echo $metadata->get_error_message();
//		}
//		if ( empty( $metadata ) ) {
//			echo 'Unknown error.';
//		}

//		wp_update_attachment_metadata( $id, $metadata );

		return $result;
	}

	public static function intermediate_image_sizes( $image_sizes ) {
		if ( null === self::$sizeOverride ) {
			return $image_sizes;
		}

		$image_sizes = array( self::$sizeOverride );

		return $image_sizes;
	}
}