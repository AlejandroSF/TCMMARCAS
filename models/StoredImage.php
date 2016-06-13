<?php

include_once 'PersistentObject.php';

class StoredImage extends PersistentObject {

	public $filePath;
	public $solution;
	
	function __construct($filePath,$solution){
		parent::__construct();
		$this->filePath = $filePath;
		$this->solution = $solution;
	}

	public function checkSolution($proposedSolution){
		return (strcasecmp($proposedSolution, $this->solution) == 0);
	}
}
?>


