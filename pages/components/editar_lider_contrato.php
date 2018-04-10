<?php 


		$titulo = "Contratos Activos";
		$query = "select c.codigo, c.alias,p.estado  FROM new_lider_contratos c,new_proyectos p WHERE c.id_lider =".$user_id." and c.codigo = p.codigo ;";
		$columns = array(
				"codigo" => "Codigo del proyecto",
				"alias" => "Nombre",
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

      

            function desactivar(codigo,lider){
            	console.log("metodo");
                var parametros = {
                        "codigo" : codigo,
                        "lider" : lider
                };
                $.ajax({
                        data:  parametros,
                        url:   'pages/backend/desactivar_contrato.php',
                        type:  'post',
                        beforeSend: function () {
                                console.log("iniciando");
                                $('#dataTables-edit-contratos').load(document.URL +  ' #dataTables-edit-contratos');
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
					<table id="dataTables-edit-contratos"
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
																<th>Desactivar</th>
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
															<td><a><input onclick="desactivar('<?php printf($arr["codigo"]);?>','<?php echo $user_id;?>')" type="image" src="dist/img/cross.svg"></a></td>		 
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
            $('#dataTables-edit-contratos').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                     'excel'
                ]
            } );
        } );
        
    </script>



