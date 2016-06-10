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
</head>

<body>

<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <h3 style="font-family: Kanit;"><center><font font-family="http://fonts.googleapis.com/css?family=Kanit" color="white">TCM</font></center></h3>
        <h4 style="font-family: Sarpanch;"><center><font color="white">"EL JUEGO DE LAS MARCAS"</font></center></h4>
    </div>
</nav>
<div class="container">

<?php
//SELECT ADMINISTRACION
$S_A="SELECT num_images, tiempo_juego FROM administracion LIMIT 1";
$R_S_A=mysql_query($S_A,$conexion);
$M_R_S_A=mysql_fetch_array($R_S_A);

//echo "NUM: ".$M_R_S_A['num_images']. " TIEM: " .$M_R_S_A['tiempo_juego'];

$S_I="SELECT * FROM imagenes ORDER BY RAND() LIMIT 0,".$M_R_S_A['num_images']."";
$R_S_I=mysql_query($S_I,$conexion);
?>
<script>
var aciertos = 0;
var fallos = 0;
var num_imagenes_total =<?php echo $M_R_S_A['num_images'];?>;
var segundos =<?php echo $M_R_S_A['tiempo_juego'];?>;
var pistas = 0;
</script>
    <section class="row">
        <div id="bienvenida" class="col-xs-12 col-sm-10 col-sm-offset-1" id="imageWrapper">
            <h2> <center>Bienvenid@ a</center></h2>
            <h1><center>El juego de las marcas</center></h1>
            <center><input type="button" style="background: #00FF40; width: 100%; border-radius: 5px;font-size: 2em; border: 0; color: white;" onclick="mostrar(i_arrayJS,r_arrayJS)" value="COMENZAR A JUGAR"/></center>
        </div>
        <div style="margin-left: 3%;" id="contenedor"></div>
        <br />
        <div class="col-xs-12 col-sm-10 col-sm-offset-1" id="imageWrapper">
        <?php
        $imagenes = array();
        $respuesta = array();
        $i=0; //contador que ayuda a agregar los valores en su sitio del array
        while($M_R_S_I=mysql_fetch_array($R_S_I))
        {
            $imagenes[$i] = $M_R_S_I['imagen'];
            $respuesta[$i] = $M_R_S_I['respuesta'];
        ?>
            
            <!--<img src="cpanel/imagenes/<?php echo $M_R_S_I['imagen']; ?>" width="100%" height="45%"/>-->
        <?php
        $i=$i+1;
        }
        /*
        echo "img0: ".$imagenes[0]." Res0: ".$respuesta[0]."<br/>";
        echo "img1: ".$imagenes[1]." Res0: ".$respuesta[1]."<br/>";
        echo "img2: ".$imagenes[2]." Res0: ".$respuesta[2]."<br/>";
        */
        ?>
        <script type="text/javascript">
            // obtenemos el array de valores mediante la conversion a json del
            // array de php
            var i_arrayJS=<?php echo json_encode($imagenes);?>;
            var r_arrayJS=<?php echo json_encode($respuesta);?>;
            // Mostramos los valores del array
            
            //var img = mostrar(i_arrayJS,r_arrayJS);
        </script>

        <img width="100%" height="290px" id="id_imagen"/>
            
        </div>
        
        <div id="hitButtonWrapper" style="display: none; width: 92%; margin-left: 4%; margin-right: 4%;">
        <!--<input type="button" value="EMPEZAR" onclick="mostrar(i_arrayJS,r_arrayJS)" />-->
            <table border="0" style="width: 100%;margin-top: 80%;">
                <tr>
                    <td align="left">
                                      <input style="background:#FFBD21; margin-top: 5%; padding: 3%; color: white; border: 0; border-radius: 5px;" type="button" id="boton" value="ACLARAR" onclick="javascript: contador()" /></td>
                    <td align="right"><input style="background:#AC1416; margin-top: 5%; padding: 3%; color: white; border: 0; border-radius: 5px;" type="button" id="siguiente" value="SIGUIENTE" onclick="mostrar(i_arrayJS,r_arrayJS);zoom();" /></td>
                </tr>
            </table>
        </div>
        
        
        <div id="pantallaFinal" class="col-xs-12 col-sm-10 col-sm-offset-1" style="display: none; width: 100%;">
            <h1><center>FIN DEL JUEGO</center> </h1>
            
            <h3><center>De <?php echo $M_R_S_A['num_images']; ?> fotos has acertado <span id="fotos_acertadas"> </span>.</center></h3>
            
            <h3><center>Has fallado <span id="fotos_falladas"> </span>.</center></h3>
            
            <h3><center>&iexcl;HAS GANADO <span id="puntos_ganados"> </span> PUNTOS!</center></h3>
            
        </div>
        <div class="col-xs-12 col-sm-10 col-sm-offset-1" id="inputWrapper">
            <span id="resultado"></span>
        </div>
        <div id="campo_texto" style="display: none;" class="col-xs-12 col-sm-10 col-sm-offset-1" id="inputWrapper">
            <form class="input-group">
                <input type="hidden" id="num" name="numeroImagen" value="0" />
                <input type="hidden" id="cuadroTextor" name="solucionCorrecta" />
                <input type="text" class="form-control" id="cuadroTexto" name="solucionUsuario" value="" placeholder="&iquest;Qu&eacute; ves en la imagen?"/>
                <div class="input-group-addon" onclick="realizaProceso($('#cuadroTexto').val(), $('#cuadroTextor').val());return false;"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></div>
            </form>
        </div>
    </section>
</div>


</body>
</html>