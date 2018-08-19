<?php

/*
 * Copyright 2016, Theia Upload Cleaner, WeCodePixels, http://wecodepixels.com
 */

add_action( 'admin_enqueue_scripts', 'TucMisc::admin_enqueue_scripts' );
add_filter( 'plugin_action_links_' . plugin_basename( dirname( __FILE__ ) . '/main.php' ), 'TucMisc::plugin_action_links' );

class TucMisc {
	public static function admin_enqueue_scripts() {
		wp_register_style( 'theiaUploadCleaner-admin', plugins_url( 'css/admin.css', __FILE__ ), TUC_VERSION );
		wp_enqueue_style( 'theiaUploadCleaner-admin' );

		wp_register_script( 'theiaUploadCleaner-progressbar.js', plugins_url( 'bower_components/progressbar.js/dist/progressbar.min.js', __FILE__ ), TUC_VERSION );
		wp_enqueue_script( 'theiaUploadCleaner-progressbar.js' );

		wp_register_script( 'theiaUploadCleaner-jstree.js', plugins_url( 'bower_components/jstree/dist/jstree.min.js', __FILE__ ), TUC_VERSION );
		wp_enqueue_script( 'theiaUploadCleaner-jstree.js' );

		wp_register_style( 'theiaUploadCleaner-jstree.css', plugins_url( 'bower_components/jstree/dist/themes/default/style.min.css', __FILE__ ), TUC_VERSION );
		wp_enqueue_style( 'theiaUploadCleaner-jstree.css' );
	}

	public static function plugin_action_links( $links ) {
		$mylinks = array(
			'<a href="' . admin_url( 'options-general.php?page=tuc' ) . '">Settings</a>',
		);

		return array_merge( $mylinks, $links );
	}
}
