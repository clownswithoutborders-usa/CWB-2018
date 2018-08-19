<?php

/*
 * Copyright 2016, Theia Upload Cleaner, WeCodePixels, http://wecodepixels.com
 */

class TucAdmin_Cleanup {
	public function echoPage() {
		?>
		<div id="poststuff">
			<div class="postbox">
				<div class="inside">
					<p>
						Your files are safe!
						Cleaned files will <strong>NOT</strong> actually be deleted, instead they will be moved to a backup folder.
						After you check that everything is working properly, you can either remove or restore your files from the "Backups" tab.
					</p>
				</div>
			</div>
		</div>

		<form method="post" action="options.php">
			<p class="submit cleanupActions" data-nonce="<?php echo htmlspecialchars( wp_create_nonce( 'tuc-calculate-cleanup-size' ) ); ?>">
				<input type="button"
				       class="button"
				       value="<?php _e( 'Calculate cleanup size', 'theia-upload-cleaner' ) ?>"

				       onclick="startCleanup(true)">

				&nbsp;
				or
				&nbsp;

				<input type="button"
				       class="button-primary"
				       value="<?php _e( 'Start cleanup', 'theia-upload-cleaner' ) ?>"
				       onclick="startCleanup(false)">
			</p>
		</form>

		<div class="postbox">
			<table class="form-table cleanupContainer">
				<tr>
					<td style="width: 70%">
						<table class="form-table cleanupStatus">
							<tr class="alternate error" style="display: none">
								<th>Error</th>
								<td class="currentError">-</td>
							</tr>
							<tr>
								<th>Status</th>
								<td class="currentStatus">-</td>
							</tr>
							<tr class="alternate">
								<th>Current table</th>
								<td class="currentTable">-</td>
							</tr>
							<tr>
								<th>Current row</th>
								<td class="currentRow">-</td>
							</tr>
							<tr class="alternate">
								<th>Total files found in upload folder</th>
								<td class="countOfFilesFoundInUploadFolder">-</td>
							</tr>
							<tr>
								<th>Total items found in media gallery</th>
								<td class="countOfMediaGalleryItems">-</td>
							</tr>
							<tr class="alternate">
								<th>Total files found in database</th>
								<td class="countOfFilesFoundInDatabase">-</td>
							</tr>
							<tr>
								<th>Cleanup size</th>
								<td class="sizeOfFiles">-</td>
							</tr>
						</table>
					</td>
					<td style="width: 30%">
						<div id="progressbar" class="rotating"></div>
					</td>
				</tr>
			</table>
		</div>

		<script>
			var progressBar = null;

			function startCleanup(calculateOnly) {
				var $ = jQuery;

				enableCleanupButtons(false);
				$('#progressbar').html('');
				progressBar = new ProgressBar.Circle('#progressbar', {
					color: '#FCB03C',
					trailColor: '#ccc',
					strokeWidth: 10,
					trailWidth: 1,
					duration: 1500,
					easing: 'easeInOut',
					text: {
						value: '0%'
					},
					step: function (state, bar) {
						bar.setText((bar.value() * 100).toFixed(0) + '%');
					}
				});
				resetCleanupStatus();
				$('.cleanupStatus .currentStatus').html('Starting...');

				continueCleanup(calculateOnly, true);
			}

			function continueCleanup(calculateOnly, startOver) {
				var $ = jQuery;

				$.ajax({
					method: 'post',
					url: '<?php echo admin_url( 'admin-ajax.php' ); ?>',
					data: {
						action: 'tuc_clean',
						calculate_only: calculateOnly,
						start_over: startOver,
						_wpnonce: $('.cleanupActions').attr('data-nonce')
					},
					dataType: 'json',
					success: function (response) {
						try {
							switch (response.step) {
								case <?php echo TucCleanerProgress::STEP_SCAN_MEDIA_GALLERY; ?>:
									resetCleanupStatus();
									$('.cleanupStatus .currentStatus').html('Scanning media gallery...');
									$('.cleanupStatus .currentRow').html(response.currentRow);
									setProgress(5);
									break;
								case <?php echo TucCleanerProgress::STEP_SCAN_TABLES; ?>:
									resetCleanupStatus();
									$('.cleanupStatus .currentStatus').html('Scanning tables...');
									$('.cleanupStatus .currentTable').html(response.currentTable);
									$('.cleanupStatus .currentRow').html(response.currentRow);
									setProgress(Math.min(95, response.percentage));
									break;

								case <?php echo TucCleanerProgress::STEP_GET_SIZE_OF_FILES; ?>:
									resetCleanupStatus();
									$('.cleanupStatus .currentStatus').html('Calculating size of files...');
									setProgress(95);
									break;

								case <?php echo TucCleanerProgress::STEP_SOFT_DELETE_FILES; ?>:
									resetCleanupStatus();
									$('.cleanupStatus .currentStatus').html('Moving files to backup folder...');
									setProgress(95);
									break;

								case <?php echo TucCleanerProgress::STEP_DONE; ?>:
									resetCleanupStatus();
									$('.cleanupStatus .currentStatus').html('Done');
									if ('sizeOfFiles' in response) {
										$('.cleanupStatus .sizeOfFiles').html(response.sizeOfFiles);
									}
									setProgress(100);
									break;
							}

							$('.cleanupStatus .countOfFilesFoundInUploadFolder').html(response.countOfFilesFoundInUploadFolder);
							$('.cleanupStatus .countOfMediaGalleryItems').html(response.countOfMediaGalleryItems);
							$('.cleanupStatus .countOfFilesFoundInDatabase').html(response.countOfFilesFoundInDatabase);

							if (response.step < 9999) {
								continueCleanup(calculateOnly, false);
							}
							else {
								enableCleanupButtons(true);
							}
						}
						catch (err) {
							alert('JavaScript error: ' + err.message);
							reportError(response);
						}
					},
					error: function (response) {
						reportError(response);
					}
				});
			}

			function reportError(response) {
				var $ = jQuery;
				var errorResult;

				console.log(response);

				try {
					if (response.responseText && (errorResult = JSON.parse(response.responseText))) {
						var html = '<b>' + errorResult.errname + ' (' + errorResult.errno + ')</b><br><br><b>Error description:</b><br>' + errorResult.errstr + '<br><br><b>Error file:</b><br>' + errorResult.errfile + ' : ' + errorResult.errline;

						$('.cleanupStatus tr.error').css('display', '');
						$('.cleanupStatus .currentError').html(html);
						console.log(errorResult);
					}
				}
				catch (err) {
				}

				enableCleanupButtons(true);
				$('#progressbar').html('');
			}

			function setProgress(percentage) {
				progressBar.animate(Math.max(0.05, percentage / 100));
			}

			function enableCleanupButtons(enable) {
				var $ = jQuery;
				var buttons = $('form .cleanupActions input');

				buttons.attr('disabled', enable ? null : 'disabled');
			}

			function resetCleanupStatus() {
				var $ = jQuery;

				$('.cleanupStatus tr.error').css('display', 'none');
				$('.cleanupStatus td').html('-');
			}
		</script>
		<?php
	}
}
