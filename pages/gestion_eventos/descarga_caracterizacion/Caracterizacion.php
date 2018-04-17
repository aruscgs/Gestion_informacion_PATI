<link rel="stylesheet" href="plugins/select2/select2.min.css" />
<script src="plugins/jquery.table2excel.js"></script>

<style>

.btn-success {
    background-color: #00a65a;
    border-color: #008d4c;
    margin-left: 1%;
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

			 exportar_caracterizacion.click();
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
		<h3 class="box-title">Selecciona Contrato</h3>
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
						</div>
					</div>
          <div class="col-md-6">
            <a class="btn btn-primary pull-left" id="exportar_caracterizacion" style="display: none;"
    					onclick="valida_carac()"> <i class="glyphicon glyphicon-level-up"
    					title="Exporta caracterizacón del contrato elegido" id="export_carac"></i>
    					<b>Generar Caracterizacion</b>
    				</a>
          </div>
				</form>
</br>

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
