<?php
include_once 'PersistentObject.php';

class GameReservation extends PersistentObject{

    public $token;
    public $invitation;
    public $promotion;

    function __construct($token,$invitation,$promotion){
    	parent::__construct();
    	$this->token = $token;
    	$this->invitation = $invitation;
    	$this->promotion = $promotion;
    }
}

?>