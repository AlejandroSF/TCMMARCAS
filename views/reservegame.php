<?php

include_once '../models/PersistentObject.php';

if (!isset($_REQUEST['invitation'])||!isset($_REQUEST['validation'])||!isset($_REQUEST['promotion'])) {
	//404 @TO-DO
}else{
	$r = new GameReservation($_REQUEST['$token'],$_REQUEST['$invitation'],$_REQUEST['$promotion']);
	$r.save();
	//200 @TO-DO
}
?>