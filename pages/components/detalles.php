<link rel="stylesheet" href="plugins/select2/select2.min.css"/>
<link rel="stylesheet" href="plugins/multiselect/multipleSelect.css">
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="plugins/alertify.min.js"></script>

	<div id="resultado1"></div>

<style type="text/css">
.select2-container--default .select2-selection--single, .w3-input
{
	padding: 5px;
		display: block;
		border: none;
		border-bottom: 1px solid #ccc;
}

#patinotify{
		margin-left: -261px;
		width: 336px;
		height: 297px;
		margin-top: -9px;
}

.ms-options ms-active
{
	min-height: 100px;
	max-height: 100px;
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

.ms-drop.bottom
{
	width: 310px;

}

#search {
	float: right;
	margin-top: 9px;
	width: 250px;
}

.search {
	padding: 5px 0;
	width: 230px;
	height: 30px;
	position: relative;
	left: 10px;
	float: left;
	line-height: 22px;
}

	.search input {
			position: absolute;
			float: Left;


			height: 30px;
			line-height: 18px;
			padding: 0 2px 0 2px;
			border-radius:1px;
	}

			.search:hover input, .search input:focus {
					width: 200px;
					margin-left: 0px;
			}

#btn_search {
	height: 30px;
	position: absolute;
	right: 0;
	top: 5px;
	border-radius:1px;
}
</style>
<?php

error_reporting(E_ALL ^ E_NOTICE);
$oe= new conexion();
$id = $_POST['sci'];
$contrato = $_POST['contrato'];
$ip = $_POST['ip'];
$cedula=$userinfo->user_id;



$conn = $oe->conexion->query("select a.id_detalle, a.accion_critico, a.tiempo_chequeo, a.horario, a.id_host, a.puerto, a.accion_critico, e.nombre as CI, b.tipo as Servicio, a.disponibilidad,  a.delay, a.val_war as Warning, a.val_cri
								as Critical, d.id_tipo_umbral as id_umbral ,d.nombre as Tipo_de_umbral from detalle_servicio a, tipo_servicios b, tipo_umbral d,
								 hosts e where a.id_host=e.id and a.id_tipo_servicio=b.id and a.id_tipo_umbral=d.id_tipo_umbral and
								 e.id='$id' and a.estado='A' order by a.id_detalle desc");

$ser = $oe->conexion->query("SELECT * FROM tipo_servicios");
$umbra = $oe->conexion->query("SELECT * FROM tipo_umbral");
$escala = $oe->conexion->query("select a.nombre, a.cedula  from new_personas a, sub_grupo b where a.cedula=b.cedula;");
$com_del=$oe->conexion->query("select a.id,a.tipo from tipo_servicios a, detalle_servicio b where b.id_tipo_servicio=a.id and b.estado='I' and b.id_host='$id'");

$cont = $oe->conexion->query("SELECT nombre FROM new_proyectos where codigo='$contrato'");
$nom = $oe->conexion->query("SELECT nombre FROM hosts where id='$id'");
$contra = $cont->fetch_assoc();
$nomc = $nom->fetch_assoc();


?>


	<div class="box box-info">
	<div class="box-header with-border">
	<div class="box-body">

<div class="col-md-6" style="text-align: left;">
	<P> <strong style="font-size: 120%;">CONTRATO: </strong> <?php echo $contra['nombre'];?> <br>
	<strong style="font-size: 120%;">CI: </strong>  <?php echo $nomc['nombre'];?> <br>
	<strong style="font-size: 120%;">IP: </strong>  <?php echo $ip;?>
	</P>
</div>
<div class="col-md-6">

<input data-target="#modal_recuperar" data-toggle="modal" type="button" id='recupera_componente' value="Recuperar componentes eliminados" class="btn btn-primary pull-right" title="Recupera los componentes elimados del CI" >
</div>

<br>	<br>	<br>	<br>	<br>


<div class="container">
	<div class="row">
        <div class="search">
<input type="text" id="txt_buscar" class="form-control input-sm" maxlength="64" placeholder="Buscar..." />
 <button type="submit" id="btn_search" class="btn btn-primary btn-sm">Buscar</button>
</div>
	</div>


</div><br>

<div style=" width: 101.5%; height:280px; overflow-y: scroll;">

<input type="hidden" id="id_host" value="<?php echo $id?>">
	<table id="tabla" class="table table-bordered table-hover table-striped">

		<thead>
		<tr style="text-align: center;">


			<td style="width:16%">
				<h4>COMPONENTES</h4>
			</td>

			<!-- <td style="width:10%">
				<h4>DISPONI<br>BILIDAD</h4>
			</td>
			 -->
			<td style="width:10%" >
				<h4>DELAY</h4>
			</td>

			<td style="width:10%">
				<h4>TIEMPO CHEQUEO (min)</h4>
			</td>

			<td style="width:10%">
				<h4>WARNING</h4>
			</td>

			<td style="width:10%">
				<h4>CRITICAL</h4>
			</td>

			<td style="width:10%">
				<h4>TIPO UMBRAL</h4>
			</td>
			<td style="width:10%">
				<h4>RESPONSABLE</h4>
			</td>

			<td style="width:10%">
				<h4>HORARIO NOTIFICACIÓN</h4>
			</td>

			<!-- <td style="width:10%">
				<h4>PUERTO</h4>
			</td>
			 -->

			<td style="width:10%">
				<h4>CONFIGURAR</h4>
			</td>
		</tr>
		</thead>
		<tbody>
		<?php


		$i=1; while($row = $conn->fetch_assoc())
			{
                             	    //quitamos los espacios a la accion critica
			    $accion=$row["accion_critico"];
			    //$cadenalimpia =  str_replace("\r\n"," ",$accion);
			    //echo nl2br($accion);
			    //$textoArea = str_replace(array("\r", "\n"), ' ', $accion);
			    //echo  $textoArea;
                            $textoArea = preg_replace("/\r\n+|\r+|\"|\)|\(|\'|\n+|\t+/i", " ", $accion);


			?>
		<tr style="text-align: center;">



				<td style="text-align: left;">
					<label id="lblServicio<?php echo $i;?>" class="accion" title="Acción Crítica: <?php echo $textoArea;?>"> <?php echo $row['Servicio'];?> </label>
				</td>


				<td>
					<label id="lbldelay<?php echo $i;?>" title="delay<?php echo $i;?>" ondblclick="PressClick('lbldelay', 'txtDelay',<?php echo $i;?>)"><?php echo $row['delay'];?></label>
					<input id="txtDelay<?php echo $i;?>" type="number" min="0" max="100" name="txtDelay" onkeydown="EnterToTab(<?php echo $row['id_umbral'];?>,'lbldelay','txtDelay',<?php echo $i?>, <?php echo $row['id_detalle'];?>)"
					value="<?php echo $row['delay'];?>" style="display: none; width: 50px; height: 30px; border-radius: 10px; text-align: center; margin-left: 30px; border-bottom-left-radius: inherit; border-left-color: turquoise;">
				</td>

				<td>
					<label id="lbltiempoC<?php echo $i;?>" title="tiempoC<?php echo $i;?>" ondblclick="PressClick('lbltiempoC', 'txtiempoC',<?php echo $i;?>)"><?php echo $row['tiempo_chequeo'];?></label>
					<input id="txtiempoC<?php echo $i;?>" type="number" min="0" max="100" name="TiempoC" onkeydown="EnterToTab(<?php echo $row['id_umbral'];?>,'lbltiempoC', 'txtiempoC',<?php echo $i?>, <?php echo $row['id_detalle'];?>)" value="<?php echo $row['tiempo_chequeo'];?>"
					style="display: none; width: 50px; height: 30px; border-radius: 10px; text-align: center; margin-left: 30px; border-bottom-left-radius: inherit; border-left-color: turquoise;">
				</td>

				<td>
					<label id="lblwarning<?php echo $i;?>" title="warning<?php echo $i;?>" ondblclick="PressClick('lblwarning', 'txtWarning',<?php echo $i;?>)"><?php echo $row['Warning'];?></label>
					<input id="txtWarning<?php echo $i;?>" type="number" min="0" max="999" name="Warning" onkeydown="EnterToTab(<?php echo $row['id_umbral'];?>,'lblwarning', 'txtWarning',<?php echo $i?>, <?php echo $row['id_detalle'];?>)" value="<?php echo $row['Warning'];?>"
					style ="display: none; width: 50px; height: 30px; border-radius: 10px; text-align: center; margin-left: 30px; border-bottom-left-radius: inherit; border-left-color: turquoise;">
				</td>

				<td>
					<label id="lblcritical<?php echo $i;?>" title="critical<?php echo $i;?>" ondblclick="PressClick('lblcritical', 'txtCritical',<?php echo $i;?>)"><?php echo $row['Critical'];?></label>
					<input id="txtCritical<?php echo $i;?>" type="number" min="0" max="999" name="Critical" onkeydown="EnterToTab(<?php echo $row['id_umbral'];?>,'lblcritical', 'txtCritical',<?php echo $i?>, <?php echo $row['id_detalle'];?>)" value="<?php echo $row['Critical'];?>"
					style="display: none; width: 50px; height: 30px; border-radius: 10px; text-align: center; margin-left: 30px; border-bottom-left-radius: inherit; border-left-color: turquoise;">
				</td>

				<td>
					<label id="lblUmbral<?php echo $i;?>" title="Umbral<?php echo $i;?>" ondblclick="PressClick('lblUmbral', 'txtUmbral',<?php echo $i;?>)"><?php echo $row['Tipo_de_umbral'];?></label>
					<select id="txtUmbral<?php echo $i;?>" class="select" name="Umbral" onkeydown="EnterToTab(<?php echo $row['id_umbral'];?>,'lblUmbral', 'txtUmbral',<?php echo $i?>, <?php echo $row['id_detalle'];?>)" style="display: none; width:60px; border-radius: 10px; text-align: center; margin-left: 30px; border-bottom-left-radius: inherit; border-left-color: turquoise;"  required>
							<option value="<?php echo $row['id_umbral'];?>" disabled selected> <?php echo $row['Tipo_de_umbral'];?> </option>
							<option value="1">porcentaje</option>
							<option value="2">sesiones</option>
							<option value="3">segundos</option>
							<option value="5">MB</option>
							<option value="6">unidades</option>
							<option value="7">Down</option>
							<option value="8">Ping</option>
							<option value="9">GB</option>
							<option value="10">Minutos</option>
							<option value="11">Estado</option>
							<option value="12">Milisegundos</option>
							<option value="13">C°</option>
						</select>
				</td>

				<td>
			    <form onsubmit="MostrarConsulta('<?php echo $row['id_detalle']?>','<?php echo $contra['nombre']?>'); return false">
					<button data-target="#modalescala" data-toggle="modal" class="btn btn-default" onclick="">Escala</button>
				</form>
				</td>
				<!-- ESTE ES LA COLUMNA DE LOS HORARIOS DE NOTIFICACIÓN POR SERVICIO PARA PONER EL COMENTARIO -->
				<td>
					<label id="lblHorario<?php echo $i;?>" title="Horario<?php echo $i;?>" ondblclick="PressClick('lblHorario', 'txtHorario',<?php echo $i;?>)"><?php echo $row['horario'];?></label>
          <select id="txtHorario<?php echo $i;?>" class="select" name="Horario" onkeydown="EnterToTab(<?php echo $row['id_umbral'];?>,'lblHorario', 'txtHorario',<?php echo $i?>, <?php echo $row['id_detalle'];?>)" style="display: none; width:60px; border-radius: 10px; text-align: center; margin-left: 30px; border-bottom-left-radius: inherit; border-left-color: turquoise;"  required>
           <option value="<?php echo $row['horario'];?>" disabled selected><?php echo $row['horario'];?></option>
					 <option value="7x24">7x24</option>
					 <option value="5x12">5x12</option>
					 <option value="Habil">Habil</option>
					 <option value="Lunes - Sábado 6:00 a.m a 5:00 p.m">Lunes - Sábado 6:00 a.m a 5:00 p.m</option>
          </select>
				</td>



				<td>
					<div class="col-md-4" style="padding-right: 23px;">
					<div class="form-group">
						<a href="#" data-target="#modalactualizar" data-toggle="modal" onclick="upd('<?php echo $row['Servicio'];?>','<?php echo $textoArea;?>',<?php echo $row['id_detalle'];?>, '<?php echo $row['delay'];?>', '<?php echo $row['tiempo_chequeo'];?>', '<?php echo $row['Warning'];?>', '<?php echo $row['Critical'];?>');">
						<button id="upda" type="submit" title="actualizar" class="btn btn-default"><i class="fa fa-refresh"></i></button>
						</a>
					</div>
					</div>
					<div class="col-md-4">
					<div class="form-group">
						<a href="#" data-target="#modaleliminar" data-toggle="modal" onclick="elim(<?php echo $row['id_detalle'];?>);">
						<button type="submit" title="Eliminar" class="btn btn-default"><i class="fa fa-times"></i></button>
						</a>
					</div>
					</div>
				</td>
			</tr>
		<?php $i++;}?>
		</tbody>
	</table>
<br>

	</div>
</div>

<div style=" width: 100.5%;  overflow-y: scroll;">

<!-- <form name="formulario" id="formulario" action="" onSubmit="enviarservicio(); return false">-->
<table id="tabla" class="table table-bordered table-hover table-striped">
	<tr>
		<td>
			<select id="servicios" class="w3-input select2" name="servicio" style="width:95px" required>
			<option value="" disabled selected> Servicio </option>
				<?php
		        while($rowser = $ser->fetch_assoc())
		        {
		        	echo '<option value="'.$rowser['id'].'">'.$rowser['tipo'].'</option>';
		        }
				?>
				</select>
		</td>

		<!-- <td style="width:10%">
			<select class="w3-input select2" name="dispo" >
				<option value="-" selected>Dispon.</option>
				<option value="0"> Down </option>
				<option value="1"> Up </option>
			</select>
		</td>
		 -->
		<td >
	 <input id="delay_sub" name="delay" placeholder="Delay" class="w3-input war" type="number" min="0" max="100" style="width:75px" required>

         	</td>

		<td>
			<input id="chequeo_sub" name="check" placeholder="Chequeo" class="w3-input war" type="text" style="width:75px" required>
		</td>

		<td >
			<input id="val_war" name="war" placeholder="Warning" class="w3-input war" type="text" style="width:75px" >
		</td>

		<td >
			<input id="val_cri" name="cri" placeholder="Critical" class="w3-input war" type="text" style="width:75px" >
		</td>

		<td >

			<select id="t_umbral" class="w3-input select2" name="tipo" >
				<option value="" disabled selected>T. Umbral</option>
			      <option value="1-Porcentaje"> Porcentaje </option>
                                <option value="2-sesiones"> sesiones </option>
                                <option value="3-segundos"> segundos </option>
                                <option value="5-MB"> MB </option>
                                <option value="6-unidades"> unidades </option>
                                <option value="7-down"> down </option>
                                <option value="8-ping"> ping </option>
                                <option value="9-GB"> GB </option>
                                <option value="10-minutos"> minutos </option>
                                <option value="11-estado"> estado </option>
                                <option value="12-milisegundos"> milisengundos </option>
                                <option value="13-C°"> C° </option>



			</select>
		</td>

		<td >
			<select  id="responsable" name="responsable[]" class="respon" style="width:100px" multiple required>
			<?php
			while($rowesc = $escala->fetch_assoc())
			{
			?>
				<option value="<?php echo $rowesc['cedula'];?>"> <?php echo $rowesc['nombre']?> </option>
				<?php }  mysqli_data_seek($escala, 0); // -> esta línea es para resetear el puntero y reutilizar la consulta para otro fetch?>
			</select>
		</td>

		<td style="width:10%">
			<select id="horario_noti" class="w3-input select2" name="horario" required>
				<option value="" disabled selected> Horario notifi </option>
				<option value="7x24">7x24</option>
				<option value="5x12">5x12</option>
				<option value="habil">Hábil</option>
				<option value="Lunes - Sábado 6:00 a 5:00">Lunes - Sábado 6:00 a.m a 5:00 p.m</option>
			</select>
		</td>

	<!-- 	<td style="width:10%">
			<input name="puerto" value="" placeholder="puerto" class="w3-input war" type="number" style="width:75px">
		</td> -->

		<td style="width:2%">
			<button onclick="verifica_datos_nuevo_sub()" class="btn btn-success pull-leftt ">Agregar</button>
		</td>
	</tr>
	<tr>
		<td>
			<textarea id="accion_critica" name="accion" rows="1"  placeholder="Acción crítica" class="w3-input war" style="width:100px" required></textarea>
		</td>
	</tr>
</table>
<input id="cedula_usuario" type="hidden" value="<?php echo $cedula;?>" name="cedula">
<input id="nombre_ci" type="hidden" value="<?php echo $nomc['nombre'];?>" name="nombre_host">
<input id="ip_ci" type="hidden" value="<?php echo $ip;?>" name="ip">
<input id="nombre_contrato" type="hidden" value="<?php echo $contra['nombre'];?>" name="contrato">
<input id="cod_contrato" type="hidden" value="<?php echo $contrato?>" name="codigo_contrato">


<!--  </form> -->


<form name="formula" action="" onSubmit="enviarDato(); return false" >
	<div class="col-md-4">
		<div class="form-group">
			<div class="input-group">
				<input placeholder="Ingresar un tipo de servicio" title="Ingresar un nuevo servicio" required name="tipo" class="form-control" style="width:100%">
				<div class="input-group-addon">
						<button style="border-radius: 50%;" type="submit" title="Agregar">+</button>
				</div>
			</div>
		</div>
	</div>
</form>

	<!-- <button type="submit" name="update" class="btn btn-success pull-right">Enviar</button> -->
	<a href="javascript:history.back(1)"><button type="button" class="btn btn-danger pull-right"><i class="fa fa-step-backward" aria-hidden="true"></i> Atrás</button></a>
</div>
	</div>

	</div>

	<!-- INICIO DE MODAL ELIMINAR -->
	<div class="modal fade" id="modaleliminar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
		<div class="modal-content">
		<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h4 class="modal-title" id="myModalLabel" align="center">SE VA A ELIMINAR UN SERVICIO</h4>
		</div>
		<div class="modal-body">
		<div class="col-md-13">
		<div class="box box-danger">
		<div class="box-body">

        <label style="font-size: 22px;">Confirmar</label> <br><br>

		<form name="formular" action="" onSubmit="elimser(); return false" >
		<input type="hidden" id="id_detalle" name="borrar">
		<input type="hidden" id="cedula" name="cedula_usuario" value="<?php echo $cedula?>">
		<input type="hidden" id="contrato" name="nom_contrato" value="<?php echo $contra['nombre'];?>">

		<button type="submit" class="btn btn-success">Aceptar</button>
		<button type="button" class="btn btn-danger pull-right " data-dismiss="modal" aria-hidden="true">Cancelar</button>
		</form>

		</div>
		 </div>
		  </div>
		    </div>
			<div class="modal-footer"></div>
			</div>
		</div>
	</div>
	<!-- FIN DE MODAL -->








	<!-- INICIO DE MODAL ACTUALIZAR -->
		<div class="modal fade" id="modalactualizar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

		<div class="modal-dialog">
		<div class="modal-content">
		<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		</div>
		<div class="modal-body">
		<div class="col-md-13">
		<div class="box box-success">
		<div class="box-body">

        <label style="font-size: 22px;">Actualizar</label> <br><br>
				<div class="row">
					<div class="col-md-1">
						<img id="patinotify" src="dist\img\PATI-08.png" alt="">
					</div>
					<div class="col-md-11">
						<form id="formupd" name="formupd" action="" onSubmit="verifica_datos_mod_sub(); return false" >

						<div class="col-md-6">
						<div class="form-group">


						<input id="cedula_usuario" type="hidden" value="<?php echo $userinfo->user_id?>" name="cedula">
						<input id="nombre_ci" type="hidden" value="<?php echo $nomc['nombre'];?>" name="nombre_host">
						<input id="nom_contrato" type="hidden" value="<?php echo $contra['nombre'];?>" name="contrato">

						<label>Delay</label>
						<input id="Udelay" name="Udelay" class="w3-input war" type="number" min="0" max="100">
						<label>Tiempo de chequeo (min)</label>
						<input id="Ucheck" name="Ucheck" class="w3-input war" type="text">
						<label>Warning</label>
						<input id="Uwar" name="Uwar"  class="w3-input war" type="text" >
						<label>Critical</label>
						<input id="Ucri" name="Ucri"  class="w3-input war" type="text" >
						<!--  <label>Puerto</label>
						<input id="Upuerto" name="Upuerto" class="w3-input war" type="text">-->
						<label>Acción Crítica</label>
						<textarea id="Uaccion" name="Uaccion" class="w3-input war" required></textarea>
						</div>
						</div>

						<div class="col-md-6">
						<div class="form-group">

							<!-- <label>Disponibilidad</label><br>
						<select id="Udispo" name="Udispo" class="w3-input war" style="width: 70%;" required>
								<option value="-" disabled selected>Dispon.</option>
						<option value="0"> Down </option>
						<option value="1"> Up </option>
						</select><br><br> -->
									<input id="Uservicio" name="Uservicio"  type="hidden" >
						<label>Tipo Umbral</label><br>
						<select id="Utipo_umbral" name="Utipo_umbral"  class="w3-input war" style="width: 70%;" required>
																<option value="" disabled selected>T. Umbral</option>
															<option value="1-Porcentaje"> Porcentaje </option>
																		<option value="2-sesiones"> sesiones </option>
																		<option value="3-segundos"> segundos </option>
																		<option value="5-MB"> MB </option>
																		<option value="6-unidades"> unidades </option>
																		<option value="7-down"> down </option>
																		<option value="8-ping"> ping </option>
																		<option value="9-GB"> GB </option>
																		<option value="10-minutos"> minutos </option>
																		<option value="11-estado"> estado </option>
																		<option value="12-milisegundos"> milisengundos </option>
																		<option value="13-C°"> C° </option>




														</select><br><br>

						<label>Responsable</label><br>
						<select id="Uresponsable" name="Uresponsable[]"  class="respon" style="width:100px;" multiple required>
						<!-- OPTIONS -->

						<?php
						while($rowesc2 = $escala->fetch_assoc())
						{
						?>
						<option value="<?php echo $rowesc2['cedula'];?>"> <?php echo $rowesc2['nombre'];?> </option>
						<?php }?>

						</select>

						<br><br>
						<label>Horario</label><br>
						<select id="Uhorario_op" name="Uhorario" class="w3-input war" style="width:70%" required>
						<option value=""></option>
						<option value="7x24">7x24</option>
						<option value="5x12">5x12</option>
						<option value="habil">Hábil</option>
						<option value="habil">Lunes - Sábado 6:00 a.m a 5:00 p.m</option>

						</select><br><br>

						<input type="hidden" id="id_detalles" name="id_detalles">
						</div>
						</div>

						<button type="submit" class="btn btn-success">Aceptar</button>
						<button type="button" class="btn btn-danger pull-right" data-dismiss="modal" aria-hidden="true">Cancelar</button>
						</form>
					</div>
				</div>


		</div>
		 </div>
		  </div>
		    </div>
			<div class="modal-footer"></div>
			</div>
		</div>
	</div>
	<!-- FIN DE MODAL -->








	<!-- INICIO DE MODAL ESCALAMIENTO -->
	<div class="modal fade" id="modalescala" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
		<div style="width: 130%; border-radius:10px;" id="modalesc" class="modal-content">
		<div class="modal-header">
		<button type="button" class="btn btn-default pull-right" data-dismiss="modal" aria-hidden="true">&times;</button>
		</div>
		<div class="modal-body">
		<div class="col-md-13">
		<div class="box box-info">
		<div class="box-body">

        <label style="font-size: 22px;">Escalamiento</label> <br><br>

       <div id="resultado"></div>
		<!-- <button type="button" class="btn btn-danger pull-right butt" data-dismiss="modal" aria-hidden="true">Cerrar</button> -->

		</div>
		 </div>
		  </div>
		    </div>
			<div class="modal-footer"></div>
			</div>
		</div>
	</div>
	<!-- FIN DE MODAL -->



	<!--INICIA MODAL DE RECUPERAR COMPONENTES -->

		<div class="modal fade" id="modal_recuperar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
		<div style="width: 130%; border-radius:10px;" id="modalesc" class="modal-content">
		<div class="modal-header">
		<button type="button" class="btn btn-default pull-right" data-dismiss="modal" aria-hidden="true">&times;</button>
		</div>
		<div class="modal-body">
		<div class="col-md-13">
		<div class="box box-info">
		<div class="box-body">

       <label style="font-size: 22px;">Recuperar componentes</label> <br><br>


       <div class="row">
       <div class="col-md-6">
       <label>COMPONENTES ELIMINADOS</label><br>
       <select class="form-control"  id="componentes_eliminados" name="componentes_elimina" >

       <option value=""></option>

       <?php while($componente_b=$com_del->fetch_assoc()){?>
       <option value='<?php echo $componente_b["id"]?>'><?php echo $componente_b["tipo"]?></option>

       <?php }?>

       </select>
		<!-- <button type="button" class="btn btn-danger pull-right butt" data-dismiss="modal" aria-hidden="true">Cerrar</button> -->
		<input type="hidden" value="<?php echo $id?>" name="id_ci" id="id_dispo">
		</div>
		</div>

		<br>

		<div class="row" id="res"></div>


		</div>
		 </div>
		  </div>
		    </div>
			<div class="modal-footer"></div>
			</div>
		</div>
	</div>
	<!-- FIN MODAL RECUPERAR1 -->





	<!-- INICIO DE MODAL CONFIGURAR ESCALA -->
	<div class="modal fade" id="configura_escala" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
		<div style="width: 130%; border-radius:10px;" id="modalesc" class="modal-content">
		<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel_conf" style="font-size:20px; text-align:center"><b>Configuración nivel de escalamiento</b></h4>

		</div>
		<div class="modal-body">
		<div class="col-md-13">
		<div class="box box-info">
		<div class="box-body">


         <label  style="font-size:14px; text-align:center"><b>Los cambios realizados para cada usuario, se verán reflejados sólo para el
          subcomponente y contrato actual</b></label><br><br>



		<!-- <button type="button" class="btn btn-danger pull-right butt" data-dismiss="modal" aria-hidden="true">Cerrar</button> -->
		    <div id="tabla_respo"></div>
		</div>
		 </div>
		  </div>
		    </div>



			<div class="modal-footer"></div>
			</div>
		</div>
	</div>
	<!-- FIN DE MODAL -->
	<!-- FIN MODAL CONFIGURAR ESCALA -->






	<!-- INICIO DE MODAL CONFIGURAR ESCALA - modificar -->
	<div class="modal fade" id="configura_escala1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
		<div style="width: 130%; border-radius:10px;" id="modalesc" class="modal-content">
		<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel_conf_1"  style="font-size:20px ;text-align: center"><b>Configuración nivel de escalamiento</b></h4>

		</div>
		<div class="modal-body">
		<div class="col-md-13">
		<div class="box box-info">
		<div class="box-body">


         <label  style="font-size:15px; text-align:center"><b>Los cambios realizados para cada usuario, se verán reflejados sólo para el
          subcomponente y contrato actual</b></label><br><br>



		<!-- <button type="button" class="btn btn-danger pull-right butt" data-dismiss="modal" aria-hidden="true">Cerrar</button> -->
		    <div id="tabla_respo1"></div>
		</div>
		 </div>
		  </div>
		    </div>



			<div class="modal-footer"></div>
			</div>
		</div>
	</div>
	<!-- FIN DE MODAL -->
	<!-- FIN MODAL CONFIGURAR ESCALA -->


<div id="resultadoActualiza"></div>


	<script src="plugins/multiselect/multipleSelect.js"></script>



	<script type="text/javascript">
function objetoAjax()
{
	var xmlhttp = false;
	try {
		xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
	} catch (e) {

		try {
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		} catch (E) {
			xmlhttp = false; }
	}

	if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
	  xmlhttp = new XMLHttpRequest();
	}
	return xmlhttp;
}


//TOMAMOS EL VALOR DEL COMPONENTE  QUE ESTA ELIMINADO

$("#componentes_eliminados").change(function () {

	  var id_compo = $(this).val();
	  var id_dispo=$("#id_dispo").val();

        $.ajax({

        		type:  'POST',

        		url:   'pages/backend/recupera_detalle.php',

                data: { id_componente: id_compo,
                        id_ci:id_dispo },

                success:  function (data)
                {
                   $("#res").html(data);

                }
        });

})



function elimser()
{
	borrar = document.formular.borrar.value;
	cedula= document.formular.cedula_usuario.value;
  contrato=document.formular.nom_contrato.value;


var parametros = {
        "borrar": borrar,
        "cedula": cedula,
        "contrato": contrato

    };
	    $.ajax({
	        data: parametros,
	        url: 'pages/backend/borrar_servicio.php',
	        type: 'post',

	        success: function (response) {
	            $("#resultado").html(response);
	        	window.setTimeout('location.reload()');
	        }
	    });


}

function enviarDato()
{
	tipo = document.formula.tipo.value;

	ajax = objetoAjax();
	ajax.open("POST", "pages/backend/nuevo_servicio.php", true);
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("&tipo="+tipo)


    alertify.alert("<b>Registro exitoso", function () {
    	  window.setTimeout('location.reload()');
    });

}

function updateservicio()
{
	$.ajax({

	type:  'POST',

	url:   'pages/backend/includes/actualizar_servicio.php',

	       data: $("#formupd").serialize(),
	});

	window.setTimeout('location.reload()');
}

function MostrarConsulta(datos,contra){



	ids = datos;
	contrat = contra;

        $.ajax({

        		type:  'POST',

        		url:   'pages/backend/includes/detalle_grupo.php',

                data: { id_escala: ids, contrato: contrat},

                success:  function (data)
                {
                   $("#resultado").html(data);

                }
        });
}

</script>



 <script src="plugins/select2/select2.full.min.js"></script>
    <script>

    $(function (){
    	$(".select2").select2();
     });

    $(".respon").multipleSelect({
        placeholder: "responsable",
        filter: true,
    });

	     function upd(servicio, accion, id_detalle, delay, check, war, cri)
	     {
	     	$('#id_detalles').val(id_detalle);
            $("#Udelay").val(delay);
            $("#Ucheck").val(check);
            $("#Uwar").val(war);
            $("#Ucri").val(cri);
            //$("#Upuerto").val(puerto);
            $("#Uaccion").val(accion);
            $("#Uservicio").val(servicio);
	     }





	     function elim(id_detalle)
	     {
	     	$('#id_detalle').val(id_detalle);
	     }

	     $(document).ready(function(){
	    	    $('.accion').tooltip();
	    	});

            function verifica_datos_mod_sub(){
				$('#modalescala').modal('hide');


                var contrato=document.getElementById("nom_contrato").value;
                var cedula=document.getElementById("cedula").value;
                var Udelay=document.getElementById("Udelay").value;
                var Ucheck=document.getElementById("Ucheck").value;
                var Uwar=document.getElementById("Uwar").value;
                var Ucri=document.getElementById("Ucri").value;
                var Uaccion=document.getElementById("Uaccion").value;
                var Utipo_umbral=document.getElementById("Utipo_umbral").value;
                var Uresponsable = $('#Uresponsable').val();
               // var Uresponsable=document.getElementById("Uresponsable").value;
                var Uhorario=document.getElementById("Uhorario_op").value;
                var Uservicio=document.getElementById("Uservicio").value;
                var id_detalles=document.getElementById("id_detalles").value;
			 			    var nombre_host= document.getElementById("nombre_ci").value;
			 			    var ip= document.getElementById("ip_ci").value;
						    var contrato= document.getElementById("nombre_contrato").value;
						    var codigo_contrato= document.getElementById("cod_contrato").value;

							if(Udelay == "" && Ucheck == ""){
								Ucheck = "0";
								Udelay = "0";

														if(Utipo_umbral != "7-down") {
																	 if (Ucri == "" && Uwar == "") {
																		 alertify.alert("<b> Los campos <font color='red'> WARNING </font> y <font color='red'> CRITICAL </font> son obligatorios. <br/> Diligencie almenos uno de ellos</b>");
																	 }else{

																		 var parametros1 = {

																			"contrato":contrato,
																		  "cedula":cedula,
																		  "Udelay":Udelay,
																		  "Ucheck":Ucheck,
																		  "Uwar":Uwar,
																		  "Ucri":Ucri,
																		  "Uaccion":Uaccion,
																		  "Utipo_umbral":Utipo_umbral,
																		  "Uhorario":Uhorario,
																			"Uservicio":Uservicio,
																			"Uresponsable":Uresponsable,
																			"id_detalles":id_detalles,
																			"nombre_host":nombre_host,
																			"ip":ip,
																			"contrato":contrato,
																			"codigo_contrato":codigo_contrato
																			};
																		 $.ajax({
																			data: parametros1,
																			url: 'pages/backend/actualizar_servicio.php',
																			type: 'post',

																			success: function (response) {
																				 $('#modalactualizar').modal('hide');

																				$('#configura_escala1').modal({show: 'false',backdrop: 'static', keyboard: false});

																				 $("#tabla_respo1").html(response);
																				//window.setTimeout('location.reload()');
																			}
																		 });

																	 }
															}

							}else if(Udelay == ""){
								Udelay = "0";

																if(Utipo_umbral != "7-down") {
																			 if (Ucri == "" && Uwar == "") {
                                    alertify.alert("<b> Los campos <font color='red'> WARNING </font> y <font color='red'> CRITICAL </font> son obligatorios. <br/> Diligencie almenos uno de ellos</b>");
																	}else{

																				 var parametros1 = {

																					"contrato":contrato,
																				  "cedula":cedula,
																				  "Udelay":Udelay,
																				  "Ucheck":Ucheck,
																				  "Uwar":Uwar,
																			  	"Ucri":Ucri,
																			    "Uaccion":Uaccion,
																				  "Utipo_umbral":Utipo_umbral,
																				  "Uhorario":Uhorario,
																					"Uservicio":Uservicio,
																					"Uresponsable":Uresponsable,
																					"id_detalles":id_detalles,
																					"nombre_host":nombre_host,
																					"ip":ip,
																					"contrato":contrato,
																					"codigo_contrato":codigo_contrato
																					};
																				 $.ajax({
																					data: parametros1,
																					url: 'pages/backend/actualizar_servicio.php',
																					type: 'post',

																					success: function (response) {
																						 $('#modalactualizar').modal('hide');

																						$('#configura_escala1').modal({show: 'false',backdrop: 'static', keyboard: false});

																						 $("#tabla_respo1").html(response);
																						//window.setTimeout('location.reload()');
																					}
																				 });

																			 }
																	}



							}else if (Ucheck == "") {
								Ucheck = "0";


																if(Utipo_umbral != "7-down") {
																			 if (Ucri == "" && Uwar == "") {
																				 alertify.alert("<b> Los campos <font color='red'> WARNING </font> y <font color='red'> CRITICAL </font> son obligatorios. <br/> Diligencie almenos uno de ellos</b>");
																			 }else{

																				 var parametros1 = {

																					"contrato":contrato,
																				  "cedula":cedula,
																				  "Udelay":Udelay,
																				  "Ucheck":Ucheck,
																				  "Uwar":Uwar,
																				  "Ucri":Ucri,
																			 	  "Uaccion":Uaccion,
																				  "Utipo_umbral":Utipo_umbral,
																				  "Uhorario":Uhorario,
																					"Uservicio":Uservicio,
																					"Uresponsable":Uresponsable,
																					"id_detalles":id_detalles,
																					"nombre_host":nombre_host,
																					"ip":ip,
																					"contrato":contrato,
																					"codigo_contrato":codigo_contrato
																					};
																				 $.ajax({
																					data: parametros1,
																					url: 'pages/backend/actualizar_servicio.php',
																					type: 'post',

																					success: function (response) {
																						 $('#modalactualizar').modal('hide');

																						$('#configura_escala1').modal({show: 'false',backdrop: 'static', keyboard: false});

																						 $("#tabla_respo1").html(response);
																						//window.setTimeout('location.reload()');
																					}
																				 });

																			 }
																	}

					}

					if(Utipo_umbral != "7-down") {
								 if (Ucri == "" && Uwar == "") {
									 alertify.alert("<b> Los campos <font color='red'> WARNING </font> y <font color='red'> CRITICAL </font> son obligatorios. <br/> Diligencie almenos uno de ellos</b>");
								 }else{

									 var parametros1 = {

									  "contrato":contrato,
									 "cedula":cedula,
									 "Udelay":Udelay,
									 "Ucheck":Ucheck,
									 "Uwar":Uwar,
									 "Ucri":Ucri,
									 "Uaccion":Uaccion,
									 "Utipo_umbral":Utipo_umbral,
									 "Uhorario":Uhorario,
									  "Uservicio":Uservicio,
									  "Uresponsable":Uresponsable,
									  "id_detalles":id_detalles,
									  "nombre_host":nombre_host,
									  "ip":ip,
									  "contrato":contrato,
									  "codigo_contrato":codigo_contrato
									 	};
									 $.ajax({
									 	data: parametros1,
									 	url: 'pages/backend/actualizar_servicio.php',
									 	type: 'post',

									 	success: function (response) {
									 		 $('#modalactualizar').modal('hide');

									 		$('#configura_escala1').modal({show: 'false',backdrop: 'static', keyboard: false});

									 		 $("#tabla_respo1").html(response);
									 		//window.setTimeout('location.reload()');
									 	}
									 });

								 }
						}else {

								 var parametros1 = {

								  "contrato":contrato,
								 "cedula":cedula,
								 "Udelay":Udelay,
								 "Ucheck":Ucheck,
								 "Uwar":Uwar,
								 "Ucri":Ucri,
								 "Uaccion":Uaccion,
								 "Utipo_umbral":Utipo_umbral,
								 "Uhorario":Uhorario,
								  "Uservicio":Uservicio,
								  "Uresponsable":Uresponsable,
								  "id_detalles":id_detalles,
								  "nombre_host":nombre_host,
								  "ip":ip,
								  "contrato":contrato,
								  "codigo_contrato":codigo_contrato
								 	};
								 $.ajax({
								 	data: parametros1,
								 	url: 'pages/backend/actualizar_servicio.php',
								 	type: 'post',

								 	success: function (response) {
								 		 $('#modalactualizar').modal('hide');

								 		$('#configura_escala1').modal({show: 'false',backdrop: 'static', keyboard: false});

								 		 $("#tabla_respo1").html(response);
								 		//window.setTimeout('location.reload()');
								 	}
								 });

						}
  		}




		   function verifica_datos_nuevo_sub(){

			   var servicio = document.getElementById("servicios").value;
			   var delay = document.getElementById("delay_sub").value;
			   var chequeo = document.getElementById("chequeo_sub").value;
			   var val_war = document.getElementById("val_war").value;
			   var val_cri = document.getElementById("val_cri").value;
			   var t_umbral = document.getElementById("t_umbral").value;
			   var responsables = document.getElementById("responsable");
			   var id_host=document.getElementById("id_host").value;
			   var horario_noti = document.getElementById("horario_noti").value;
			   var accion_cri= document.getElementById("accion_critica").value;

			   var cedula= document.getElementById("cedula_usuario").value;
			   var nombre_host= document.getElementById("nombre_ci").value;
			   var ip= document.getElementById("ip_ci").value;
			   var contrato= document.getElementById("nombre_contrato").value;
			   var codigo_contrato= document.getElementById("cod_contrato").value;

			   if(servicio=="" || t_umbral=="" || responsables=="" || horario_noti=="" || accion_cri==""){

			       alertify.alert("<b>Para crear un nuevo subcomponente, es necesario diligenciar todos los campos.</b>");

			   }else{
								 if (t_umbral != "7-down") {
											 	if (val_cri == "" && val_war == "") {
													alertify.alert("<b> Los campos <font color='red'> WARNING </font> y <font color='red'> CRITICAL </font> son obligatorios. <br/> Diligencie almenos uno de ellos</b>");
											 	}else{
													$.ajax({
						 					        url:'pages/backend/verifica_detalle.php',
						 					        data:{
						 					            "id_tipo_servicio":servicio,
						 					            "host": id_host

						 					        },
						 					        type:"POST",
						 					        //AGREGA ESTE TIPO DE RETORNO
						 					        dataType: "json",
						 					        error: function(){
						 					            alert("ha ocurrido un error");
						 					        },
						 					        success:function(datosRetornados){

						 						        var estado=datosRetornados.estado


						 								  if(estado=='existe'){

						 								   alertify.alert("<b>El subcomponente a crear, ya fue previamente creado, si no se visualiza por favor verifica en el botón <br><br><font color='red'>'Recuperar componentes eliminados'</font></b>");

						 									return;
						 							     }

						 							      if(estado=='no_existe')  {
						 				    		            $('#configura_escala').modal({show: 'false',backdrop: 'static', keyboard: false});

						 							    	 escala(id_host,servicio,delay,chequeo,val_war,val_cri,t_umbral,id_host,horario_noti,accion_cri,responsables,
						 							    			 cedula,nombre_host,ip,contrato,codigo_contrato);

						 							       }
						 					        }
						 					    });
									}

							 }else {

								 $.ajax({
								 		url:'pages/backend/verifica_detalle.php',
								 		data:{
								 				"id_tipo_servicio":servicio,
								 				"host": id_host

								 		},
								 		type:"POST",
								 		//AGREGA ESTE TIPO DE RETORNO
								 		dataType: "json",
								 		error: function(){
								 				alert("ha ocurrido un error");
								 		},
								 		success:function(datosRetornados){

								 			var estado=datosRetornados.estado


								 		if(estado=='existe'){

								 		 alertify.alert("<b>El subcomponente a crear, ya fue previamente creado, si no se visualiza por favor verifica en el botón <br><br><font color='red'>'Recuperar componentes eliminados'</font></b>");

								 		return;
								 		 }

								 			if(estado=='no_existe')  {
								 							$('#configura_escala').modal({show: 'false',backdrop: 'static', keyboard: false});

								 			 escala(id_host,servicio,delay,chequeo,val_war,val_cri,t_umbral,id_host,horario_noti,accion_cri,responsables,
								 					 cedula,nombre_host,ip,contrato,codigo_contrato);

								 			 }
								 		}
								 });

							 }

				   }

		   }



		     function escala(id_host,servicio,delay,chequeo,val_war,val_cri,t_umbral,id_host,horario_noti,accion_cri,responsables,
				     cedula,nombre_host,ip,contrato,codigo_contrato) {

		         var cedulas="";
		         var aux=0;
		         var aux1=0;

		         for (var i = 0; i < responsables.options.length; i++) {

					   	if(responsables.options[i].selected ==true){

		                       aux+=1;

				        }
				   }



				   for (var i = 0; i < responsables.options.length; i++) {

					   	if(responsables.options[i].selected ==true){
					   	       aux1+=1;
                               if(aux==aux1){
                            	   cedulas+=(responsables.options[i].value);
                                   }else{

		                       cedulas+=(responsables.options[i].value)+"|";
                                   }
				        }
				   }

		    	   var parametros = {

		    		        "id_host":id_host,
		    		        "servicio":servicio,
		    		        "delay":delay,
		    		        "chequeo":chequeo,
		    		         "val_war":val_war,
		    		         "val_cri":val_cri,
		    		         "tipo_umbral":t_umbral,
		    		         "id_host":id_host,
                             "horario_noti":horario_noti,
                             "accion_cri":accion_cri,
                             "responsables":cedulas,

                             "cedula":cedula,
                             "nombre_host":nombre_host,
                             "ip":ip,
                             "contrato":contrato,
                             "codigo_contrato":codigo_contrato
     		    		    };
		    		    $.ajax({
		    		        data: parametros,
		    		        url: 'pages/backend/servicio_ci.php',
		    		        type: 'post',

		    		        success: function (response) {
		    		            $("#tabla_respo").html(response);
		    		        	//window.setTimeout('location.reload()');
		    		        }
		    		    });



			}

		     $(document).ready(function(){
		    	 $("#txt_buscar").keyup(function(){
		    	 _this = this;
		    	 // Show only matching TR, hide rest of them
		    	 $.each($("#tabla tbody tr"), function() {
		    	 if($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
		    	 $(this).hide();
		    	 else
		    	 $(this).show();
		    	 });
		    	 });
		    	});
var contador = 0;


var array_label = new Array(2)
var array_texto = new Array(2)

						function PressClick(lbl,txt,i){

						   	   document.getElementById(lbl+i).style.display="none";
							  	 document.getElementById(txt+i).style.display="block";


						contador++;
									if (contador==1){
										var label = lbl+i;
										var texto = txt+i;

										array_label[0]=label;
										array_texto[0]=texto;

									}else{
										var restlbl = document.getElementById(lbl+i).innerHTML;
										var restxt = document.getElementById(txt+i).value=restlbl;
										var labelearly = lbl+i;
										var textoearly = txt+i;
										array_label[1]=labelearly;
										array_texto[1]=textoearly;

									  var labelate = array_label[0];
										var txtlate = array_texto[0];

										document.getElementById(labelate).style.display="block";
								  	document.getElementById(txtlate).style.display="none";

									array_label[0]=array_label[1];
									array_texto[0]=array_texto[1];

									}
						}

						function GuardandoDatosJuntos(lbl, txt, i){
							var TextId = txt+i;
							var LabelYd = lbl+i;
							var claveUmbral = TextId.indexOf("Umbral");
							if (claveUmbral >=0) {
								var DeliverTxt = document.getElementById(TextId).value;
							if (DeliverTxt == 1) {
								var receiveTxt = document.getElementById(LabelYd).innerHTML='porcentaje';
							}else if (DeliverTxt == 2) {
								var receiveTxt = document.getElementById(LabelYd).innerHTML='sesiones';
							}else if (DeliverTxt == 3) {
								var receiveTxt = document.getElementById(LabelYd).innerHTML='segundos';
							}else if (DeliverTxt == 5) {
								var receiveTxt = document.getElementById(LabelYd).innerHTML='MB';
							}else if (DeliverTxt == 6) {
								var receiveTxt = document.getElementById(LabelYd).innerHTML='unidades';
							}else if (DeliverTxt == 7) {
								var receiveTxt = document.getElementById(LabelYd).innerHTML='Down';
							}else if (DeliverTxt == 8) {
								var receiveTxt = document.getElementById(LabelYd).innerHTML='ping';
							}else if (DeliverTxt == 9) {
								var receiveTxt = document.getElementById(LabelYd).innerHTML='GB';
							}else if (DeliverTxt == 10) {
								var receiveTxt = document.getElementById(LabelYd).innerHTML='Minutos';
							}else if (DeliverTxt == 11) {
								var receiveTxt = document.getElementById(LabelYd).innerHTML='Estado';
							}else if (DeliverTxt == 12) {
								var receiveTxt = document.getElementById(LabelYd).innerHTML='Milisegundos';
							}else if (DeliverTxt == 13) {
								var receiveTxt = document.getElementById(LabelYd).innerHTML='C°';
							}
							}else {
								var DeliverTxt = document.getElementById(TextId).value;
								var receiveTxt = document.getElementById(LabelYd).innerHTML=DeliverTxt;
							}
						}


						function EnterToTab(umbraliddefinity, lbl, txt, i, servicio){
							if (event.keyCode == 13) {
								var txtcompara = txt+i;
								var lblcompara = lbl+i;
								var early = document.getElementById(lblcompara).innerHTML;
								var late = document.getElementById(txtcompara).value;
								document.getElementById(lbl+i).style.display="block";
								document.getElementById(txt+i).style.display="none";
								if (early == late) {

									alertify.error("Sin Cambios");

								}else if(late==''){
									alertify.error("Campo Vacio");
								}else {
									var claveDelay = txtcompara.indexOf("Delay");
									var claveChequeo = txtcompara.indexOf("tiempoC");
									var claveWarning = txtcompara.indexOf("Warning");
									var claveCritical = txtcompara.indexOf("Critical");
									var claveUmbral = txtcompara.indexOf("Umbral");
									var claveHorario = txtcompara.indexOf("Horario");

									if (claveDelay >= 0 ) {
										var nombre_hostgg= document.getElementById("nombre_ci").value;
										var id_detallesgg=servicio;
										var id_serviciogg=document.getElementById("lblServicio"+i).innerHTML;
										var txtDelagg=document.getElementById("txtDelay"+i).value;
										var txtCheqgg=document.getElementById("lbltiempoC"+i).innerHTML;
										var txtWarningg=document.getElementById("lblwarning"+i).innerHTML;
										var txtCriticalgg=document.getElementById("lblcritical"+i).innerHTML;
										var txtUmbralgg=document.getElementById("txtUmbral"+i).value;
										var txtHorariogg=document.getElementById("lblHorario"+i).innerHTML;
										var ipgg= document.getElementById("ip_ci").value;
										var contratogg=document.getElementById("nom_contrato").value;
										var codigo_contratogg= document.getElementById("cod_contrato").value;
										var cedulagg=document.getElementById("cedula").value;

											var Datos_Correo = {
											 "nombre_host":nombre_hostgg,
											 "id_detalles":id_detallesgg,
											 "Uservicio":id_serviciogg,
											 "Udelay":txtDelagg,
											 "Ucheck":txtCheqgg,
											 "Uwar":txtWarningg,
											 "Ucri":txtCriticalgg,
											 "Utipo_umbral":txtUmbralgg,
											 "Uhorario":txtHorariogg,
											 "contrato":contratogg,
											 "codigo_contrato":codigo_contratogg,
											 "cedula":cedulagg,
											 "ip":ipgg
											 };
											 $.ajax({
												data: Datos_Correo,
												url: 'pages/backend/includes/actualiza_detalle.php',
												type: 'post',
												success: function (response) {
 														//$("#resultadoActualiza").html(response);
														 alertify.success("Delay Actualizado.");
												}
											});
									}else if (claveChequeo >= 0) {
									var nombre_hostgg= document.getElementById("nombre_ci").value;
									var id_detallesgg=servicio;
									var id_serviciogg=document.getElementById("lblServicio"+i).innerHTML;
									var txtDelagg=document.getElementById("lbldelay"+i).innerHTML;
									var txtCheqgg=document.getElementById("txtiempoC"+i).value;
									var txtWarningg=document.getElementById("lblwarning"+i).innerHTML;
									var txtCriticalgg=document.getElementById("lblcritical"+i).innerHTML;
									var txtUmbralgg=document.getElementById("txtUmbral"+i).value;
									var txtHorariogg=document.getElementById("lblHorario"+i).innerHTML;
									var ipgg= document.getElementById("ip_ci").value;
									var contratogg=document.getElementById("nom_contrato").value;
									var codigo_contratogg= document.getElementById("cod_contrato").value;
									var cedulagg=document.getElementById("cedula").value;
									var Datos_Correo = {
										"nombre_host":nombre_hostgg,
 									 "id_detalles":id_detallesgg,
 									 "Uservicio":id_serviciogg,
 									 "Udelay":txtDelagg,
 									 "Ucheck":txtCheqgg,
 									 "Uwar":txtWarningg,
 									 "Ucri":txtCriticalgg,
 									 "Utipo_umbral":txtUmbralgg,
 									 "Uhorario":txtHorariogg,
 									 "contrato":contratogg,
 									 "codigo_contrato":codigo_contratogg,
 									 "cedula":cedulagg,
 									 "ip":ipgg
									 };
									 $.ajax({
										data: Datos_Correo,
										url: 'pages/backend/includes/actualiza_detalle.php',
										type: 'post',
										success: function (response) {
												//$("#resultadoActualiza").html(response);
												 alertify.success("Tiempo Chequeo Actualizado.");
										}
									});
									}else if (claveWarning >= 0) {
												var nombre_hostgg= document.getElementById("nombre_ci").value;
												var id_detallesgg=servicio;
												var id_serviciogg=document.getElementById("lblServicio"+i).innerHTML;
												var txtDelagg=document.getElementById("lbldelay"+i).innerHTML;
												var txtCheqgg=document.getElementById("lbltiempoC"+i).innerHTML;
												var txtWarningg=document.getElementById("txtWarning"+i).value;
												var txtCriticalgg=document.getElementById("lblcritical"+i).innerHTML;
												var txtUmbralgg=document.getElementById("txtUmbral"+i).value;
												var txtHorariogg=document.getElementById("lblHorario"+i).innerHTML;
												var ipgg= document.getElementById("ip_ci").value;
												var contratogg=document.getElementById("nom_contrato").value;
												var codigo_contratogg= document.getElementById("cod_contrato").value;
												var cedulagg=document.getElementById("cedula").value;
												var Datos_Correo = {
													"nombre_host":nombre_hostgg,
												 "id_detalles":id_detallesgg,
												 "Uservicio":id_serviciogg,
												 "Udelay":txtDelagg,
												 "Ucheck":txtCheqgg,
												 "Uwar":txtWarningg,
												 "Ucri":txtCriticalgg,
												 "Utipo_umbral":txtUmbralgg,
												 "Uhorario":txtHorariogg,
												 "contrato":contratogg,
												 "codigo_contrato":codigo_contratogg,
												 "cedula":cedulagg,
												 "ip":ipgg
												 };
												 $.ajax({
													data: Datos_Correo,
													url: 'pages/backend/includes/actualiza_detalle.php',
													type: 'post',
													success: function (response) {
															//$("#resultadoActualiza").html(response);
															 alertify.success("Valor Warning Actualizado.");
													}
												});
									}else if (claveCritical >= 0) {
											var nombre_hostgg= document.getElementById("nombre_ci").value;
	 										var id_detallesgg=servicio;
	 										var id_serviciogg=document.getElementById("lblServicio"+i).innerHTML;
	 										var txtDelagg=document.getElementById("lbldelay"+i).innerHTML;
	 										var txtCheqgg=document.getElementById("lbltiempoC"+i).innerHTML;
	 										var txtWarningg=document.getElementById("lblwarning"+i).innerHTML;
	 										var txtCriticalgg=document.getElementById("txtCritical"+i).value;
	 										var txtUmbralgg=document.getElementById("txtUmbral"+i).value;
	 										var txtHorariogg=document.getElementById("lblHorario"+i).innerHTML;
	 										var ipgg= document.getElementById("ip_ci").value;
	 										var contratogg=document.getElementById("nom_contrato").value;
	 										var codigo_contratogg= document.getElementById("cod_contrato").value;
	 										var cedulagg=document.getElementById("cedula").value;
	 										var Datos_Correo = {
	 											"nombre_host":nombre_hostgg,
	  										 "id_detalles":id_detallesgg,
	  										 "Uservicio":id_serviciogg,
	  										 "Udelay":txtDelagg,
	  										 "Ucheck":txtCheqgg,
	  										 "Uwar":txtWarningg,
	  										 "Ucri":txtCriticalgg,
	  										 "Utipo_umbral":txtUmbralgg,
	  										 "Uhorario":txtHorariogg,
	  										 "contrato":contratogg,
	  										 "codigo_contrato":codigo_contratogg,
	  										 "cedula":cedulagg,
	  										 "ip":ipgg
	 										 };
	 										 $.ajax({
	 											data: Datos_Correo,
	 											url: 'pages/backend/includes/actualiza_detalle.php',
	 											type: 'post',
	 											success: function (response) {
	 													//$("#resultadoActualiza").html(response);
	 													 alertify.success("Valor Critico Actualizado.");
	 											}
	 										});
									}else if (claveUmbral >=0 ) {
										var nombre_hostgg= document.getElementById("nombre_ci").value;
										var id_detallesgg=servicio;
										var id_serviciogg=document.getElementById("lblServicio"+i).innerHTML;
										var txtDelagg=document.getElementById("lbldelay"+i).innerHTML;
										var txtCheqgg=document.getElementById("lbltiempoC"+i).innerHTML;
										var txtWarningg=document.getElementById("lblwarning"+i).innerHTML;
										var txtCriticalgg=document.getElementById("lblcritical"+i).innerHTML;
										var txtUmbralgg=document.getElementById("txtUmbral"+i).value;
										var txtHorariogg=document.getElementById("lblHorario"+i).innerHTML;
										var ipgg= document.getElementById("ip_ci").value;
										var contratogg=document.getElementById("nom_contrato").value;
										var codigo_contratogg= document.getElementById("cod_contrato").value;
										var cedulagg=document.getElementById("cedula").value;
										var Datos_Correo = {
											"nombre_host":nombre_hostgg,
 										 "id_detalles":id_detallesgg,
 										 "Uservicio":id_serviciogg,
 										 "Udelay":txtDelagg,
 										 "Ucheck":txtCheqgg,
 										 "Uwar":txtWarningg,
 										 "Ucri":txtCriticalgg,
 										 "Utipo_umbral":txtUmbralgg,
 										 "Uhorario":txtHorariogg,
 										 "contrato":contratogg,
 										 "codigo_contrato":codigo_contratogg,
 										 "cedula":cedulagg,
 										 "ip":ipgg
										 };
										 $.ajax({
 										 data: Datos_Correo,
 										 url: 'pages/backend/includes/actualiza_detalle.php',
 										 type: 'post',
 										 success: function (response) {
											//$("#resultadoActualiza").html(response);
													alertify.success("Tipo de Umbral Actualizado.");
 										 }
 									 });
									}else if (claveHorario >= 0) {
										var nombre_hostgg= document.getElementById("nombre_ci").value;
										var id_detallesgg=servicio;
										var id_serviciogg=document.getElementById("lblServicio"+i).innerHTML;
										var txtDelagg=document.getElementById("lbldelay"+i).innerHTML;
										var txtCheqgg=document.getElementById("lbltiempoC"+i).innerHTML;
										var txtWarningg=document.getElementById("lblwarning"+i).innerHTML;
										var txtCriticalgg=document.getElementById("lblcritical"+i).innerHTML;
										var txtUmbralgg=document.getElementById("txtUmbral"+i).value;
										var txtHorariogg=document.getElementById("txtHorario"+i).value;
										var ipgg= document.getElementById("ip_ci").value;
										var contratogg=document.getElementById("nom_contrato").value;
										var codigo_contratogg= document.getElementById("cod_contrato").value;
										var cedulagg=document.getElementById("cedula").value;

										var Datos_Correo = {
											"nombre_host":nombre_hostgg,
 										 "id_detalles":id_detallesgg,
 										 "Uservicio":id_serviciogg,
 										 "Udelay":txtDelagg,
 										 "Ucheck":txtCheqgg,
 										 "Uwar":txtWarningg,
 										 "Ucri":txtCriticalgg,
 										 "Utipo_umbral":txtUmbralgg,
 										 "Uhorario":txtHorariogg,
 										 "contrato":contratogg,
 										 "codigo_contrato":codigo_contratogg,
 										 "cedula":cedulagg,
 										 "ip":ipgg
										 };
										 $.ajax({
											data: Datos_Correo,
											url: 'pages/backend/includes/actualiza_detalle.php',
											type: 'post',
											success: function (response) {
												//$("#resultadoActualiza").html(response);
													 alertify.success("Horario Actualizado.");
											}
										});
									}
									GuardandoDatosJuntos(lbl, txt, i);
								}
							}

						}

</script>
