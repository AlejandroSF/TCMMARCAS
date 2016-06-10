	function zoom2(){
		document.getElementById("id_imagen").style.transform="scale(1)";	
		document.getElementById("id_imagen").style.transition="width 1s, height 1s, transform 1s";	
	}
		
	function zoom(){
		document.getElementById("id_imagen").style.transform="scale(1.1)";	
		document.getElementById("id_imagen").style.transition="width 1s, height 1s, transform 1s";	
		setTimeout("zoom2()",500)
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
            
            if(num==0)
            {
                tiempo();
            }
            
            
            //aqui pasamos a la siguiente imagen
            $("#imageWrapper").css("-webkit-filter", "blur(15px)");
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
            
            //SABER SI LLEGA AL FINAL DE LAS IMAGENES
            if(num_imagenes_total<numerico)
            {
                //alert ("fin imagenes");
                $("#bienvenida").css("display", "none");
                $("#id_imagen").css("display", "none");
                $("#hitButtonWrapper").css("display", "none");
                $("#resultado").css("display", "none");
                $("#campo_texto").css("display", "none");
        
                $("#pantallaFinal").css("display", "block");
                $("#contenedor").css("display", "none");
                
                if(aciertos=="")
                {
                    $("#fotos_acertadas").html("0");
                    $("#puntos_ganados").html("0");
                }
                else
                {
                    $("#fotos_acertadas").html(aciertos);
                    $("#puntos_ganados").html((aciertos*100)-(i*50));
                }
                    
                
                if(fallos=="")
                    $("#fotos_falladas").html("0");
                else
                    $("#fotos_falladas").html(fallos);
                        
                /*$("#fotos_acertadas").html(aciertos);
                $("#fotos_falladas").html(fallos);*/
                
                        
                //alert ("FIN JUEGO NUM: " +num_imagenes_total+ " numerico: "+numerico)
            }
            else
            {
                //alert ("continuamos");
                //alert ("CONTINUAL JUEGO NUM: " +num_imagenes_total+ " numerico: "+numerico)
                
                //limpio el campo de texto
                $("#cuadroTexto").val("");
                //limpiar texto acierto y fallo
                $('#acierto').toggle();
                $('#fallo').toggle();
                //hacer visible boton siguiente
                $('#siguiente').show();
                //hacer visible boton pista
                $('#hitButtonWrapper').show();
                $("#campo_texto").css("display", "block");
                
                $("#pantallaFinal").css("display", "none");

            }
                       
}

//var segundos = 90; //Segundos de la cuenta atrás 
    function tiempo(){  
  var t = setTimeout("tiempo()",1000);  
  document.getElementById('contenedor').innerHTML = '<b>Tiempo de juego '+segundos--+" seg.</b>"; 
  //alert ("hola"); 
  if(segundos<2){
        //alert ("dentro");
        //window.location.href='http://www.google.es';  //Págiana a la que redireccionará a X segundos
        $("#bienvenida").css("display", "none");
        $("#id_imagen").css("display", "none");
        $("#hitButtonWrapper").css("display", "none");
        $("#resultado").css("display", "none");
        $("#campo_texto").css("display", "none");
        $("#contenedor").css("display", "none");
        
        $("#pantallaFinal").css("display", "block");
        
        if(aciertos=="")
        {
            $("#fotos_acertadas").html("0");
            $("#puntos_ganados").html("0");
        }
        else
        {
         
            $("#fotos_acertadas").html(aciertos);
            $("#puntos_ganados").html((aciertos*100)-(i*50));   
        }
        
        if(fallos=="")
            $("#fotos_falladas").html("0");
        else
            $("#fotos_falladas").html(fallos);
        
        
  
   clearTimeout(t);  
  }  
 }  