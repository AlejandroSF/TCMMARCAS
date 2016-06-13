<?php

include_once '../models/PersistentObject.php';

if (!isset($_REQUEST['invitation'])||!isset($_REQUEST['validation'])||!isset($_REQUEST['promotion'])) {
	http_response_code(404);
}else{
	(new GameReservation($_REQUEST['$token'],$_REQUEST['$invitation'],$_REQUEST['$promotion'])).save();
	http_response_code(200);
}
?>