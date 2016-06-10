<?php

session_start();
$response = array();
if (isset($_SESSION['Game'])){
	$response['success'] = True;
	$response['match'] = $_SESSION['Game'].checkSolution();
}else{
	$response['success'] = False;
}
echo json_encode($response);

?>