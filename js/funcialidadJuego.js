function contador(){
	i = i + 1;
	var btn = document.getElementById("boton");
	if(i<4)
	{
		$("#imageWrapper").css("-webkit-filter", "blur(10px)");
		btn.value = "ACLARAR " + i + "";
	}
	else
	{
		alert ("HAS GASTADO LAS PISTAS");
	}
}

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

function contarAciertos(aciertos)
{
    var suma = aciertos + 1;
    
    //alert ("NUM: "+num_imagenes_total+"SUM: "+suma)
    
    if(num_imagenes_total==suma)
    {
        //si entro aquí es porque ha acertado todas las imagenes
        //oculto todo el contenido
        /*$("#bienvenida").css("display", "none");
        $("#id_imagen").css("display", "none");
        $("#hitButtonWrapper").css("display", "none");
        $("#resultado").css("display", "none");
        $("#campo_texto").css("display", "none");
        
        $("#pantallaFinal").css("display", "block");
        $("#contenedor").css("display", "none");
        $("#fotos_acertadas").html(aciertos);
        $("#fotos_falladas").html("0");
        $("#puntos_ganados").html((aciertos*100)-i);
        */
        
        /*if(suma==0)
        {
            $("#fotos_acertadas").html("0");
        }
        else
        {
            $("#fotos_acertadas").html(suma);
        }*/
            
    }
    
    return suma;
}

function contarFallos(fallos)
{
    var suma = fallos + 1;
    
    if(num_imagenes_total==suma)
    {
        /*//si entro aquí es porque ha acertado todas las imagenes
        //oculto todo el contenido
        $("#bienvenida").css("display", "none");
        $("#id_imagen").css("display", "none");
        $("#hitButtonWrapper").css("display", "none");
        $("#resultado").css("display", "none");
        $("#campo_texto").css("display", "none");
        
        $("#pantallaFinal").css("display", "block");
        $("#contenedor").css("display", "none");
        $("#fotos_acertadas").html("0");
        $("#fotos_falladas").html(suma);
        $("#puntos_ganados").html("0");
        */
        
        
    }
    
    return suma;
}