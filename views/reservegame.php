<?php

include_once '../models/PersistentObject.php';

if (!isset($_REQUEST['invitation'])||!isset($_REQUEST['validation'])||!isset($_REQUEST['promotion'])) {
	http_response_code(404);
}else{
	$r = new GameReservation($_REQUEST['$token'],$_REQUEST['$invitation'],$_REQUEST['$promotion']);
	$r.save();
	http_response_code(200);
}
?>