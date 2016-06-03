<?php include_once 'PersistentObject.php';
class GameReservation extends PersistentObject{

    public $token="12345";
}
echo (new GameReservation)->getUpdateSentence();
?>