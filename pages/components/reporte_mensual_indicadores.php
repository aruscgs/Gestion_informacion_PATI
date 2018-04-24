<link rel="stylesheet" href="plugins/alertify.default.css">
<link rel="stylesheet" href="plugins/alertify.core.css">
<script src="plugins/alertify.min.js"></script>

<style type="text/css">
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

<?php
$con = new conexion();
$meses = $con->conexion->query("select * from mes");


$permiso_administrador=$conexion->conexion->query("select administrar from permiso_indicador
 where cedula='$userinfo->user_id'");

$permiso=$permiso_administrador->fetch_assoc();

$permisos=$permiso["administrar"];


if ($permisos != 0){


    ?>




<div class="box box-default" >
	<div class="box-header with-border">


		<br>
		<!-- Barra de progreso -->

		<form name="formulario" id="formulario" action=""
			onSubmit="consulta_promedio(); return false">

			<div class="box-body">


				<div class="col-md-6">

					<div class="form-group">




						<label>MES</label>

						<select class="form-control" id="meses"
							onchange="validar()" name="mes" required>

							<option value="0"></option>

       <?php while($mes=$meses->fetch_assoc()){?>

            <option
								value="<?php echo $mes["id_mes"]?>.'-'.<?php echo $mes["descripcion"]?>"><?php echo $mes["descripcion"]?></option>

            <?php }?>
     </select> <br> <br>

						<button type="submit" name="aceptar"
							class="btn btn-success pull-leftt" style="width: 150px;">Aceptar</button>

						<a href="index.php"><button id="cancelar_asignacion" type="button"
								class="btn btn-danger" style="width: 150px;">Cancelar</button></a>

					</div>

				</div>

				<div class="col-md-6">

					<div class="form-group">


						<label>AÑO</label>

						<select class="form-control" id="anos"
							onchange="validar()" name="ano" required>

							<option value="0"></option>

<?php
for ($i = 2017; $i <= 2040; $i ++) {
    echo "<option value='$i'>$i</option>";
}
?>
     </select> <br>


					</div>



				</div>



			</div>


		</form>


	</div>

	<div id="resultado"></div>


</div>



<?php }else{?>

            <script>

    alertify.alert("<b>No estás autorizado para ingresar a ésta página", function () {
	 location.href="index.php";
    });


 </script>


<?php }?>

<script>
       function consulta_promedio()
{

    	   var mes=document.getElementById("meses").value;

    	   var ano=document.getElementById("anos").value;

    	   if((mes != '0') && (ano != '0')){

	$.ajax({

		type:  'POST',

		url:   'pages/backend/promedio_indicadores.php',

        data: $("#formulario").serialize(),

    	success: function (response) {
            $("#resultado").html(response);
        }
});
    	   }else{

    		   alertify.alert("<b>LOS CAMPOS MES Y AÑO SON <BR><font color=\"red\">OBLIGATORIOS</font>");

        	   }

	//window.setTimeout('location.reload()');
}
       </script>




<div class="col-md-6">





</div>
