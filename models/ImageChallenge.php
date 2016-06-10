<?php

class ImageChallenge extends PersistentObject {

	public $image;
	public $hintCount=0;
	
	function __construct($image){
		parent::__construct();
		$this->image = $image;
	}

	public function checkSolution($solution=''){
		if ($this->image->checkSolution($solution)) {
			(new ImageMatch($this->image, $this->parentGame->player)).save();//bjeto de la Bd que registra que el jugador X ha resuelto la imagen Y, a fin de no vlver a presentársela
			return True;
		}else{
			return False;
		}
	}
	public function getHint(){
		if ($this->hintCount == 0) {
			++($this->hintCount);
			return True;
		}else{
			return False;
		}
	}
}

?>