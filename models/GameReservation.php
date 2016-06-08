<?php
include_once 'PersistentObject.php';

class GameReservation extends PersistentObject{

    public $token = 12345;
    public $invitation = "56789";
    public $promotion = "98765";

    function __construct(){
    	parent::__construct();
    }
}
$r = new GameReservation();
$r->save();
$s = GameReservation::getById($r->id);
var_dump($r);
echo "<br><br>";
var_dump($s);
?>