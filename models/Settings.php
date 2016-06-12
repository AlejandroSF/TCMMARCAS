<?php

include_once 'PersistentObject.php';

define('DBUser', 'API');
define('DBPass', 'hola');
define('DBName', 'TCMMARCAS');
define('DBAddress', 'localhost');

function DBConnect() {
    $con = mysqli_connect(DBAddress,DBUser,DBPass,DBName);//Dirección, Usuario, Contraseña y Nombre de la BD
    if (mysqli_connect_errno()) {
        printf("Error de conexión: %s\n", mysqli_connect_error());
        exit();
    }else{
        mysqli_set_charset($con, "utf8");//Importante, que luego las "ñ"s (y demás) dan problemas
        return $con;
    }
}
function getResultFromQuery($query){
	$db =DBConnect();
    $cursor = mysqli_query($db, $query);
    mysqli_close($db);
    return $cursor;
}
?>