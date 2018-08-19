<?php

add_action( 'init', 'TucOptions::init' );

class TucOptions {
	public static function get( $optionId ) {
		$groups = array( 'tuc_dashboard', 'tuc_general' );
		foreach ( $groups as $groupId ) {
			$options = get_option( $groupId );
			if ( ! is_array( $options ) ) {
				continue;
			}

			if ( array_key_exists( $optionId, $options ) ) {
				return $options[ $optionId ];
			}
		}

		return null;
	}

	public static function init() {
		$defaults = array(
			'tuc_dashboard' => array(),
			'tuc_general'   => array(
				'clean_thumbnails' => false,
				'excluded_sizes'   => array( 'thumbnail', 'medium', 'large' ),
				'excluded_folders' => array(),
				'excluded_tables'  => array()
			)
		);

		$overwrites = array(
			'tuc_dashboard' => array(),
			'tuc_general'   => array()
		);

		// Transfer multiple selects for excluded sizes.
		$excludedSizes = get_option( 'tuc_general_excluded_sizes' );
		if ( $excludedSizes !== false ) {
			// In case the user did not select anything to exclude, use an empty array.
			$excludedSizes = array_diff( $excludedSizes, array( '' ) );

			$overwrites['tuc_general']['excluded_sizes'] = $excludedSizes;
			delete_option( 'tuc_general_excluded_sizes' );
		}

		// Transfer multiple selects for excluded tables.
		$excludedTables = get_option( 'tuc_general_excluded_tables' );
		if ( $excludedTables !== false ) {
			// In case the user did not select anything to exclude, use an empty array.
			$excludedTables = array_diff( $excludedTables, array( '' ) );

			$overwrites['tuc_general']['excluded_tables'] = $excludedTables;
			delete_option( 'tuc_general_excluded_tables' );
		}

		$excludedFolders = get_option( 'tuc_general_excluded_folders' );
		if ( $excludedFolders !== false ) {
			$excludedFolders = json_decode( $excludedFolders );
			if ( ! is_array( $excludedFolders ) ) {
				$excludedFolders = array();
			}

			// In case the user did not select anything to exclude, use an empty array.
			$excludedFolders = array_diff( $excludedFolders, array( '' ) );

			$overwrites['tuc_general']['excluded_folders'] = $excludedFolders;
			delete_option( 'tuc_general_excluded_folders' );
		}

		// Sanitize, validate.
		foreach ( $defaults as $groupId => $groupValues ) {
			$options = get_option( $groupId );

			if ( ! is_array( $options ) ) {
				$options = array();
				$changed = true;
			} else {
				$changed = false;
			}

			// Add missing options.
			foreach ( $groupValues as $key => $value ) {
				if ( isset( $options[ $key ] ) == false ) {
					$changed         = true;
					$options[ $key ] = $value;
				}
			}

			// Remove surplus options.
			foreach ( $options as $key => $value ) {
				if ( isset( $defaults[ $groupId ][ $key ] ) == false ) {
					$changed = true;
					unset( $options[ $key ] );
				}
			}

			// Overwrite options.
			if ( array_key_exists( $groupId, $overwrites ) ) {
				foreach ( $overwrites[ $groupId ] as $overwriteKey => $overwriteValue ) {
					$options[ $overwriteKey ] = $overwriteValue;
					$changed                  = true;
				}
			}

			// Sanitize options.
			foreach ( $options as $key => $value ) {
				if ( is_bool( $defaults[ $groupId ][ $key ] ) ) {
					$options[ $key ] = ( $options[ $key ] === true || $options[ $key ] === 'true' ) ? true : false;
					$changed         = true;
				}

				if ( is_array( $defaults[ $groupId ][ $key ] ) ) {
					$options[ $key ] = is_array( $options[ $key ] ) ? $options[ $key ] : $defaults[ $groupId ][ $key ];
					$changed         = true;
				}
			}
			// Save options.
			if ( $changed ) {
				update_option( $groupId, $options );
			}
		}
	}

	/**
	 * Get database tables to be used for cleanup.
	 *
	 * @return array
	 */
	public static function getTablesToCleanUp() {
		return array_diff( self::getAllTables(), self::get( 'excluded_tables' ) );
	}

	/**
	 * Get all database tables, excluding blacklisted ones.
	 *
	 * @return array
	 */
	public static function getAllTables() {
		global $wpdb;

		$keywordBlacklist = self::getKeywordBlacklistForTables();
		$tables           = $wpdb->get_results( "SHOW TABLES", ARRAY_N );
		$filteredTables   = array();

		// Exclude blacklisted tables.
		foreach ( $tables as $table ) {
			$table = $table[0];

			// Check if table contains blacklisted keyword.
			foreach ( $keywordBlacklist as $keyword ) {
				if ( strpos( $table, $keyword ) !== false ) {
					continue 2;
				}
			}

			$filteredTables[] = $table;
		}

		return $filteredTables;
	}

	/**
	 * Get keyword blacklist for database tables.
	 *
	 * @return array
	 */
	public static function getKeywordBlacklistForTables() {
		$keywordBlacklist = array(
			'_stats',
			'stats_',
			'_statistics',
			'statistics_',
			'_log',
			'log_',
			'_analytics',
			'analytics_',
			'ewwwio_images', // EWWW Image Optimizer plugin
			'captcha_bank_block_range_ip', // Captcha Bank plugin
			'relevanssi' // Relevanssi Search plugin
		);

		return $keywordBlacklist;
	}
}