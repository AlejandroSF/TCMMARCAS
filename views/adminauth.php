<?php

include_once '../models/PersistentObject.php';

session_start();
$response = array();
if (isset($_SESSION['AdminPrivileges'])) {
	$response['success'] = True;
}else{
	if (isset($_REQUEST['user']) && isset($_REQUEST['pass'])) {
		if ((strcmp($_REQUEST['user'],AdminUserName)==0) && (strcmp($_REQUEST['pass'],AdminPassword)==0)) {
			$_SESSION['AdminPrivileges'] = True;
			$response['success'] = True;
			$response['message'] = "Sesión iniciada correctamente";
		}else{
			$response['success'] = False;
			$response['message'] = "Usuario y/o contraseña incorrectos";
		}
	}else{
		$response['success'] = False;
		$response['message'] = "Error en la recepción de los argumentos de autenticación";
	}
}

echo json_encode($response);
?>