<?php

include_once 'PersistentObject.php';

class Player extends PersistentObject {

	public $token;
	
	function __construct($token){
		parent::__construct();
		$this->token = $token;
	}
}

?>