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

$titulo = "Contratos Inactivos";
$query = "select codigo,nombre,estado  FROM new_proyectos WHERE   ROW(codigo, " . $user_id . ") NOT IN(select codigo,id_lider from new_lider_contratos) and estado = 'Abrir';";
$columns = array (
		"codigo" => "Codigo del proyecto",
		"nombre" => "Nombre",
);

?>
<link rel="stylesheet"
	href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
<!-- Estilo DataTable  -->
<link
	href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css"
	rel="stylesheet" />
<link
	href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.1/semantic.min.css"
	rel="stylesheet" />
<link
	href="https://cdn.datatables.net/1.10.12/css/dataTables.semanticui.min.css"
	rel="stylesheet" />


<script>
            document.getElementById("inicio").disabled = true;
            $(document).ready(function() {
                $('#zctb').DataTable( {
                    "aaSorting": [[ 1, "desc" ]]
                } );
            } );

            function test(link){
                var id = link.name;
                console.log("Link seleccionado: "+link.name);
                $('html,body').scrollTop(0);
            }



            function aprobar(codigo,nombre,lider){
            	console.log("metodo");
                var parametros = {
                        "codigo" : codigo,
                        "alias" : nombre,
                        "lider" : lider
                };
                $.ajax({
                        data:  parametros,
                        url:   'pages/backend/activar_contrato.php',
                        type:  'post',
                        beforeSend: function () {
                                console.log("iniciando");
                                $('#dataTables-contratos').load(document.URL +  ' #dataTables-contratos');
                        },
                        success:  function (response) {
                        		location.reload();
                        }
                });
            }


        </script>





<div class="panel-body">
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title"><?php echo $titulo; ?></h3>
				</div>
				<div class="box-body">
					<table id="dataTable-contratos"
						class="table table-bordered table-striped">
						<thead>
							<tr>
                <?php

																foreach ( $columns as $col => $show_col ) {
																	?>
														<th><?php printf($show_col)?></th>
													<?php
																}
																?>
																<th>Activar</th>
							</tr>
						</thead>
						<tbody>
                <?php

																if ($consulta = $wish->conexion->query ( $query )) {
																	while ( $arr = $consulta->fetch_array () )

																	{
																		?>
												<tr>
													<?php

																		foreach ( $columns as $col => $show_col ) {
																			?>
														<td><?php printf($arr[$col])?></td>
													<?php
																		}
																		?>
															<td><a><input
										onclick="aprobar('<?php printf($arr["codigo"]);?>','<?php printf($arr["nombre"]);?>','<?php echo $user_id;?>')"
										type="image" src="dist/img/checkmark.svg"></a></td>
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
		</div>
	</div>
</div>


<!-- DataTables -->
<script
	src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script
	src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
<script
	src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
<script
	src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script
	src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script
	src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script
	src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
<script
	src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>

<script
	src="https://cdn.datatables.net/1.10.12/js/dataTables.semanticui.min.js"></script>
<script
	src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.1/semantic.min.js"></script>

<!-- SlimScroll -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->

<script>
        $(document).ready(function() {
            $('#dataTable-contratos').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                     'excel'
                ]
            } );
        } );

    </script>
