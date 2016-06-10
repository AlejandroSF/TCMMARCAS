<?php

include_once '../models/PersistentObject.php';

session_start();
if (!isset($_REQUEST['validation'])||!isset($_REQUEST['invitation'])) {
	include '../pages/errorpage.php';
}else{
	if (isset($_SESSION['Game'])) {
		include '../pages/gamepage.php';
	}else{
		$r = new GameRequest($_REQUEST['$validation'],$_REQUEST['invitation']);
		$r.save();
		$reservations = GameReservation::getByConditions(array('validation' => $r->validation));
		if (count($reservations)>0) {
			$g = new Game($r, $reservations[0]);
			$_SESSION['Game'] = $g;
			include '../pages/gamepage.php';
		}else{
			include '../pages/errorpage.php';
		}
	}
}
?>