<?php
include("cpanel/conexion.php");
?>
<!DOCTYPE html>
<html>
<head>    
    <meta charset="UTF-8"/>
    <title>PIISW</title>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="estilos.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script type="text/javascript" src="js/javascript.js"></script>
    <script type="text/javascript" src="js/jquery-1.12.4.min.js"></script>
    <script type="text/javascript" src="js/jquery-1.2.6.min.js"></script>
	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Kanit"/> <!--codigo para las fuentes del encabezado-->
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Sarpanch"/> <!--codigo para las fuentes del encabezado-->
    
 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script type="text/javascript" src="js/javascript.js"></script>
    <script type="text/javascript" src="js/jquery-1.12.4.min.js"></script>
    <script type="text/javascript" src="js/jquery-1.2.6.min.js"></script>
    
    <style>
    
    #imageWrapper{
      background:;
      /*margin:20px;
      width: 100px;
      height: 100px;*/
      
      /*blur*/
      filter: blur(0px); 
      -webkit-filter: blur(15px); 
      -moz-filter: blur(0px);
      -o-filter: blur(0px);
      -ms-filter: blur(0px);
    }
    
    </style>
</head>

<body>

<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <h3 style="font-family: Kanit;"><center><font font-family="http://fonts.googleapis.com/css?family=Kanit" color="white">TCM</font></center></h3>
        <h4 style="font-family: Sarpanch;"><center><font color="white">"EL JUEGO DE LAS MARCAS"</font></center></h4>
    </div>
</nav>

<div class="container">
    <section class="row">
        <div id="error" class="col-xs-12 col-sm-10 col-sm-offset-1" id="imageWrapper">
		<?php
			$tituloError;
			$tituloError = 'Titulo del error'; //texto de prueba, borrar luego
			$error;
			$error = 'Texto de prueba del error'; //texto de prueba, borrar luego
		?>
			<h2><center><?php echo $tituloError;?></center></h3>
			<h1><center><?php echo $error;?></center></h1>

        </div>

</body>
</html>