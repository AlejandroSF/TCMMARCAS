<?php

include_once 'PersistentObject.php';

class Game extends PersistentObject {

	public $token;
	public $validation;

	public static $
	
	function __construct($request){
		parent::__construct();
		$this->request = $request;
	}


	public function checkSolution($solution=''){
		//@To-DO $_REQUEST['solution'];
		return True;
	}
}
?>