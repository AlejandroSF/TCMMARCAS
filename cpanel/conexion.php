<?php

$conexion = mysql_connect('localhost', 'root', '');
if (!$conexion) {
    die('No se pudo conectar : ' . mysql_error());
}

// Hacer que foo sea la base de datos actual
$bd_seleccionada = mysql_select_db('marcasdb', $conexion);
if (!$bd_seleccionada) {
    die ('No se puede usar foo : ' . mysql_error());
}
?>