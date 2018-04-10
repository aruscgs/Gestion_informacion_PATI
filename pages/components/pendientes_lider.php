<script src="dist/js/pages/registro_actividad.js"></script>
<script src="dist/js/pages/jquery.js"></script>
<script src="dist/js/pages/operaciones.js"></script>


<script>

        function aprobar(id){
            var parametros = {
                    "id" : id
            };
            $.ajax({
                    data:  parametros,
                    url:   'pages/backend/aprobar.php',
                    type:  'post',
                    beforeSend: function () {
                            console.log("iniciando");
                            $('#dataTables-example').load(document.URL +  ' #dataTables-example');
                    },
                    success:  function (response) {
                            console.log("finalizado");
                            $('#dataTables-example').load(document.URL +  ' #dataTables-example');
                    }
            });
        }

        function desaprobar(id){
            var parametros = {
                    "id" : id
            };
            $.ajax({
                    data:  parametros,
                    url:   'pages/backend/desaprobar.php',
                    type:  'post',
                    beforeSend: function () {
                            console.log("iniciando");
                          $('#dataTables-example').load(document.URL +  ' #dataTables-example');
                    },
                    success:  function (response) {
                            console.log("finalizado");
                            $('#dataTables-example').load(document.URL +  ' #dataTables-example');
                    }
            });
        }
    </script>




<?php
$consulta = "SELECT
             r.id,
             a.categoria,
             a.actividad,
             a.plataforma,
             p.nombre as proyect,
             r.descripcion,
             r.fecha_inicio,
             r.numerotiquete,
             r.fecha_fin,
             r.tiempo_calculado,
             r.tiempoReal,
             r.estado,
             u.correo,
             r.horaExtra    
         FROM registro_actividad r,
                  actividad a,
                  new_proyectos p,
                  new_personas u
             where a.id = r.id_actividad and
                     u.cedula= r.cedula and
                     cast(u.jefe as int)='$userinfo->user_id' and
                     r.id_contrato = p.codigo and
                     r.estado ='P'
                    order by  r.fecha_inicio desc;";

?>




<div class="row">
	<!-- Left col --> 
	<div class="col-md-12">
		<!-- MAP & BOX PANE -->
		<div class="box box-success">
			<div class="box-header with-border">
				<h3 class="box-title">Pendientes</h3>

				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool"
						data-widget="collapse">
						<i class="fa fa-minus"></i>
					</button>
					<button type="button" class="btn btn-box-tool" data-widget="remove">
						<i class="fa fa-times"></i>
					</button>
				</div>
			</div>
			<!-- /.box-header -->
			<div class="box-body no-padding">
				<div class="row">
					<div class="col-md-12 col-sm-8">
						<div class="pad">
							<!-- Map will be created here -->
							<table class="table table-striped table-bordered table-hover"
								id="dataTables-example">
								<thead>
									<tr>
										<th>Correo</th>
										<th>Actividad</th>
										<th>Descripcion</th>
										<th>Fecha Inicio</th>
										<th>Duración</th>										                                         <th>Hora Extra</th>
										<th>Aprobar</th>
										<th>Denegar</th>

									</tr>
								</thead>
								<tbody>
                                        <?php
																																								
																																								if ($consulta = $wish->conexion->query ( $consulta )) {
																																									while ( $obj = $consulta->fetch_object () ) 

																																									{
																																										
																																										?>
                                            <tr>
										<td><?php printf($obj->correo);?></td>
										<td><?php printf($obj->actividad);?></td>
										<td><?php printf($obj->descripcion);?></td>
										<td><?php printf($obj->fecha_inicio);?></td>
										<td><?php printf($obj->tiempoReal);?></td>
								
                                                                                <td><?php printf($obj->horaExtra);?></td>
                                                                   		<td><a><input onclick="aprobar(<?php printf($obj->id);?>)"
												type="image" src="dist/img/checkmark.svg"></a></td>
										<td><a><input onclick="desaprobar(<?php printf($obj->id);?>)"
												type="image" src="dist/img/cross.svg"></a></td>


									</tr>
                                            <?php
																																									
}
																																									$consulta->close ();
																																								}
																																								?>
                                    </tbody>
							</table>
						</div>
					</div>
					<!-- /.TABLA DE DATA TABLE -->


				</div>
				<!-- /.row -->
			</div>
			<!-- /.box-body -->
		</div>
	</div>





	<!-- /.col -->
</div>

<!-- /.content-wrapper -->


<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
	<!-- Create the tabs -->
	<ul class="nav nav-tabs nav-justified control-sidebar-tabs">
		<li><a href="#control-sidebar-home-tab" data-toggle="tab"><i
				class="fa fa-home"></i></a></li>
		<li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i
				class="fa fa-gears"></i></a></li>
	</ul>
	<!-- Tab panes -->
	<div class="tab-content">
		<!-- Home tab content -->
		<div class="tab-pane" id="control-sidebar-home-tab"></div>
		<!-- /.tab-pane -->
		<!-- Stats tab content -->
		<div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
		<!-- /.tab-pane -->
		<!-- Settings tab content -->
		<div class="tab-pane" id="control-sidebar-settings-tab"></div>
		<!-- /.tab-pane -->
	</div>
</aside>
<!-- /.control-sidebar -->
<!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
<div class="control-sidebar-bg"></div>

<!-- ./wrapper -->



<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>


