<?php

include_once '../models/PersistentObject';

session_start();
$response = array();
$success = isset($_SESSION['AdminPrivileges']);
$response['success']=$success;
if ($success) {
	if (($_FILES["imagen"]["error"] > 0) || !isset($_POST['solution'])){
    	$response['error'] = True;
    	$response['message'] = ($_FILES["imagen"]["error"] > 0)?("Error en la subida del archivo"):("Error en la subida de la solución");
    } else {
    	$response['error'] = False;
    	$response['uploaded'] = False;
    	if (in_array($_FILES['imagen']['type'], AllowedFileTypes) && $_FILES['imagen']['size'] <= MaxFileSizeKb * 1024){
    		$destinationPath = ImageFolder."/".getValidFileName();
    			if ((@move_uploaded_file($_FILES["imagen"]["tmp_name"], $destinationPath))!=False){
                    $response['uploaded'] = True;
                    (new StoredImage($destinationPath, $_POST['solution'])).save();
                    $response['message'] = "Imagen subida y guardada correctamente";
    			} else {
    				$response['message'] = "Error en el guardado de la Imagen";
    			}
    	} else {
    		$response['message'] = (!in_array($_FILES['imagen']['type'], AllowedFileTypes))?("Tipo de archivo no permitido"):("Tamaño de archivo excesivo");
    	}
    }
}
echo json_encode($response);

function getValidFileName(){
	//@To-Do
}
?>
