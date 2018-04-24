<link rel="stylesheet" href="plugins/select2/select2.min.css" />
<script src="plugins/jquery.table2excel.js"></script>



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

</style>

<script type="text/javascript">
	 $(document).ready(function(){

     $("#contra").load("pages/backend/includes/contrato.php");

     $("#contra").change(function (oe) {
    	 var id = $(this).val();

    	 $('#plataforma').removeAttr("disabled");
    	 $('#buscar').removeAttr("disabled");


    	$.get("pages/backend/includes/plataformas.php", { param_id: id}, function(data){

	     $("#plataforma").html(data);

	     $("#tipo_ci").val();

      });
   })


        $("#plataforma").change(function (oe) {

$('#year').removeAttr("disabled");

      });

     $("#year").change(function (oe) {

    	 $('#month').removeAttr("disabled");

       });





   });

<?php


$con=new conexion();

$meses=$con->conexion->query("select * from mes");

?>


</script>


<div class="box box-default">


	<div class="box-header with-border">



		<h3 class="box-title">Editar análisis de informes.</h3>
		<!-- Barra de progreso -->
		<div class="progress progress-sm active">
			<div class="progress-bar progress-bar-success progress-bar-striped"
				role="progressbar" aria-valuenow="20" aria-valuemin="0"
				aria-valuemax="100" style="width: 40%"></div>
		</div>

		<div class="box-body">
			<div class="row">


			    <form onsubmit="buscar_analisis(); return false">
					<div class="col-md-6">



						<div class="form-group">



							<label>Contrato</label> <select id="contra" required
								 name="contrato" class="form-control" style="width: 100%;"></select>

							<label>Plataforma</label>

							<select id="plataforma" required name="plataformas"
								class="form-control" disabled="disabled" style="width: 100%;">


								</select>








						</div>

						 <button type="submit" id="buscar" disabled="disabled" class="btn btn-success" onclick="valida()">Buscar</button>
                        <a href="index.php"><button type="button" class="btn btn-primary">Cancelar</button></a>
					</div>

					<div class="col-md-6">
						<div class="form-group">





				                <label>Año</label>

         <select required disabled id="year"  name="years"  class="form-control" style=" width: 100%;">
         <option value="" disabled selected></option>


<?php
for ($i = 2017; $i <= 2040; $i ++) {
    echo "<option value='$i'>$i</option>";
}
?>


        </select>





								<label>Mes</label>
								<select id="month" required name="months"
								class="form-control"  disabled style="width: 100%;">

								         <option value="" disabled selected></option>


								<?php while($row=$meses->fetch_assoc()){?>

								<option value="<?php echo $row["id_mes"]?>"><?php echo $row["descripcion"]?></option>

								<?php }?>
								</select>




						</div>
					</div>

				</form>



			</div>

		</div>

	</div>
</div>


<div id="tabla"></div>

<script src="plugins/select2/select2.full.min.js"></script>
<script>

    $(function (){
    	$("select").select2();
     });



    function buscar_analisis() {

       var contrato=document.getElementById("contra").value;
       var plataforma=document.getElementById("plataforma").value;
       var ano=document.getElementById("year").value;
       var mes=document.getElementById("month").value;


       var parametros = {
               "contrato": contrato,
               "plataforma": plataforma,
               "ano": ano,
               "mes": mes,
           };
       $.ajax({
           data: parametros,
           url: 'pages/backend/edita_analisis.php',
           type: 'post',

           success: function (response) {
         	  //alertify.alert('<b>Registros guardados correctamente');
             $("#tabla").html(response);
           	 //setTimeout('document.location.reload()',5000);
           }
       });



        }



    $("#crear_analisis").on("click", function(){
      //var x = document.getElementById("responsable");

  	  $('#contra').removeAttr('disabled');
  	 // $('#clientes').attr('disabled','disabled');
  	 //$('#first').attr('selected','selected');

    });

    $("#editar_analisis").on("click", function(){
        //var x = document.getElementById("responsable");
       // document.getElementById('tabla').innerHTML='';
    	  $('#contra').removeAttr('disabled');
    	 // $('#clientes').removeAttr('disabled');

      });


    </script>
