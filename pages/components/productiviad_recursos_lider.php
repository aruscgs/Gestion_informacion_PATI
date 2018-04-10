<?php
		function printColaboradores($lider,$conn) {
			$consulta = "select nombre,cargo,celular,
			(select avg(r.tiempo_calculado) from registro_actividad r where r.cedula = p.cedula and MONTH(r.fecha_inicio) = MONTH(NOW())  ) prod,
			(select count(r.tiempo_calculado) from registro_actividad r where r.cedula = p.cedula and MONTH(r.fecha_inicio) = MONTH(NOW()) ) cantidad,
			cedula from new_personas p where CAST(p.jefe AS INTEGER) = '$lider' order by prod desc";
			if ($consulta = $conn->conexion->query ( $consulta )) {
				while ( $obj = $consulta->fetch_object () ) {
					?>
	                                    <tr>
											<td><a class="glyphicon glyphicon-user"></a></td>
											<td><?php printf($obj->nombre);?></td>
											<td><?php printf($obj->cargo);?></td>
											<td><?php printf($obj->celular);?></td>
											<td><?php printf($obj->prod);?></td>
											<td><?php printf($obj->cantidad);?></td>
										</tr>
	                              		<?php
	                              		//printColaboradores($obj->cedula,$conn);
					}
					$consulta->close ();
			}
			
		}
	
?>


<!-- /.row -->

<!-- Main row -->
<div class="row">
	<!-- Left col -->
	<div class="col-md-12">
		<!-- MAP & BOX PANE -->
		<div class="box box-success">
			<div class="box-header with-border">
				<h3 class="box-title">Mis Colaboradores</h3>

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
							<table id="example" class="table table-striped table-bordered">
								<thead>
									<tr>
										<th></th> 
										<th>Nombre</th>
										<th>Cargo</th>
										<th>Celular</th>
										<th>Productividad</th>
										<th>N° Actividades</th>
									</tr>
								</thead>
								<tbody>
									<?php printColaboradores($userinfo->user_id,$wish); ?>
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
</div>