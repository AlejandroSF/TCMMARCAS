<?php include_once 'PersistentObject.php';
class GameReservation extends PersistentObject{

    public $token = "12345";
    public $invitarion = "56789";
}
echo (new GameReservation)->getInsertSentence();
?>