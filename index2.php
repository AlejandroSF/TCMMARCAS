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
 
<script>
function realizaProceso(valorCaja1, valorCaja2){
        var parametros = {
                "valorCaja1" : valorCaja1,
                "valorCaja2" : valorCaja2
        };
        $.ajax({
                data:  parametros,
                url:   'ajax.php',
                type:  'post',
                beforeSend: function () {
                        $("#resultado").html("Procesando, espere por favor...");
                },
                success:  function (response) {
                        $("#resultado").html(response);
                }
        });
}
function siguienteFoto()
{
    
}
</script>
</head>

<body>
<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <h3><center>TCM</center></h3>
        <h4><center>"EL JUEGO DE LAS MARCAS"</center></h4>
    </div>
</nav>
<div class="container">

<?php
$S_I="SELECT * FROM imagenes ORDER BY RAND() LIMIT 0, 3";
$R_S_I=mysql_query($S_I,$conexion);

?>
    <section class="row">
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
        <img src="cpanel/imagenes/<?php echo $imagenes[0];?>" width="100%" height="45%"/>
            <a href="#"><strong>?</strong></a>
        </div>
        
        <div id="hitButtonWrapper">
        
        </div>
        <div class="col-xs-12 col-sm-10 col-sm-offset-1" id="inputWrapper">
            <span id="resultado"></span>
        </div>
        <div class="col-xs-12 col-sm-10 col-sm-offset-1" id="inputWrapper">
            <form class="input-group">
                <input type="hidden" id="cuadroTextor" name="solucionCorrecta" value="<?php echo $respuesta[0]; ?>" />
                <input type="text" class="form-control" id="cuadroTexto" name="solucionUsuario" value="" placeholder="&iquest;Qu&eacute; ves en la imagen?"/>
                <div class="input-group-addon" onclick="realizaProceso($('#cuadroTexto').val(), $('#cuadroTextor').val());return false;"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></div>
            </form>
        </div>
    </section>
</div>
</body>
</html>