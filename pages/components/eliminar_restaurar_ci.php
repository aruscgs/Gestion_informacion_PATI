<link rel="stylesheet" href="plugins/select2/select2.min.css" />
<script src="plugins/jquery.table2excel.js"></script>


<style>
#table{
    margin-top: 12px;
}

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
	padding: 15px;
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

.select2-container--default .select2-selection--single {
	border-radius: 0;
	border-color: #d2d6de;
	width: 100%;
	height: 34px;
}
</style>
<style>
.scrollbar {
	margin-left: 30px;
	float: left;
	height: 300px;
	width: 65px;
	background: #F5F5F5;
	overflow-y: scroll;
	margin-bottom: 25px;
}

.select2-container--default .select2-selection--single {
	border-radius: 0;
	border-color: #d2d6de;
	width: 100%;
	height: 34px;
}

#gestionar_procesos {
	margin-left: 131px;
}
</style>

<script type="text/javascript">
	/* $(document).ready(function(){
    // $("#contra").load("pages/backend/includes/contrato.php");

     $("#contra").change(function (oe) {
    	 var id = $(this).val();

    	  $("#conmasivo").val(id);
    	 //var opt = $('option[value="'+$(this).val()+'"]');
    	 //var id = opt.attr('id'); 		
    	 $.get("pages/backend/includes/ci.php", { param_id: id}, function(data){
         
	     $("#ci").html(data);
	     
	     $("#tipo_ci").val();
	     
      });
   })
   
   
      
     
   });*/



   
</script>


<div class="box box-default">
	<div class="box-header with-border">
		<h3 class="box-title">CI</h3>
		<!-- Barra de progreso -->
		<div class="progress progress-sm active">
			<div class="progress-bar progress-bar-success progress-bar-striped"
				role="progressbar" aria-valuenow="20" aria-valuemin="0"
				aria-valuemax="100" style="width: 40%"></div>
		</div>


			<ul class="buttons">
				<li><input required id="eliminar" class="radiobtn"
					name="rbtnBusqueda" type="radio" value="eliminar_ci" tabindex="1"
					onclick="ci_lista_eliminar()"> <span></span> <label for="eliminar" id="r1">Eliminar
						CI</label> <input required id="recuperar" class="radiobtn"
					name="rbtnBusqueda" type="radio" value="recuperar_ci" tabindex="2"
					onclick="ci_lista_recuperar()"> <span></span> <label for="recuperar" id="r2">Recuperar
						CI</label><br>
			
			</ul>

			<div class="box-body">
				<div class="row">


					<div class="col-md-6">
						<div class="form-group">

							<label>Contrato <font color="red">*</font></label> <select id="contra" 
								name="contrato" class="form-control" style="width: 100%;"
								disabled onchange = "valida_opcion()"></select>

                     			<table id="table">
						<tr>
						
						<td>
						
						<button id="btn_elimina" class="btn btn-success pull"
							onclick="elimina_ci()" style="display: none;">Eliminar CI</button>
							
							<button id="btn_recupera" class="btn btn-success pull"
							onclick="recupera_ci()" style="display: none;">Recuperar CI</button>
							</td>
						<td>

						<a  href="index.php"><button id="cancelar" type="button"
								class="btn btn-danger" style="display: none;">Cancelar</button></a></td>
                       </tr>
                       </table>


						</div>
						
						

					</div>


					<div class="col-md-6">
						<div class="form-group">


							<label>Selecciona CI <font color="red">*</font></label> <select disabled id="ci" 
								name="sci" class="form-control" style="width: 100%;"></select>

                            <input type="hidden" name="cedula" id="id_persona" value="<?php echo $userinfo->user_id?>">

						</div>
					</div>


				</div>

			</div>
	</div>

</div>


<div id="resultado"></div>


<script src="plugins/select2/select2.full.min.js"></script>
<script>

    $(function (){
    	$("select").select2();
     });
    </script>




<script>

function valida_opcion() {

    var  valor_opcion = $('input[name="rbtnBusqueda"]:checked').val();

    var contrato=document.getElementById("contra").value;
   if(valor_opcion=="eliminar_ci"){
    $.get("pages/backend/includes/ci.php", { param_id: contrato}, function(data){
                 
	     $("#ci").html(data);
    });
   }else{
	   $.get("pages/backend/includes/ci_eliminados.php", { param_id: contrato}, function(data){
           
		     $("#ci").html(data);

		   });
   }
	
}

	function elimina_ci(valor_opcion){
      var contrato=document.getElementById("contra").value;
      var ci=document.getElementById("ci").value;
      var  valor =  $('input[name="rbtnBusqueda"]:checked').val();
      var cedula=document.getElementById("id_persona").value;

       
      if(contrato==0 || ci==0){


  		alertify.alert('<b>Los campos que están marcados con </b><font color="red">*</font><b> son de caracter <font color="red">OBLIGATORIO</font></b>', function(){ alertify.success('Ok') });

          }else{

        		alertify.confirm( 'Desea eliminar el CI seleccionado?', function (e) {
        		    if (e) {
        		  
        		        var parametros = {
        	                      "contrato": contrato,     
        	                      "ci": ci,
        	                      "valor": valor,
        	                      "cedula":cedula
        	                  };
        	                  $.ajax({
        	                      data: parametros,
        	                      url: 'pages/backend/eliminar_restaurar_ci.php',
        	                      type: 'post',
        	                     
        	                      success: function (response) {
        	                          $("#resultado").html(response);
        	                         // location.reload(true);
        		                      setTimeout('document.location.reload()',5000);
          	                          
        	                          
        	                      }
        	                  });

        		    	
        		    } else {
        		    	alertify.error('Cancelado');
        		    }
        		});   

        	  
       


              }

		}


	function recupera_ci() {

	      var contrato=document.getElementById("contra").value;
	      var ci=document.getElementById("ci").value;
	      var  valor =  $('input[name="rbtnBusqueda"]:checked').val();
              var cedula=document.getElementById("id_persona").value;
	     
          if(contrato==0 || ci==0){


	  		alertify.alert('<b>Los campos que están marcados con </b><font color="red">*</font><b> son de caracter <font color="red">OBLIGATORIO</font></b>', function(){ alertify.success('Ok') });

	          }else{

	        		alertify.confirm( 'Desea recuperar el CI seleccionado?', function (e) {
	        		    if (e) {
	        		  
	        		        var parametros = {
	        	                      "contrato": contrato,     
	        	                      "ci": ci,
	        	                      "valor": valor,
	        	                      "cedula":cedula
                                            };
	        	                  $.ajax({
	        	                      data: parametros,
	        	                      url: 'pages/backend/eliminar_restaurar_ci.php',
	        	                      type: 'post',
	        	                     
	        	                      success: function (response) {
	        	                          $("#resultado").html(response);
	        	                          //location.reload(true);
	        		                        setTimeout('document.location.reload()',5000);
		        	                          
	        	                      }
	        	                  });

	        		    	
	        		    } else {
	        		    	alertify.error('Cancelado');
	        		    }
	        		});   

	        	  
	       


	              }
			
		
	}


  function ci_lista_eliminar() {

		$("#contra").load("pages/backend/includes/contrato.php");
}

  function ci_lista_recuperar() {

		$("#contra").load("pages/backend/includes/contrato.php");
}

	
    $("#eliminar").on("click", function(){
      //var x = document.getElementById("responsable");
       
  	  $('#contra').removeAttr('disabled');
  	  $('#ci').removeAttr('disabled');
      document.getElementById('btn_elimina').style.display = 'block';
      document.getElementById('cancelar').style.display = 'block';
      document.getElementById('btn_recupera').style.display = 'none';
      
 
   });  

    $("#recuperar").on("click", function(){
        //var x = document.getElementById("responsable");
      $('#contra').removeAttr('disabled');
  	  $('#ci').removeAttr('disabled');
  	  document.getElementById('btn_elimina').style.display = 'none';
      document.getElementById('cancelar').style.display = 'block';
      document.getElementById('btn_recupera').style.display = 'block';

      document.getElementById("contra").value = "fmrjfnrjnfjn";
      
      
    	   });  

	
  </script>
