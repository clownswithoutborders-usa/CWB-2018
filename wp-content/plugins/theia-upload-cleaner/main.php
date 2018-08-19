<?php
/*
Plugin Name: Theia Upload Cleaner
Plugin URI: http://wecodepixels.com/products/theia-upload-cleaner-for-wordpress/?utm_source=theia-upload-cleaner
Description: Safely cleans unused files from your upload folder. Makes complete backups that can be restored at any time.
Author: WeCodePixels
Author URI: http://wecodepixels.com/?utm_source=theia-upload-cleaner
Version: 1.3.0
Copyright: WeCodePixels
*/

/*
 * Copyright 2016, Theia Upload Cleaner, WeCodePixels, http://wecodepixels.com
 */

/*
 * Plugin version. Used to forcefully invalidate CSS and JavaScript caches by appending the version number to the
 * filename (e.g. "style.css?ver=TUC_VERSION").
 */
define( 'TUC_VERSION', '1.3.0' );

// Include other files.
include( dirname( __FILE__ ) . '/TucMisc.php' );
include( dirname( __FILE__ ) . '/TucAdmin.php' );
include( dirname( __FILE__ ) . '/TucFileManager.php' );
include( dirname( __FILE__ ) . '/TucCleaner.php' );
include( dirname( __FILE__ ) . '/TucCleanerAjax.php' );
include( dirname( __FILE__ ) . '/TucCleanerProgress.php' );
include( dirname( __FILE__ ) . '/TucCleanerTableToScan.php' );
include( dirname( __FILE__ ) . '/TucOnTheFlyThumbnails.php' );
include( dirname( __FILE__ ) . '/TucOptions.php' );
