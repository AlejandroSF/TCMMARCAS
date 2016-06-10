<?php

class ImageChallenge extends PersistentObject {

	public $image;
	
	function __construct($image){
		parent::__construct();
		$this->image = $image;
	}
}

?>