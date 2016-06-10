<?php
session_start();
$response = array();
$success = isset($_SESSION['Game']);
$response['success']=$success;
if ($success) {
	$response['accepted'] = $_SESSION['Game']->getHint();
}
echo json_encode($response);
?>