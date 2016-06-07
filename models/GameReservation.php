<?php
include_once 'PersistentObject.php';

class GameReservation extends PersistentObject{

    public $token = 12345;
    public $invitarion = "56789";
    public $promotion = "98765";
}

GameReservation::classInit();
echo (new GameReservation())->getUpdateSentence();
?>