<?php

include_once 'PersistentObject.php';

class GameRequest extends PersistentObject {
	
	public $validation;
	public $invitation;

	function __construct($validation,$invitation){
		parent::__construct();
		$this->validation = $validation;
		$this->invitation = $invitation;
	}
}
?>