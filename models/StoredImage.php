<?php

include_once 'PersistentObject.php';

class StoredImage extends PersistentObject {

	public $filePath;
	public $solution;
	
	function __construct(){
		parent::__construct();
	}

	public function checkSolution($proposedSolution){
		return (strcasecmp($proposedSolution, $this->solution) == 0);
	}
}
?>


