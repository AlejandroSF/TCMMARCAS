<?php
include("conexion.php");
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="www.intercambiosvirtuales.org" />

	<title>Galeria imagenes</title>
</head>

<body>
<h1>Galeria de Imagenes</h1>
<h3>El juego de las marcas</h3>
<?php
if(isset($_POST['guardar'])==1)
{
    //comprobamos si ha ocurrido un error.
        if ($_FILES["imagen"]["error"] > 0){
        	echo "ha ocurrido un error";
        } else {
        	//ahora vamos a verificar si el tipo de archivo es un tipo de imagen permitido.
        	//y que el tamano del archivo no exceda los 100kb
            
        	$permitidos = array("image/jpeg","image/png");
        	$limite_kb = 1000000000;
        
        	if (in_array($_FILES['imagen']['type'], $permitidos) && $_FILES['imagen']['size'] <= $limite_kb * 1024){
        		//esta es la ruta donde copiaremos la imagen
        		//recuerden que deben crear un directorio con este mismo nombre
        		//en el mismo lugar donde se encuentra el archivo subir.php
        		$ruta = "imagenes/" . $_FILES['imagen']['name'];
        		//comprovamos si este archivo existe para no volverlo a copiar.
        		//pero si quieren pueden obviar esto si no es necesario.
        		//o pueden darle otro nombre para que no sobreescriba el actual.
        		if (!file_exists($ruta)){
        			//aqui movemos el archivo desde la ruta temporal a nuestra ruta
        			//usamos la variable $resultado para almacenar el resultado del proceso de mover el archivo
        			//almacenara true o false
        			$resultado = @move_uploaded_file($_FILES["imagen"]["tmp_name"], $ruta);
        			if ($resultado){
        				echo "La imagen se ha subido correctamente";
                        
                        $I_I="INSERT INTO imagenes (imagen,respuesta) VALUES ('".$_FILES['imagen']['name']."','".$_POST['respuesta']."')";
                        $R_I_I=mysql_query($I_I,$conexion);
                        
        			} else {
        				echo "ocurrio un error al mover el archivo.";
        			}
        		} else {
        			echo $_FILES['imagen']['name'] . ", este archivo existe";
        		}
        	} else {
        		echo "archivo no permitido, es tipo de archivo prohibido o excede el tamano de $limite_kb Kilobytes";
        	}
        }
}

$S_I="SELECT * FROM imagenes";
//echo "consulta: ". $S_I;
$R_S_I=mysql_query($S_I,$conexion);
//$R_S_I = mysql_query($S_I,$conexion) or die("Error en: $: " . mysql_error());

?>
<table>
    <tr>
        <td colspan="2">SUBIR IMAGEN</td>
    </tr>
    <tr>
        <form action="galeriaimagenes.php" method="post" enctype="multipart/form-data">
        <td><input type="file" name="imagen"/></td>
        <td><input type="text" name="respuesta"/></td>
        <td><input type="submit" value="GUARDAR" /></td>
        <input type="hidden" name="guardar" value="1" />
        </form>
    </tr>
    <tr>
        <td><b>Im&aacute;genes</b></td>
        <td><b>Respuestas</b></td>
    </tr>
    <?php
    //while($M_R_C_Libros=mysql_fetch_array($R_C_Libros))
    while($M_R_S_I=mysql_fetch_array($R_S_I))
    {
    ?>
    <tr>
        <td><img src="imagenes/<?php echo $M_R_S_I['imagen']; ?>" width="100px" height="100px" /></td>
        <td><?php echo $M_R_S_I['respuesta']; ?></td>
    </tr>
    <?php
    }
    ?>
</table>


</body>
</html>