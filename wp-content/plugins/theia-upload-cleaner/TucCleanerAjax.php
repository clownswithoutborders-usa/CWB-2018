<?php

add_action( 'wp_ajax_tuc_clean', 'TucCleanerAjax::wp_ajax_tuc_clean' );

class TucCleanerAjax {
	public static function wp_ajax_tuc_clean() {
		if ( $_SERVER['REQUEST_METHOD'] !== 'POST' ) {
			return;
		}

		register_shutdown_function( 'TucCleanerAjax::shutdownFunction' );

		$result = TucCleaner::doCleaningStep();

		header( 'Content-Type: application/json' );
		echo json_encode( $result );

		die();
	}

	public static function shutdownFunction() {
		$error  = error_get_last();
		$eFatal = E_ERROR | E_USER_ERROR | E_PARSE | E_CORE_ERROR | E_COMPILE_ERROR | E_RECOVERABLE_ERROR;

		if ( $error && ( $error['type'] & $eFatal ) ) {
			self::errorHandler( $error['type'], $error['message'], $error['file'], $error['line'] );
		}
	}

	protected static function errorHandler( $errno, $errstr, $errfile, $errline ) {
		if ( ! $errno ) {
			return;
		}

		$result = array(
			'errno'   => $errno,
			'errname' => self::getErrorName( $errno ),
			'errstr'  => $errstr,
			'errfile' => $errfile,
			'errline' => $errline
		);

		header( 'Content-Type: application/json' );
		echo json_encode( $result );
	}

	protected static function getErrorName( $errorNumber ) {
		$defines = get_defined_constants( true );
		$defines = $defines['Core'];

		foreach ( $defines as $key => $value ) {
			if ( $value == $errorNumber ) {
				return $key;
			}
		}

		return 'UNKNOWN ERROR';
	}
}