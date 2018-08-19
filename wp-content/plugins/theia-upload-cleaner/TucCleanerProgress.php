<?php

class TucCleanerProgress {
	const STEP_INIT = 0;
	const STEP_SCAN_MEDIA_GALLERY = 1;
	const STEP_SCAN_TABLES = 2;
	const STEP_GET_SIZE_OF_FILES = 3;
	const STEP_SOFT_DELETE_FILES = 4;
	const STEP_DONE = 9999;
	public $step;
	public $tables;
	public $tablesLeftToScan;
	public $filesToDelete;
	public $sizeOfFiles;
	public $mediaGalleryOffset;
	// Statistics
	public $countOfMediaGalleryItems;
	public $countOfFilesFoundInDatabase;
	public $countOfFilesFoundInUploadFolder;

	public function __construct() {
		$this->step               = self::STEP_INIT;
		$this->tables             = array();
		$this->tablesLeftToScan   = array();
		$this->filesToDelete      = array();
		$this->sizeOfFiles        = null;
		$this->mediaGalleryOffset = 0;
		$this->countOfMediaGalleryItems = 0;
		$this->countOfFilesFoundInDatabase = 0;
		$this->countOfFilesFoundInUploadFolder = 0;
	}
}