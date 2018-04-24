<link rel="stylesheet" href="plugins/select2/select2.min.css" />
<script src="plugins/jquery.table2excel.js"></script>



<style>

.btn-success{
background: -webkit-gradient( linear, left top, left bottom, color-stop(0.05, #25a068), color-stop(1, #00cc0b) );
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


    	 $.get("pages/backend/includes/ci.php", { param_id: id}, function(data){

	     $("#ci").html(data);


      });
   })


        $("#contra").change(function (oe) {

        	 $('#fecha_inicio_detalle').removeAttr("disabled")

      });

      $("#fecha_inicio_detalle").change(function () {

     	 $('#fecha_fin_detalle').removeAttr("disabled")

     });

        $("#fecha_fin_detalle").change(function () {

     	 $('#generar').removeAttr("disabled")

     })

   });


function genera_reporte() {

var contrato=document.getElementById("contra").value;
var f_ini=document.getElementById("fecha_inicio_detalle").value;
var f_fin=document.getElementById("fecha_fin_detalle").value;


var parametros = {
        "contrato": contrato,
        "f_ini": f_ini,
        "f_fin": f_fin
    };
    $.ajax({
        data: parametros,
        url: 'pages/backend/detalle_evento_ci_contra.php',
        type: 'post',

        success: function (response) {
            $("#resultado1").html(response);
        }
    });

}


</script>


<div class="box box-default">
	<div class="box-header with-border">
		<h3 class="box-title">Eventos por CI</h3>


		<div class="box-body">
			<div class="row">


					<div class="col-md-6">
						<div class="form-group">

							<label>Contrato</label> <select id="contra" required
								name="contrato" class="form-control" style="width: 100%;"></select>

							       <label>Fecha de inicio </label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input id="fecha_inicio_detalle" name="fecha_inicio"  class="form-control" type="date" required disabled="disabled">
                    </div>


                       <label>Fecha de finalización </label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input id="fecha_fin_detalle" name="fecha_inicio"  class="form-control"  type="date"  required disabled="disabled">
                    </div>



						</div>

	        <button id="generar" onclick="genera_reporte()" class="btn btn-primary pull-left" disabled="disabled">Generar reporte</button><br><br><br><br>





				</div>



					<div class="col-md-6">
						<div class="form-group">



						      <div id='resultado1'></div>


						</div>
					</div>




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
