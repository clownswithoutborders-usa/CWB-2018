<?php

class TucCleanerTableToScan {
	public $currentRow;
	public $totalRows;

	public function __construct() {
		$this->currentRow = 0;
		$this->totalRows  = 0;
	}
}