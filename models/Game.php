<?php

include_once 'PersistentObject.php';

class Game extends PersistentObject {

	public $request;

	public static $
	
	function __construct($request){
		parent::__construct();
		$this->request = $request;
	}
}
?>