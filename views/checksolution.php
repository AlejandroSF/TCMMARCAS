<?php

include_once '../models/PersistentObject';

session_start();
$response = array();
if (isset($_SESSION['Game'])){
	$response['success'] = True;
	$response['match'] = $_SESSION['Game'].checkSolution();
	$gameData = $_SESSION['Game']->getFields();
	unset($gameData['token']);
	unset($gameData['validation']);
	unset($gameData['promotion']);
	unset($gameData['player']);
	$response['Game'] = $gameData;
}else{
	$response['success'] = False;
}
echo json_encode($response);

?>