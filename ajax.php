<?php 
//$resultado = $_POST['valorCaja1'] + $_POST['valorCaja2'];
//echo "CAJA1: ".$_POST['valorCaja1'] ." CAJA2: ".$_POST['valorCaja2'] ;
$contador=0;
if($_POST['valorCaja1']==$_POST['valorCaja2'])
{
?>
    <script>
        aciertos = contarAciertos(aciertos);
        $("#imageWrapper").css("-webkit-filter", "blur(0px)");
        //alert (aciertos);
    </script>
    <h3 id="acierto" ><center>&iexcl;Correcto!</center></h3>
    
<?php
}
else
{
?>
    <script>
        fallos = contarFallos(fallos);
        //alert (fallos);
    </script>
    <h3 id="fallo"><center>&iexcl;Has fallado!</center></h3>
<?php
}
    

    
?>