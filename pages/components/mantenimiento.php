<?php
$query = "SELECT correo FROM new_personas where cedula='$userinfo->user_id'";
$mail = $wish->conexion->query ( $query );

$query = "select * from proyecto";
$rea = $wish->conexion->query ( $query );

$queryContratos = "SELECT codigo,alias FROM new_lider_contratos where id_lider = $lider_id;";
$rContratos = $wish->conexion->query ( $queryContratos );

?>
<div class="row">
	<!-- /.col -->
	<div class="col-md-12 col-md-offset-0">
		<div class="box box-danger">
			<div class="box-header with-border">
				<h3 class="box-title">Crear Mantenimiento</h3>
			</div>
			<!-- /.box-header -->
			<form method="post" action="pages/backend/enviarmantenimiento.php">
				<div class="box-body">
					<div class="form-group">

						<!--  Elementos ocualtos  -->
						<input class="form-control" name="correo" id="correo"
							type="hidden"
							value="<?php while ( $row = $mail->fetch_array ( MYSQLI_NUM ) ) {echo $row [0];}?>">
						<input class="form-control" name="nombre" type="hidden"
							id="nombre" value="<?php echo $_SESSION['user_name']; ?>">
					</div>

					<div class="col-md-4">
						<div class="form-group">
							<label>Contrato</label> 
							<select id="id_contrato" 	name="id_contrato" style="width: 100%"
								class="form-control select2" required>
								<option value="" id=""></option>            
                  <?php
																		while ( $row = $rContratos->fetch_object () ) {
																			?>

                    <option id="<?php echo $row->codigo; ?>"
									value="<?php echo $row->codigo; ?>"><?php echo $row->alias;?></option>
                    <?php } ?>  
                </select> <label>Fecha inicio y Fecha fin</label> <input
								type="text" class="form-control" style="width: 100%"
								name="horainiciohorafin" id='horainiciohorafin'
								value="01/01/2017 1:30 PM - 01/01/2017 2:00 PM" />
						</div>
					</div>
					<div class="col-md-7"> 
					<div class="form-group">
						<label>Dispositivos</label>
						<textarea id="textarea" id="dispositivos" style="width: 100%;height: 90px" name="dispositivos"
							required class="form-control">
                
                    </textarea>


					</div>
					</div>
					<div class="col-md-12"> 
					 <div class="form-group">
						<label>Descripción</label>
						<textarea id="compose-textarea" id="mensaje" name="mensaje"
							required class="form-control" style="height: 250px">
                
                    </textarea>
					</div> 
					</div>
				</div>


				<!-- /.box-body -->
				<div class="box-footer">
					<div class="pull-right">

						<button type="submit" class="btn btn-success">
							<i class="fa fa-envelope-o"></i> Enviar
						</button>
					</div>
					<a href="index.php"><button type="reset" class="btn btn-danger">
							<i class="fa fa-times"></i> Cancelar
						</button></a>
				</div>
				<!-- /.box-footer -->

			</form>

		</div>
		<!-- /. box -->
	</div>
	<!-- /.col -->
</div>

<script src="plugins/iCheck/icheck.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script
	src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Page Script -->
<script type="text/javascript">
$(function() {
    $('input[name="horainiciohorafin"]').daterangepicker({
        timePicker: true,
        timePickerIncrement: 30,
        locale: {
            format: 'MM/DD/YYYY h:mm A'
        }
    });
});
</script>
<script>
  $(function () {
    //Add text editor
    $("#compose-textarea").wysihtml5();
  });
</script>


