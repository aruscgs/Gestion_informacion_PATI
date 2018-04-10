<link rel="stylesheet" href="plugins/alertify.default.css">
<link rel="stylesheet" href="plugins/alertify.core.css">
<script src="plugins/alertify.min.js"></script>

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


