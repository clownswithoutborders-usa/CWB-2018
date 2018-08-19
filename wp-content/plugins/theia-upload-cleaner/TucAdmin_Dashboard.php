<?php

/*
 * Copyright 2016, Theia Upload Cleaner, WeCodePixels, http://wecodepixels.com
 */

class TucAdmin_Dashboard {
	public $showPreview = true;

	public function echoPage() {
		?>
		<form method="post" action="options.php">
			<h3><?php _e( "Version", 'theia-upload-cleaner' ); ?></h3>

			<p>
				You are using
				<a href=""
				   target="_blank"><b>Theia Upload Cleaner</b></a>
				version <b class="theiaSmartThumbnails_adminVersion"><?php echo TUC_VERSION; ?></b>, developed
				by
				<a href="http://wecodepixels.com/?utm_source=theia-upload-cleaner-for-wordpress"
				   target="_blank"><b>WeCodePixels</b></a>.
				<br>
			</p>

			<br>

			<h3><?php _e( "Support", 'theia-upload-cleaner' ); ?></h3>

			<p>
				1. If you have any problems or questions, you should first check
				<a href=""
				   class="button"
				   target="_blank">
					The Documentation
				</a>
			</p>

			<p>
				2. Deactivate all plugins. If the issue is solved, then re-activate them one-by-one to pinpoint the exact cause.
			</p>

			<p>
				3. If your issue persists, please proceed to
				<a href="http://wecodepixels.com/theia-upload-cleaner-for-wordpress/support/?utm_source=theia-upload-cleaner-for-wordpress"
				   class="button"
				   target="_blank">Submit a Ticket</a>
			</p>

			<br>

			<h3><?php _e( "Updates and Announcements", 'theia-upload-cleaner' ); ?></h3>

			<iframe class="theiaUploadCleaner_news"
			        src="//wecodepixels.com/theia-upload-cleaner-for-wordpress-news"></iframe>
		</form>
	<?php
	}
}
