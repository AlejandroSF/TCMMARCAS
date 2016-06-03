<?php include_once 'PersistentObject.php';
class GameReservation extends PersistentObject{

    public static $table="undefined";

    public $token="12345";

    public function getFields(){
        $s=parent::getFields();
        $s["token"]=$this->token;
    }
}
echo (new GameReservation)->getUpdateSentence();
?>