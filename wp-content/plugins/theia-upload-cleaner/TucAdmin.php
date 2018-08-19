<?php

/*
 * Copyright 2016, Theia Upload Cleaner, WeCodePixels, http://wecodepixels.com
 */

add_action( 'admin_init', 'TucAdmin::admin_init' );
add_action( 'admin_menu', 'TucAdmin::admin_menu' );

class TucAdmin {
	public static function admin_init() {
		register_setting( 'tuc_options_dashboard', 'tuc_dashboard', 'TucAdmin::validate' );
		register_setting( 'tuc_options_general', 'tuc_general', 'TucAdmin::validate' );
		register_setting( 'tuc_options_general', 'tuc_general_excluded_sizes', 'TucAdmin::validate' );
		register_setting( 'tuc_options_general', 'tuc_general_excluded_tables', 'TucAdmin::validate' );
		register_setting( 'tuc_options_general', 'tuc_general_excluded_folders', 'TucAdmin::validate' );
	}

	public static function admin_menu() {
		add_options_page( 'Theia Upload Cleaner Settings', 'Theia Upload Cleaner ', 'manage_options', 'tuc', 'TucAdmin::do_page' );
	}

	public static function do_page() {
		$tabs = array(
			'dashboard' => array(
				'title' => __( "Dashboard", 'theia-upload-cleaner' ),
				'class' => 'Dashboard'
			),
			'general' => array(
				'title' => __( "General", 'theia-upload-cleaner' ),
				'class' => 'General'
			),
			'cleanup'   => array(
				'title' => __( "Cleanup", 'theia-upload-cleaner' ),
				'class' => 'Cleanup'
			),
			'backups'   => array(
				'title' => __( "Backups", 'theia-upload-cleaner' ),
				'class' => 'Backups'
			)
		);
		if ( array_key_exists( 'tab', $_GET ) && array_key_exists( $_GET['tab'], $tabs ) ) {
			$current_tab = $_GET['tab'];
		} else {
			$current_tab = 'dashboard';
		}
		?>

		<div class="wrap">
			<a class="theiaUploadCleaner_adminLogo"
			   href="http://wecodepixels.com/?utm_source=theia-upload-cleaner-for-wordpress"
			   target="_blank"><img src="<?php echo plugins_url( '/images/wecodepixels-logo.png', __FILE__ ); ?>"></a>

			<h2 class="theiaUploadCleaner_adminTitle">
				<a href="http://wecodepixels.com/products/theia-upload-cleaner-for-wordpress/?utm_source=theia-upload-cleaner-for-wordpress"
				   target="_blank"><img src="<?php echo plugins_url( '/images/theia-upload-cleaner-thumbnail.png', __FILE__ ); ?>"></a>
				Theia Upload Cleaner
			</h2>

			<h2 class="nav-tab-wrapper">
				<?php
				foreach ( $tabs as $id => $tab ) {
					$class = 'nav-tab';
					if ( $id == $current_tab ) {
						$class .= ' nav-tab-active';
					}
					?>
					<a href="?page=tuc&tab=<?php echo $id; ?>"
					   class="<?php echo $class; ?>"><?php echo $tab['title']; ?></a>
				<?php
				}
				?>
			</h2>
			<?php
			$class = 'TucAdmin_' . $tabs[ $current_tab ]['class'];
			require $class . '.php';
			$page = new $class;
			$page->echoPage();
			?>
		</div>
	<?php
	}

	public static function validate( $input ) {
		return $input;
	}
}