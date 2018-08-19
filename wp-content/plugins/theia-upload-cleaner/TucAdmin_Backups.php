<?php

/*
 * Copyright 2016, Theia Upload Cleaner, WeCodePixels, http://wecodepixels.com
 */

class TucAdmin_Backups {
	public function echoPage() {
		$fileManager = new TucFileManager();

		// Do actions.
		if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {
			$backupName = $_POST['backupName'];

			check_admin_referer( 'tuc-backup-actions-' . $backupName );

			if ( array_key_exists( 'restore', $_POST ) ) {
				$fileManager->restoreBackup( $backupName );
			}

			if ( array_key_exists( 'delete', $_POST ) ) {
				$fileManager->deleteBackup( $backupName );
			}
		}

		// Get backups.
		$unsortedBackups = new DirectoryIterator( $fileManager->getBackupFolder() );

		// Sort backups alphabetically.
		$backups = array();
		foreach ( $unsortedBackups as $object ) {
			if ( ! $object->isDir() || in_array( $object->getBasename(), array( '.', '..' ) ) ) {
				continue;
			}

			$backups[ $object->getPathname() ] = clone $object;
		}
		krsort( $backups );

		if ( count( $backups ) == 0 ) {
			?>
			<p>
				There are no backups available.
			</p>
			<?php
		} else {
			?>
			<table class="form-table widefat">
				<thead>
				<tr>
					<td></td>
					<td>Name</td>
					<td>Size</td>
					<td>Date</td>
					<td>Actions</td>
				</tr>
				</thead>
				<tbody>
				<?php
				$i = 0;
				foreach ( $backups as $object ) {
					/* @var SplFileInfo $object */
					if ( ! $object->isDir() || in_array( $object->getBasename(), array( '.', '..' ) ) ) {
						continue;
					}

					$i ++;
					$class = $i % 2 ? 'alternate' : '';

					?>
					<tr class="<?php echo $class; ?>">
						<td>#<?php echo $i; ?></td>
						<td><?php echo $object->getFilename(); ?></td>
						<td><?php echo $fileManager->getHumanSize( $fileManager->getFolderSize( $object->getPathname() ) ); ?></td>
						<td><?php echo date_i18n( get_option( 'date_format' ) . ' ' . get_option( 'time_format' ), $object->getCTime() ); ?></td>
						<td>
							<form method="post" action="">
								<?php
								wp_nonce_field( 'tuc-backup-actions-' . $object->getFilename() );
								?>
								<input type="hidden" name="backupName" value="<?php echo htmlspecialchars( $object->getFilename() ); ?>">

								<button type="submit" class="button" name="restore" value="true" onclick="return onRestore()">Restore</button>
								&nbsp;
								<button type="submit" class="button button-delete-permanently" name="delete" value="true" onclick="return doDelete()">Delete Permanently</button>
							</form>
						</td>
					</tr>
				<?php
				}
				?>
				</tbody>
			</table>

			<script>
				function onRestore() {
					if (confirm('Are you sure you want to restore this backup?')) {
						return true;
					}

					return false;
				}

				function doDelete() {
					if (confirm('Are you sure you want to delete this backup? WARNING: This action is undoable.')) {
						return true;
					}

					return false;
				}
			</script>
		<?php
		}
		?>
	<?php
	}
}
