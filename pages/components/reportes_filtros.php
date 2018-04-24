
  <link rel="stylesheet" href="plugins/select2/select2.min.css"/>

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
.btn-info {
    background: -webkit-gradient( linear, left top, left bottom, color-stop(0.05, #0b98de), color-stop(1, #06a6f5) );
    border-color: #00acd6;
}
.btn-info:hover {
    background: -webkit-gradient( linear, left top, left bottom, color-stop(0.05, #2996cc), color-stop(1, #73b9db) );
    border-color: #00acd6;
}
.btn-primary{
	background: -webkit-gradient( linear, left top, left bottom, color-stop(0.05, #006699), color-stop(1, #008FD6) );
}
.btn-primary:hover{
	background: -webkit-gradient( linear, left top, left bottom, color-stop(0.05, #07496a), color-stop(1, #397999) );
}
#logoPati{
    margin-left: -261px;
    width: 336px;
    height: 297px;
    margin-top: -9px;

}
</style>

  <script>
<?php
if ($filtros != false) {
	if (! isset ( $_POST ["filtered"] )) {
		?>
		$(document).ready(function(){
			$("#myModal").modal('show');
			});
			<?php
	}
}
?>
        </script>




<?php
function printTextFilter($filter, $nombre, $requerido) {
	?>

<!-- phone mask -->
<div class="form-group">
	<label><?php echo $nombre;?>:</label>

	<div class="input-group">
		<div class="input-group-addon">
			<i class="fa fa-file-text-o" aria-hidden="true"></i>
		</div>
		<input name="<?php echo $filter;?>" type="text" class="form-control"
			<?php echo $requerido ?>>
	</div>
	<!-- /.input group -->
</div>
<?php
}
function printDateFilter($filter, $nombre, $requerido) {
	?>

<div class="form-group">
	<label><?php echo $nombre;?>:</label>
	<div class="input-group">
		<div class="input-group-addon">
			<i class="fa fa-calendar"></i>
		</div>
		<input name="<?php echo $filter;?>" type="date" class="form-control"
			<?php echo $requerido ?>>
	</div>
	<!-- /.input group -->
</div>
<?php
}


function printSelectFilterMonth($filter, $nombre, $result, $requerido) {
	?>
<!-- phone mask -->
<div class="form-group">
	<label><?php echo $nombre;?>:</label>

	<div class="input-group">
		<div class="input-group-addon">
			<i class="fa fa-list"></i>
		</div>



		<select  class="form-control select2" id="select_item"  style="width: 100%;"
			id="<?php echo $filter;?>" name="<?php echo $filter;?>"
			<?php echo $requerido ?>>

			<option value="" id=""></option>
					                  <?php
	while ( $row = $result->fetch_object () ) {
		?>
					                   		<option value="<?php echo $row->value; ?>"><?php echo $row->display; ?></option>
					                   <?php } ?>
					                </select>

	</div>
	<!-- /.input group -->
</div>

<?php

}


function printNumericFilter($filter, $nombre, $requerido) {
	?>

<!-- phone mask -->
<div class="form-group">
	<label><?php echo $nombre;?>:</label>

	<div class="input-group">
		<div class="input-group-addon">
			<i class="fa fa-phone"></i>
		</div>
		<input name="<?php echo $filter;?>" type="number" class="form-control"
			<?php echo $requerido ?>>
	</div>
	<!-- /.input group -->
</div>
<?php
}
function printSelectFilter($filter, $nombre, $result, $requerido) {
	?>
<!-- phone mask -->
<div class="form-group">
	<label><?php echo $nombre;?>:</label>

	<div class="input-group">
		<div class="input-group-addon">
			<i class="fa fa-list"></i>
		</div>





		<select  class="form-control select2" id="select_item"  style="width: 100%;"
			id="<?php echo $filter;?>" name="<?php echo $filter;?>"
			<?php echo $requerido ?>>

			<option value="" id=""></option>
					                  <?php
	while ( $row = $result->fetch_object () ) {
		?>
					                   		<option value="<?php echo $row->value; ?>"><?php echo $row->display; ?></option>
					                   <?php } ?>
					                </select>

	</div>
	<!-- /.input group -->
</div>

<?php

}
function printFilterModal($filtros, $page, $conn) {
	?>
<div class="panel-body">
	<button class="btn btn-info" data-toggle="modal" data-target="#myModal">
		<i class="fa fa-filter" aria-hidden="true"></i> Filtrar
	</button>

	<?php

	if (isset ( $_POST ["filtered"] )) {
		echo "<p>";
		foreach ( $filtros as $filtro => $value ) {
			$val = $_POST [$filtro];
			if ($val == '') {
				$val = "NaN";
			}

		}
		echo "</p>";



	}

	?>


	<div class="modal fade" id="myModal" tabindex="-1" role="dialog"
		aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"
						aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myModalLabel" align="center">Filtros</h4>
				</div>
				<div class="modal-body">

					<div class="col-md-13">

						<div class="box box-info">
							<div class="box-body">
                <div class="row">
                  <div class="col-md-1">
                    <img id="logoPati" src="dist\img\PATI-08.png" alt="Smiley face";>
                  </div>
                  <div class="col-md-11">
                    <form action="index.php?page=<?php echo $page;?>" method="POST">
    									<input type="hidden" name="filtered" value="1">
    								<?php
    	foreach ( $filtros as $filtro => $params ) {
    		$tipo = $params ["tipo"];
    		$requerido = "required";
    		if (isset ( $params ["requerido"] )) {
    			if (! $params ["requerido"]) {
    				$requerido = "";
    			}
    		}
    		if ($tipo == "date") {
    			printDateFilter ( $filtro, $params ["nombre"], $requerido );
    		}
    		elseif ($tipo == "text") {
    			printTextFilter ( $filtro, $params ["nombre"], $requerido );
    		} elseif ($tipo == "numeric") {
    			printNumericFilter ( $filtro, $params ["nombre"], $requerido );
    		} elseif ($tipo == "select") {
    			$query = $params ["query_select"];
    			$result = $conn->conexion->query ( $query );
    			printSelectFilter ( $filtro, $params ["nombre"], $result, $requerido );
    		}else if($tipo == "month"){
    			$query = $params ["query_select"];
    			$result = $conn->conexion->query ( $query );
    			printSelectFilterMonth ( $filtro, $params ["nombre"], $result, $requerido );
    		}
    	}
    	?>
    								<div class="form-group">
    										<button type="submit" class="btn btn-success"
    											style="width: 150px;">Filtrar</button>
    										&nbsp; &nbsp; &nbsp; &nbsp; <a href="index.php"><button
    												type="button" class="btn btn-danger" style="width: 150px;">Cancelar</button></a>
    									</div>

    								</form>
                  </div>
                </div>

							</div>
							<!-- /.box-body -->
						</div>
						<!-- /.box -->
					</div>

				</div>
				<div class="modal-footer"></div>
			</div>
		</div>
	</div>



</div>
<?php
}
function applyFilters($query, $filtros) {
	if (isset ( $_POST ["filtered"] )) {
		foreach ( $filtros as $filtro => $value ) {
			$value = $_POST [$filtro];
			$query = str_replace ( "<" . $filtro . ">", $value, $query );
		}
	}
	return $query;
}

?>


<script src="plugins/select2/select2.full.js"></script>
<script>
$(document).ready(function() {
    $("select").select2({
            placeholder: "Select a State",
            allowClear: true
     });
});
</script>

</script>
