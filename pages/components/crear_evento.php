<link rel="stylesheet" href="plugins/select2/select2.min.css" />
<script src="plugins/jquery.table2excel.js"></script>

<style>
.btn-success{
background: -webkit-gradient( linear, left top, left bottom, color-stop(0.05, #25a068), color-stop(1, #00cc0b) );
margin-right: 10px;
}

.btn-info {
    background: -webkit-gradient( linear, left top, left bottom, color-stop(0.05, #0b98de), color-stop(1, #06a6f5) );
    border-color: #00acd6;
}
.btn-info:hover {
    background: -webkit-gradient( linear, left top, left bottom, color-stop(0.05, #2996cc), color-stop(1, #73b9db) );
    border-color: #00acd6;
}

.btn-success:hover{
	background: -webkit-gradient( linear, left top, left bottom, color-stop(0.05, #408163), color-stop(1, #18a11f) );
}

.btn-danger{
			background: -webkit-gradient( linear, left top, left bottom, color-stop(0.05, #b70e0e), color-stop(1, #d26060) );
	    border-color: #d73925;
}
.btn-danger:hover{
	background: -webkit-gradient( linear, left top, left bottom, color-stop(0.05, #8f0b0b), color-stop(1, #8f5151) );
	border-color: #861709;
}
.btn-primary{
	background: -webkit-gradient( linear, left top, left bottom, color-stop(0.05, #006699), color-stop(1, #008FD6) );
}
.btn-primary:hover{
	background: -webkit-gradient( linear, left top, left bottom, color-stop(0.05, #07496a), color-stop(1, #397999) );
}
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
	 $(document).ready(function(){
     $("#contra").load("pages/backend/includes/contrato.php");

     $("#contra").change(function (oe) {
    	 var id = $(this).val();

    	 //document.getElementById("exportar_caracterizacion").style.display="block";
    	 //document.getElementById("exportar_modelo").style.display="block";


    	 document.getElementById("masivo").style.display="block";
    	 document.getElementById("gestionar_procesos").style.display="block";
			 document.getElementById("barraDownload").style.display="block";

			 exportar_caracterizacion.click();

    	 $("#conmasivo").val(id);
    	 //var opt = $('option[value="'+$(this).val()+'"]');
    	 //var id = opt.attr('id');
    	 $.get("pages/backend/includes/ci.php", { param_id: id}, function(data){

	     $("#ci").html(data);

	     $("#tipo_ci").val();

      })
   });


        $("#contra").change(function (oe) {
    	 var id = $(this).val();

     	 //alert(id);

         crea_caracterizacion(id);

      });

      $("#ci").change(function () {

    	  var id = $(this).val();

         $.get("pages/backend/includes/ip.php", { info_id: id}, function(data){
         $("#ip").val(data);
       });
     })

     $("#ci").change(function () {

    	  var id = $(this).val();

         $.get("pages/backend/includes/tipo_ci.php", { info_id: id}, function(data){
         $("#tipo_ci").val(data);
       });
     })

     $("#ci").change(function () {

    	  var id = $(this).val();
         $.get("pages/backend/includes/ambiente.php", { info_id: id}, function(data){
         $("#ambiente").val(data);
       });
     })

     $("#ci").change(function () {

    	  var id = $(this).val();
         $.get("pages/backend/includes/horario.php", { info_id: id}, function(data){
         $("#ho").val(data);
       });
     })

     $("#ci").change(function () {

    	  var id = $(this).val();
         $.get("pages/backend/includes/servicio_negocio.php", { info_id: id}, function(data){
         $("#sn").val(data);
       });
     })

     $("#ci").change(function () {

    	  var id = $(this).val();
         $.get("pages/backend/includes/servicio_administrado.php", { info_id: id}, function(data){
         $("#sa").val(data);
       });
     })


    $("#ci").change(function () {

    	  var id = $(this).val();
         $.get("pages/backend/includes/plataforma.php", { info_id: id}, function(data){
         $("#plataforma").val(data);
       });
     })

   });



function crea_caracterizacion(id) {

	id = id;


    $.ajax({

    	type:  'POST',

    	url:   'pages/backend/export_carac_model.php',

            data: { id_contrato: id },

            success:  function (data)
            {
               $("#resultado").html(data);

            }
    });
}


</script>


<div class="box box-default">
	<div class="box-header with-border">
		<h3 class="box-title">CI</h3>
		<!-- Barra de progreso -->
		<div class="progress progress-sm active">
			<div class="progress-bar progress-bar-success progress-bar-striped" id="barraDownload" style="width: 40%;"
				role="progressbar" aria-valuenow="20" aria-valuemin="0"
				aria-valuemax="100"></div>
		</div>

		<div class="box-body">
			<div class="row">


				<form method="post" action="index.php?page=025">
					<div class="col-md-6">
						<div class="form-group">

							<label>Contrato</label> <select id="contra" required
								name="contrato" class="form-control" style="width: 100%;"></select>

							<label>Selecciona CI</label> <select id="ci" required name="sci"
								class="form-control" style="width: 100%;"></select> <label>IP</label>
							<input id="ip" class="form-control" name="ip"
								style="width: 100%;" readonly required>

                                                         <label>Servicio Negocio
							</label><br> <input type="text" id="sn" name="sn"
								class="form-control" style="width: 100%;" disabled>


                                                              <label>Servicio Administrado </label><br>
							<input type="text" id="sa" name="sa" class="form-control"
								style="width: 100%;" disabled>
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">



							<label>Ambiente</label> <input id="ambiente" class="form-control"
								style="width: 100%;" disabled> <label>Horario Notificación</label>
							<input id="ho" class="form-control" style="width: 100%;" disabled>

							<label> Tipo </label> <input id="tipo_ci" class="form-control "
								name="tipo_ci" readonly required>


                                                        		<label>Plataforma </label><br>
							<input type="text" id="plataforma" name="plataforma" class="form-control"
								style="width: 100%;" disabled>



						</div>
					</div>

					<button type="submit" class="btn btn-success pull-right">siguiente</button>
				</form>

				<form method="post" action="index.php?page=029">
					<input type="hidden" id="conmasivo" name="conmasivo">
					<button type="submit" class="btn btn-success pull-left" id="masivo"
						style="display: none">Registro Masivo</button>

				</form>

				<form method="post" action="index.php?page=056">
					<input type="hidden" id="id_host_proceso" name="proces">
					<button type="submit" class="btn btn-primary"
						style="display: none;" id="gestionar_procesos" disabled="disabled"
						onclick="gestionar_procesos()">Gestionar procesos</button>
				</form>

</br>

				<a class="btn btn-primary pull-left" id="exportar_caracterizacion" style="display: none;"
					onclick="valida_carac()"> <i class="glyphicon glyphicon-level-up"
					title="Exporta caracterizacón del contrato elegido" id="export_carac"></i>
					<b>Generar Caracterizacion</b>
				</a>

			</div>

		</div>

	</div>
</div>

<script src="plugins/select2/select2.full.min.js"></script>
<script>

    $(function (){
    	$("select").select2();
     });
    </script>





<div id='resultado'></div>








<script>
/*	$("#export_carac").click(function(){
		  $("#mitabla").table2excel({
		    filename: "Caracterización"
		  });
		});
*/

	function valida_carac() {

		var valor_contra=document.getElementById("contra").value;
		if(valor_contra=='0'){

     alertify.alert("Debes elegir un contrato para exportar su caracterización");

			}else{

			    var parametros = {
			            "contrato": valor_contra

			        };
			        $.ajax({
			            data: parametros,
			            url: 'pages/backend/crea_caracterizacion_modelo.php',
			            type: 'post',

			            success: function (response) {
			                $("#resultado").html(response);
			            	//window.setTimeout('location.reload()');

			            }
			        });

				}
	}


/*function valida_model() {
	var valor_contra=document.getElementById("contra").value;
	if(valor_contra=='0'){

 alertify.alert("Debes elegir un contrato para exportar su modelo");
		}else{

			  $("#mitabla_modelo").table2excel({
				    filename: "Modelo"
				  });

			}
}*/

  </script>
