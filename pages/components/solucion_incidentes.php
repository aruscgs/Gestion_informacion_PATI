<link rel="stylesheet" href="plugins/select2/select2.min.css"/>
<link rel="stylesheet" href="plugins/alertify.default.css">
<link rel="stylesheet" href="plugins/alertify.core.css">
<script src="plugins/alertify.min.js"></script>




<!--SCRIPT PARA EL SELECT INDIVIDUAL-->
<script type="text/javascript">
      $(document).ready(function () {

                $("#evento").change(function () {
                    $("#evento option:selected").each(function () {
                        var id = $(this).val();
                        $.get("pages/backend/includes/detalles_evento.php", {param_id: id}, function (data) {
                            $("#info_evento").html(data)
                        });
                    }) 
                })

                $("#info_evento").change(function () {
                    $("#info_evento option:selected").each(function () {

                        var id = $(this).val();
                        $.get("pages/backend/includes/ip.php", {info_id: id}, function (data) {
                        });
                    })
                })
            });
        </script>


<!--SCRIPT PARA EL SELECT MASIVO-->
<script type="text/javascript">
            $(document).ready(function () {

                $("#evento_masivo").change(function () {
                    $("#evento_masivo option:selected").each(function () {
                        var id = $(this).val();
                        $.get("pages/backend/includes/detalles_evento_masivo.php", {param_id: id}, function (data) {
                            $("#info_evento").html(data)
                        });
                    })
                })

                $("#info_evento").change(function () {
                    $("#info_evento option:selected").each(function () {

                        var id = $(this).val();
                        $.get("pages/backend/includes/ip.php", {info_id: id}, function (data) {
                            $("#ip").val(data);
                        });
                    })
                })
            });
        </script>
        
<!--SCRIPT PARA CONSULTA SOLUCION-->
   
<script type="text/javascript">

        function indivi(data, numero)
        {

			
		var valor=data, cedula=numero;
		
        	$.ajax({
                
        		type:  'POST',
        		
        		url:   'pages/backend/includes/consulta_solucion.php',
        		
                data: { individual: valor, cedula: numero},

                success: function(data)
                {
                    $("#evento").html(data);
                },
        	});
        }
        </script>


<script>
            function habilitar(value)

            {
                if (value == "1")

                {
                    // habilitamos
                    document.getElementById("segundo").disabled = false;
                } else if (value == "2") {
                    // deshabilitamos
                    document.getElementById("segundo").disabled = true;
                }
            }
        </script>


<style>


   
input, select {
	max-width: 400px;
	margin: auto;
}

td {
	text-align: center;
}

#tabla {
	margin: auto;
	width: 90%;
}

textarea.foo {
	resize: none;
}
</style>


<!-- style radio buttons -->

<style>
.input__row {
	margin-top: 10px;
}
/* Radio button */
.radiobtn {
	display: none;
}

.buttons {
	margin-left: -40px;
}

.buttons li {
	display: block;
}

.buttons li label {
	padding-left: 30px;
	position: relative;
	left: -25px;
}

.buttons li span {
	display: inline-block;
	position: relative;
	top: 5px;
	border: 2px solid #ccc;
	width: 18px;
	height: 18px;
	background: #fff;
}

.radiobtn:checked+span::before {
	content: '';
	border: 2px solid #fff;
	position: absolute;
	width: 14px;
	height: 14px;
	background-color: #c3e3fc;
}
.select2-container--default .select2-selection--single
{
	border-radius: 0;
    border-color: #d2d6de;
    width: 100%;
    height: 34px;
}

   .overlay{
        display: none;
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: #000;
        z-index:1001;
        opacity:.75;
        -moz-opacity: 0.75;
        filter: alpha(opacity=75);
    }
    
    #content{
        width: 67%;
        
   
    }
    /* estilo para lo q este dentro de la ventana modal */
   #aceptar {
    background-color: #3c8dbc;
    border-color: #367fa9;
      width: 251px;
}
#cancel {
    background-color: #f4f4f4;
    color: #444;
    border-color: #ddd;
    width: -webkit-fill-available;
}
td {
    text-align: inherit;
}
.modal-header {
    border-bottom-color: #f4f4f4;
    text-align: -webkit-center;
        background: #337ab7;
            width: 454px;
}
.modal-title {
    margin: 0;
    line-height: 1.42857143;
    color: white;
}


.modal-content{
    width: fit-content;
}
.form-control {

    height: auto;
}

#content {
    margin: 0px;
    height: 179px;
    width: 424px;
    border: inset;
}
#cancel {
    margin-left: 17px;
}
#aceptar {
    background-color: #3c8dbc;
    border-color: #367fa9;
    width: 183px;
    margin-left: 37px;
}
</style>





<br>
<?php
$oe = new conexion ();
$escala = $oe->conexion->query("SELECT distinct a.nombre, a.correo, a.celular, b.area, c.id, c.contacto, a.cedula FROM new_personas a,
								areas b, sub_grupo c, new_usuario d WHERE c.cedula=a.cedula and a.cedula=d.cedula
								and b.id=d.area and d.area in (9, 10, 11, 12) order by 4 asc");

//$query1 = $oe->conexion->query ( "SELECT distinct id_evento FROM registro_masivo where estado='P'" );
?>


<div class="box box-info">

	<div class="box-body">
		<h3 class="box-title">Solución de incidentes</h3>
		<br> 
		<!-- Barra de progreso -->

			<div class="col-md-5">
			
				<div class="form-group">

					<LABEL>TIPO DE EVENTO</LABEL><br> 

					<div class="input__row">
					 
						<ul class="buttons">
							<li>
							<input id="mostrar_evento" onclick="indivi('individual',<?php echo $userinfo->user_id?>);" class="radiobtn" name="evento" type="radio" value="individual" tabindex="1"> <span></span> <label
								for="mostrar_evento"  id="r1">Evento</label>
							
							
								<input id="mostrar_evento_masivo" onclick="indivi('masivo',<?php echo $userinfo->user_id?>);" class="radiobtn" name="evento" type="radio" value="masivo" tabindex="2"> <span></span> <label
								for="mostrar_evento_masivo" id="r2">Evento masivo</label></li>
						</ul>
					</div>

					<label>ID DEL EVENTO</label> 
					<select class="form-control select2" name="id_evento" id="evento" style=" width: 100%;" required>
					
					</select>
                            
                   <label>NÚMERO DEL TICKET</label>

					<input type="text" name="ticket" class="form-control"  style="max-width: 600px;" id="tiquet"> 
					<label>TIPO</label> 
					
						<select class="form-control" id="tipo" name="tipo" required="required" style="width: 100%;" required>
						<option></option>
						<option>Requerimiento</option>
						<option>Incidente</option>
					
					
					</select><br> <LABEL>HUBO CAMBIO</LABEL><br>

					<div class="input__row">
						<ul class="buttons">
							<li><input id="cambio_si" class="radiobtn"  name="rbtncambio" type="radio" value="si" tabindex="1"> <span></span> 
							<label for="cambio_si" id="r1">Si</label> 
							<input id="cambio_no" class="radiobtn" name="rbtncambio" type="radio" value="no" tabindex="2" > <span></span> <label for="cambio_no" id="r2">No</label><br>
								<label>NUM RFC</label> <input type="number" name="rfc_num" id="rfc"
								class="form-control" readonly></li>


						</ul>

					
					<hr>
	<div class="col-md-6" style="width: 100%;">
		<div class="form-group" >
			<div class="input-group">
			
			<select class="form-control" disabled id="responsable" style="width: 100%;">
						<option value="" disabled selected> Cambiar el responsable </option>
							<?php 
							 while ($row3 = $escala->fetch_row())
						    {
						    	echo '<option value="'.$row3[6].'">'.ucwords(strtolower($row3[0]))." ---> " . $row3[3].'</option>';
						    }
    					?>
					</select>
					
					
				<div class="input-group-addon " style=" padding: 0px;">
						<button id="ver" data-toggle="modal" data-target="#myModal" class="btn btn-info pull-left" style="height: 32px; padding: 7px;" type="button" title="Ver Información">Info</button>
				</div>	
				
				
				<!-- SEN ENVIA OCULTO LA CEDULA DEL USUARIO -->
				<input type="hidden" id="usuario" name="usuario" value="<?php echo $userinfo->user_name;?>">
				<input type="hidden" id="usuario_cedula" name="id_usuario" value="<?php echo $userinfo->user_id;?>">
				
				<div class="input-group-addon" style=" padding: 0px;">
						<button id="btnenviar" disabled class="btn btn-primary pull-right" style="height: 32px; padding: 7px;" type="button" title="Transferir">Enviar</button>
				</div>
			</div><textarea class="form-control" placeholder="Para Transferir el evento debe revisar la información" disabled id="nota" name="nota" required></textarea>
		</div>
	</div>
					
					
					
					
					
					
					</div>
				</div>
			</div>



			<div class="col-md-6">
				<div class="form-group">

					
					<label id="info_evento"
						class="foo"  style="width: 50%;"> 
						
					</label> <br>
					
					<br> <br> <label>FECHA Y HORA DE CIERRE DEL EVENTO</label><br> 
					
					<input
						type="datetime-local" style="max-width: 600px;" name="fecha_fin" class="form-control" id="fecha_fin" required>
						
						
						<label>DETALLES</label><br>

					<textarea id="detalles_evento" class="form-control" rows="4"  name="detalles" style="resize: none" ></textarea>
					<br>



				</div>
				
			</div>
			
		
	</div>
<a href="index.php"><button type="button" style="margin: 25px;" class="btn btn-danger">Cancelar</button></a>
				<button  style="margin: 25px;" class="btn btn-success pull-right" data-target="#myModal_info" data-toggle="modal" onclick="datos_modal()" id="btnRegistrar">Registrar
					evento</button>
					<hr>
	
</div> 


<!-- INICIO DE MODAL  -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
		<div style=" border-radius:10px;" id="modalesc" class="modal-content">
		<div class="modal-header">
		<button type="button" class="btn btn-default pull-right" data-dismiss="modal" aria-hidden="true">&times;</button>
		</div>
		<div class="modal-body">
		<div class="col-md-13">
		<div class="box box-info">
		<div class="box-body">
        
        <label style="font-size: 20px;">Transferencia de un Evento Masivo</label> <br><br>
        
        <div id="resultado">
        
        	<p>Para transferir un evento a otra persona debe poner el descarte que se hizo y el porqué lo transfiere. 
        
        	</p>
		</div> 
		<!-- <button type="button" class="btn btn-danger pull-right butt" data-dismiss="modal" aria-hidden="true">Cerrar</button> -->
		
		</div>							
		 </div>
		  </div>
		    </div>
			<div class="modal-footer"></div>
			</div>
		</div>
	</div>
	<!-- FIN DE MODAL -->


     <script src="plugins/select2/select2.full.min.js"></script>
    <script>
	     $(function () {
	    $("select").select2();
	     });
    </script>

<script>
$("#btnenviar").on("click", function(){

	var w=$("#usuario").val();
	var x=$("#responsable").val();
	var y=$("#evento").val();
	var z=$("#nota").val();
	
	window.location.href = 'pages/backend/rotar_escala.php?valor='+x+'&id_even='+y+'&nota='+z+'&usuario='+w+'';

	});
/*

           $(document).ready(function () {
               $("#mostrar_evento").on("click", function () {
                   $('#a').hide();
                   $('#evento_masivo').hide();
                   $('#evento').show(); //muestro mediante id

                   document.getElementById('evento_masivo').selectedIndex = 0;

               });
               $("#mostrar_evento_masivo").on("click", function () {
                   $('#a').hide();
                   $('#evento').hide(); //oculto mediante id
                   $('#evento_masivo').show();

                   document.getElementById('evento').selectedIndex = 0;

               });
           });*/
       </script>

<!--SCRIPT PARA HABILITAR Y DESHABLITAR-->
<script>
/*$("#mostrar_evento").on("click", function(){
  //var x = document.getElementById("responsable");

  $('#responsable').attr('disabled','disabled');
  $('#btnenviar').attr('disabled','disabled');
  $('#nota').attr('disabled','disabled');
}); */ 

$("#ver").on("click", function(){

	  $('#btnenviar').removeAttr('disabled');
	}); 

//al precionar el radio boton de evento masivo se habilita el reescalamiento
$("#mostrar_evento_masivo").on("click", function(){
  var x = document.getElementById("responsable");

  $('#responsable').removeAttr('disabled');
  //$('#btnenviar').removeAttr('disabled');
  $('#nota').removeAttr('disabled');
}); 


//al precionar el radio boton de evento  se habilita el reescalamiento
$("#mostrar_evento").on("click", function(){
	  var x = document.getElementById("responsable");

	  $('#responsable').removeAttr('disabled');
	  //$('#btnenviar').removeAttr('disabled');
	  $('#nota').removeAttr('disabled');
	}); 
</script>

<!--SCRIPT PARA HABILITAR Y DESHABLITAR-->
<script>
$("#cambio_si").on("click", function(){
  var x = document.getElementById("rfc");
  
  $('#rfc').removeAttr("readOnly");
});  

$("#cambio_no").on("click", function(){
  var x = document.getElementById("rfc");

  $('#rfc').attr('readOnly','readOnly ');

}); 
</script>

<script>
   function datos_modal()
	     {
	   var id=document.getElementById("evento").value;   	
	   var tipo=document.getElementById("tipo").value;
	   var fecha=document.getElementById("fecha_fin").value;
	   var valor=document.getElementById("detalles_evento").value;
	   
       if((id=="")||(tipo=="")||(fecha=="")||(valor=="")){

    	   alert("DEBES DE DILIGENCIAR CORRECTAMENTE LOS CAMPOS REQUERIDOS!");
    	   javascript:history.go(0);
           }else{

	   var ticket=document.getElementById("tiquet").value;  
	   var rfc=document.getElementById("rfc").value;

       var cedula=document.getElementById("usuario_cedula").value;
      
	   var id_compo = id.split("-");

	   var id_evento = id_compo[0];
	   var tipo_evento=id_compo[1];

	   if(tipo_evento=='ind'){
         tipo_evento='Individual';
		   }else{
           tipo_evento='Masivo'; 
			    }

	   $('#tipo_evento').val(tipo_evento);
	   $('#id_evento').val(id_evento);
	   $('#ticket').val(ticket);
	   $('#tipo_incidente').val(tipo);
	   $('#detalle').val(valor);   
	   $('#rfc_number').val(rfc);
	   $('#fecha_final').val(fecha);
	   $('#cedula').val(cedula);

	   addVal(tipo_evento,id_evento,ticket,tipo,valor,rfc,fecha,cedula);
           }
	  
	     }

</script>







 
<!-- Modal -->
  <div class="modal fade" id="myModal_info" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">INFORMACIÓN GENERAL DE LA SOLUCIÓN</h4>
        </div>
        <div class="modal-body" >
  
  <textarea id="content" readonly style="resize:none;"> </textarea>
  
      <form method="post" action="pages/backend/solucion_incidentes.php">	
       	<table>
       	<tr>
       	<!--<td><label>TIPO DE EVENTO:</label></td>  -->
       	<td><input id="tipo_evento" name="tipo_evento"  class="form-control" type="hidden" required readonly></td>
       	</tr>
       
       	<tr>
       	<!--<td><label>ID DEL EVENTO:</label></td>-->  
       	<td><input id="id_evento" name="id_evento"  class="form-control" type="hidden" required readonly></td>
       	</tr>
       	
       	<tr>
       <!--<td><label>TICKET:</label></td>  -->	
       	<td><input id="ticket" name="ticket"  class="form-control" type="hidden" required readonly></td>
       	</tr>
       	
       	<tr>
       	<!-- <td><label>TIPO DE INCIDENTE:</label></td> -->
       	<td><input id="tipo_incidente" name="tipo_incidente"  class="form-control" type="hidden" required readonly></td>
        </tr>
       
 
        <tr>
       	<!-- <td><label>NUM RFC:</label></td> -->
       	<td><input id="rfc_number" name="rfc_number"  class="form-control" type="hidden" readonly></std>
        </tr>
       
        <tr>       
       	<!-- <td><label>FECHA Y HORA DE CIERRE:</label></td> -->
       	<td><input id="fecha_final" name="fecha_final"  class="form-control" type="datetime-local"  style="display:none" required readonly></td>
        </tr>
        
         <tr>
       	<!-- <td><label>DETALLES:</label></td> -->
       	<td><textarea style="visibility:hidden;" id="detalle" name="detalle" class="form-control" required readonly></textarea></td>
        </tr>

       <tr>
        <td><button id="cancel" type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button></td>
       <td><button id="aceptar" type="submit" class="btn btn-primary" >Guardar</button></td>
       </tr>
        </table>


        
      
    <input type="hidden" id="cedula" name="cedula_usuario">
 
        </div>
        <div class="modal-footer">
    

    </form>
    
    
    
    
        <script>
       
        var signature = document.getElementById("tipo_evento").value;
        function addVal(tipo_evento,id_evento,ticket,tipo,valor,rfc,fecha,cedula){

        	fecha_fin = fecha.replace("T"," / ");

            document.getElementById('content').value ="Tipo de evento: "+tipo_evento +"\nId del evento: "+ id_evento+"\nTicket: "
            +ticket+"\nTipo : "+tipo+"\nNúmero de RFC: "+rfc+"\nFecha y hora de cierre: "+fecha_fin+"\nDetalles: "+valor
           
        }

        </script>
         
       
         
        </div>
      </div>
    </div>
  </div>
</div>

</body>
</html>


