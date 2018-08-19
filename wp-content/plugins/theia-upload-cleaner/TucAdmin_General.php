<?php

/*
 * Copyright 2016, Theia Upload Cleaner, WeCodePixels, http://wecodepixels.com
 */

class TucAdmin_General {
	public $showPreview = true;

	public function echoPage() {
		?>
		<form method="post" action="options.php" id="tucAdminGeneral">
			<?php settings_fields( 'tuc_options_general' ); ?>
			<?php $options = get_option( 'tuc_general' ); ?>

			<h3><?php _e( "General Settings", 'theia-upload-cleaner' ); ?></h3>

			<table class="form-table">
				<tr valign="top">
					<th scope="row">
						<label><?php _e( "Clean up unused image thumbnails:", 'theia-upload-cleaner' ); ?></label>
					</th>
					<td>
						<label>
							<input type='hidden' value='false' name='tuc_general[clean_thumbnails]'>
							<input type="checkbox"
							       id="tuc_general_clean_thumbnails"
							       name="tuc_general[clean_thumbnails]"
							       value="true" <?php echo $options['clean_thumbnails'] ? 'checked' : ''; ?>>
							Enable
						</label>
						<p class="description">
							 Use this to clean up unused thumbnails even though the original image is still inside the Media Library. Thumbnails will be regenerated on-the-fly when needed.
						</p>
					</td>
				</tr>
				<tr>
					<th scope="row">
						<label><?php _e( "Excluded sizes for cleanup:", 'theia-upload-cleaner' ); ?></label>
					</th>
					<td>
						<input type='hidden' value='' name='tuc_general_excluded_sizes[]'>
						<select id="tuc_general_excluded_sizes" name="tuc_general_excluded_sizes[]" size="10" multiple>
							<?php
							foreach ( get_intermediate_image_sizes() as $value ) {
								?>
								<option value="<?php echo $value; ?>" <?php echo in_array( $value, $options['excluded_sizes'] ) ? 'selected' : ''; ?>>
									<?php echo $value; ?>
								</option>
								<?php
							}
							?>
						</select>
						<p class="description">
							 Note that you should always exclude the "thumbnail", "medium" and "large" sizes unless you know what you're doing. These are used by the Media Library and are always regenerated when you open it.
						</p>
					</td>
				</tr>
				<tr>
					<th scope="row">
						<label><?php _e( "Excluded database tables for cleanup:", 'theia-upload-cleaner' ); ?></label>
					</th>
					<td>
						<input type='hidden' value='' name='tuc_general_excluded_tables[]'>
						<select id="tuc_general_excluded_sizes" name="tuc_general_excluded_tables[]" size="10" multiple>
							<?php
							$allTables = TucOptions::getAllTables();

							foreach ( $allTables as $table ) {
								?>
								<option value="<?php echo $table; ?>" <?php echo in_array( $table, $options['excluded_tables'] ) ? 'selected' : ''; ?>>
									<?php echo $table; ?>
								</option>
								<?php
							}
							?>
						</select>
						<p class="description">
							The plugin already blacklists some tables which, if present, are hidden from the list above.
						</p>
					</td>
				</tr>
				<tr>
					<th scope="row">
						<label><?php _e( "Exclude the following folders from clean-up:", 'theia-upload-cleaner' ); ?></label>
					</th>
					<td>
						<input type='hidden'
						       value="<?php echo htmlspecialchars( json_encode( $options['excluded_folders'] ) ); ?>"
						       name='tuc_general_excluded_folders'
						       id="tuc_general_excluded_folders">
						<div id="tuc_general_excluded_folders_jstree"></div>
					</td>
				</tr>
			</table>

			<p class="submit">
				<input type="submit"
				       class="button-primary"
				       value="<?php _e( 'Save All Changes', 'theia-upload-cleaner' ) ?>" />
			</p>
		</form>

		<script>
			jQuery(function ($) {
				var $this = $('#tuc_general_clean_thumbnails');
				var excludedSizes = $('#tuc_general_excluded_sizes');
				var f = function() {
					if (!$this.is(':checked')) {
						excludedSizes.prop('disabled', true);
					} else {
						excludedSizes.prop('disabled', false);
					}
				};

				f();
				$this.on('change', f);

				$('#tucAdminGeneral').on('submit', function() {
					$('#tuc_general_excluded_sizes').prop('disabled', false);
				});

				// Create folder tree list using jstree.
				$(function () {
					$('#tuc_general_excluded_folders_jstree').jstree({
						'core': {
							'data': {
								"url": "<?php echo admin_url( 'admin-ajax.php' ); ?>",
								"data": {
									"action": "getUploadSubfolders"
								},
								"dataType": "json"
							}
						},
						'plugins': ['checkbox']
					});
				});

				// Send the ids of all the checked folders from jstree in a hidden input to be saved in TucOptions on Submit.
				$('.submit > .button-primary').on('click', function () {
					var selectedElmsIds = $('#tuc_general_excluded_folders_jstree').jstree("get_selected");
					$('#tuc_general_excluded_folders').val(JSON.stringify(selectedElmsIds));
				});

				// Check all folders form jstree that are saved as checked in our database.
				$(document).ready(function () {
					$('#tuc_general_excluded_folders_jstree').bind('loaded.jstree', function (e, data) {
						var excludedFolders = <?php echo json_encode( $options['excluded_folders'] );?>;
						var instance = $('#tuc_general_excluded_folders_jstree').jstree(true);
						for (var i = 0; i < excludedFolders.length; i++) {
							console.log('#' + excludedFolders[i]);
							$.jstree.reference('#tuc_general_excluded_folders_jstree').check_node('#' + excludedFolders[i]);
						}
					});
				});
			});
		</script>
		<?php
	}
}
