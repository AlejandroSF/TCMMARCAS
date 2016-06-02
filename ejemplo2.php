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


function mostrar(i_arrayJS,r_arrayJS)
{
            /*for(var i=0;i<i_arrayJS.length;i++)
            {
                document.write("<br>"+i_arrayJS[i]);
            }

            for(var i=0;i<r_arrayJS.length;i++)
            {
                document.write("<br>"+r_arrayJS[i]);
            }*/
            //oculta bienvenida
            //$('#bienvenida').toggle();
            $("#bienvenida").css("display", "none");
            //variables necesarias para el contador de que imagen es
            var num = $("#num").val();
            //alert("Num: "+num);
            
            //aqui pasamos a la siguiente imagen
            $("#id_imagen").attr("src","cpanel/imagenes/" + i_arrayJS[num]);
            //$("#id_imagen").("src","cpanel/imagenes/" + i_arrayJS[num]);
            //aqui pasamos a la siguiente respuesta correcta
            $("#cuadroTextor").val(r_arrayJS[num]);
            
            //variables necesarias para el contador de que imagen es
            $("#num").val(num);
            var numerico = 1 + parseInt(num);
            //alert (numerico);
            $("#num").val(numerico);
            //$("#num").val();
            
            //limpio el campo de texto
            $("#cuadroTexto").val("");
            //limpiar texto acierto
            $('#acierto').toggle();
            //hacer visible boton siguiente
            $('#siguiente').show();
            //hacer visible boton pista
            $('#hitButtonWrapper').show();
            $("#campo_texto").css("display", "block");
            
            $("#pantallaFinal").css("display", "none");
            
            
}
function contarAciertos(aciertos)
{
    var suma = aciertos + 1;
    
    if(num_imagenes_total==suma)
    {
        //si entro aquí es porque ha acertado todas las imagenes
        //oculto todo el contenido
        $("#bienvenida").css("display", "none");
        $("#id_imagen").css("display", "none");
        $("#hitButtonWrapper").css("display", "none");
        $("#resultado").css("display", "none");
        $("#campo_texto").css("display", "none");
        
        $("#pantallaFinal").css("display", "block");
    }
    
    return suma;
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
var num_imagenes_total =<?php echo $M_R_S_A['num_images'];?>;
</script>
    <section class="row">
        <div id="bienvenida" class="col-xs-12 col-sm-10 col-sm-offset-1" id="imageWrapper">
            <h2> <center>Bienvenid@ a</center></h2>
            <h1><center>El juego de las marcas</center></h1>
            <center><input type="button" style="background: #00FF40; width: 100%; border-radius: 5px;font-size: 2em; border: 0; color: white;" onclick="mostrar(i_arrayJS,r_arrayJS)" value="COMENZAR A JUGAR"/></center>
        </div>
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

        <img width="100%" height="45%" id="id_imagen"/>
            
        </div>
        
        <div id="hitButtonWrapper" style="display: none; width: 100%;">
        <!--<input type="button" value="EMPEZAR" onclick="mostrar(i_arrayJS,r_arrayJS)" />-->
            <table border="0" style="width: 100%;">
                <tr>
                    <td align="center"><a id="pista" href="#"><strong>?</strong></a></td>
                    <td align="right"><input type="button" id="siguiente" value="SIGUIENTE" onclick="mostrar(i_arrayJS,r_arrayJS)" /></td>
                </tr>
            </table>
        </div>
        
        <div id="pantallaFinal" class="col-xs-12 col-sm-10 col-sm-offset-1" style="display: none; width: 100%;">
            FIN DEL JUEGO
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