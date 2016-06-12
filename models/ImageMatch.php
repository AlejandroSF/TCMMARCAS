<?php

include_once 'PersistentObject.php';

class ImageMatch extends PersistentObject{

	public $playerId;
	public $imageId;
	
	function __construct($image, $player){
		parent::__construct();
		$this->playerId = $player->id;
		$this->imageId = $image->id;
	}
}

?>