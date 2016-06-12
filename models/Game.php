<?php

include_once 'PersistentObject.php';

class Game extends PersistentObject {

	public $token;
	public $validation;
	public $promotion;
	public $hintCount = 0;
	public $activeChallenge;
	public $challengeCount = 0;
	public $matchCount = 0;
	public $player;

	public static $maxTime = 90;
	public static $maxHints = 3;
	public static $maxChallenges = 10;
	
	function __construct($request, $reservation){
		parent::__construct();
		$this->validation = $request->validation;
		$this->promotion = $request->promotion;
		$this->token = $reservation->token;

		$player = Player::getByConditions(array('token'=>$this->token));
		if (count($player)==0) {
			$this->player = new Player($this->token);
		}else{
			$this->player = $player[0];
		}

		$this->activeChallenge = $this->getNewChallenge();
	}

	public function getFields($excludeAuxiliaryFields = True){
		$fields = parent::getFields($excludeAuxiliaryFields);
		if ($excludeAuxiliaryFields) {
			unset($fields['activeChallenge']);
		}
		return $fields;
	}

	public function checkSolution($solution=''){
		if ($this->activeChallenge->checkSolution($solution)) {
			$this->getNewChallenge();
			return True;
		}else{
			return False;
		}	
	}

	public function getNewChallenge(){
		if ($this->challengeCount == static::$maxChallenges) {
			$this->activeChallenge = null;
			$this->sendPoints();
		}else{
			++($this->challengeCount);
			$this->activeChallenge = new ImageChallenge($this->getUnMatchedImage());
		}
	}
	public function getHint(){
		if ($this->hintCount<static::$maxHints && $this->activeChallenge->getHint()) {
			++($this->hintCount);
			return True;
		}else{
			return False;
		}
	}
	public function getUnMatchedImage(){
		$matches = ImageMatch::getByConditions('playerId'=>$this->player->id);
		$conditions = array();
		foreach ($matches as $match) {
			array_push($conditions, "`imageId` != '".$match->imageId."'")
		}
		$conditionsString = implode(" AND ", $conditions);
		$cursor = getResultFromQuery("SELECT * FROM ".ImageMatch::getTableName()." WHERE ".$conditionsString.";");
	}
}
?>