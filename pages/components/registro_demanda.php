
<?php
$query = "select actividad from actividad";
$res = $wish->conexion->query ( $query );


setlocale (LC_TIME, 'es_ES.utf8','esp');
date_default_timezone_set ('America/Bogota');
$fecha=strftime("%Y-%m-%d %H:%M:%S");


if ($userinfo->area == 23) {
	$query = "select id from actividad where area=" . $userinfo->area . "";
} else {
	$query = "select id from actividad where  area='8' or area=" . $userinfo->area . "  order by id ";
}

$re = $wish->conexion->query ( $query );
$fila = mysqli_fetch_row ( $re );

$query = "select * from proyecto";
$rea = $wish->conexion->query ( $query );

$query = "select categoria from actividad";
$rep = $wish->conexion->query ( $query );

$queryContratos = "SELECT codigo,alias FROM new_lider_contratos where id_lider = $lider_id;";
//$queryContratos = "SELECT codigo,nombre FROM new_proyectos;";
$rContratos = $wish->conexion->query ( $queryContratos );

$estado="P";

if (isset ( $_GET ['e'] )) {
	$estado=$_GET['e'];
}
?>

<link rel="stylesheet" href="plugins/select2/select2.min.css"/>
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
    .scrollbar
    {
        margin-left: 30px;
        float: left;
        height: 300px;
        width: 65px;
        background: #F5F5F5;
        overflow-y: scroll;
        margin-bottom: 25px;
    }
    .select2-container--default .select2-selection--single
    {
        border-radius: 0;
        border-color: #d2d6de;
        width: 100%;
        height: 34px;
    }
</style>
<!-- Main content -->
<div class="col-md-12">
	<div class="box box-default">
		<div class="box-body">
			<form action="pages/backend/registrar_demanda.php"
				method="POST" onsubmit="return validacion(this)">

				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label>Actividad</label> <input type="text" id="actividad"
								class="form-control" disabled required>
								<input type="hidden" name="estado" value="<?php echo $estado;?>">
						</div>
						<div class="form-group">
							<label>Categoria</label> <input type="text" name="categoria"
								id="categoria" required class="form-control" disabled required>
						</div>
						<div class="form-group">
							<label>Plataforma</label> <input id="plataforma" type="text"
								class="form-control" disabled required>
						</div>
						<input type="hidden" id="areaa" name="areaa" value="<?php echo $userinfo->area;?>">
						<!-- /.form-group -->

						<label>Tiempo Real (Minutos)</label>
							<input id="tiempoReal" name="tiempoReal" required type="number" class="form-control"><br>

						<div class="form-group">
							<label>Descripción</label>
							<textarea id="descripcion" name="descripcion"
								class="form-control" rows="5" placeholder="Descripción" required></textarea>
						</div>


						<!-- /.form-group -->
					</div>
					<!-- /.col -->
					<div class="col-md-6">
						<div class="form-group">
							<label>Id actividad</label> <select id="id_actividad"
								name="id_actividad" class="form-control select2"
								style="width: 100%;" onchange="queryActividad();" required>
								<option value="" id=""></option>
                 <?php

																	while ( $row = $re->fetch_object () ) {
																		$row->id;
																		?>
                    <option value="<?php echo $row->id; ?>"><?php echo $row->id; ?></option>
                    <?php } ?>
                </select>

						</div>


						<div class="form-group">
							<label>N° Tiquete</label> <input type="text" id="numerotiquete"
								name="numerotiquete" class="form-control">
						</div>


						<div class="form-group">
							<label>Contrato</label>
							<select id="id_contrato" name="id_contrato" class="form-control" style="width: 100%;" required>
								<option value="" id=""></option>
                  <?php
																		while ( $row = $rContratos->fetch_object () ) {
																			?>

                    <option id="<?php echo $row->codigo; ?>"
									value="<?php echo $row->codigo; ?>"><?php echo $row->alias;?></option>
                    <?php } ?>
                </select>
						</div>


						<div class="form-group">

							<label>Fecha y hora de inicio</label>

							<div class='input-group date' id='datetimepicker2'>
							 <input id="fecha_inicio" name="dato" type="text" class="form-control" required>

							 <span class="input-group-addon">
	                        <span class="glyphicon glyphicon-calendar"></span>
		                    </span>
		                    </div>
						</div>

						<div class="form-group">
							<label>Horario no hábil</label> <br> <input name="horaExtra"
								id='horaExtra' type="checkbox" value="Si">
						</div>


						<br>
						<button type="submit" class="btn btn-success"
							style="width: 150px;">Guardar</button>
						&nbsp; &nbsp; &nbsp; &nbsp; <a href="index.php"><button
								type="button" class="btn btn-danger" style="width: 150px;">Cancelar</button></a>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<script src="plugins/select2/select2.full.min.js"></script>
    <script>

    $(function () {
        $('#fecha_inicio').datetimepicker({

        	format: 'YYYY-MM-DD HH:mm:ss',
        });
    });


	     $(function () {
	    $("#id_contrato").select2();
	     });
    </script>
