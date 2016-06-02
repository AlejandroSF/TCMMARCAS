<?php 
//$resultado = $_POST['valorCaja1'] + $_POST['valorCaja2'];
//echo "CAJA1: ".$_POST['valorCaja1'] ." CAJA2: ".$_POST['valorCaja2'] ;
$contador=0;
if($_POST['valorCaja1']==$_POST['valorCaja2'])
{
?>
    <script>
        aciertos = contarAciertos(aciertos);
        //alert (aciertos);
    </script>
    <h3 id="acierto" ><center>&iexcl;Correcto!</center></h3>
    
<?php
}
else
{
?>
    <h3 id="fallo"><center>&iexcl;Has fallado!</center></h3>
<?php
}
    

    
?>