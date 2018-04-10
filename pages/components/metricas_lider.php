<?php

$numanalista = $wish->getColaboradoresFromLider($userinfo->user_id);
$numeroactividades = $wish->getProductividadColaboradores($userinfo->user_id);
$contratos = $wish->getContratosByLider($userinfo->user_id);
$pendientes = $wish->getPendientesByLider($userinfo->user_id);


?>
 <div class="row">        
	<div class="col-md-3 col-sm-6 col-xs-12">
		<div class="info-box hover-zoom-effect">
			<div class="icon bg-aqua">
				<i class="fa fa-users" aria-hidden="true"></i>
			</div>
			<div class="content">
				<div class="text">N° Colaboradores</div><br>
				<div class="number">
                    <?php	
						while ( $row = $numanalista->fetch_array ( MYSQLI_NUM ) ) {
						echo $row [0] . "<br/>\n";
						}
							?></div>
			</div>
		</div>
	</div>	
	
	
	<div class="col-md-3 col-sm-6 col-xs-12">
		<div class="info-box hover-zoom-effect">
			<div class="icon bg-red">
				<i class="fa fa-line-chart" aria-hidden="true"></i>
			</div>
			<div class="content">
				<div class="text">Productividad</div><br>
				<div class="number">
                    <?php
										while ( $row = $numeroactividades->fetch_array ( MYSQLI_NUM ) ) 
										{
										echo round ( $row [0] ) . "<br/>\n";
										}
								?></div>
			</div>
		</div>
	</div>

	<div class="col-md-3 col-sm-6 col-xs-12">
		<div class="info-box hover-zoom-effect">
			<div class="icon bg-green">
				<i class="fa fa-file" aria-hidden="true"></i>
			</div>
			
			<div class="content">
				<div class="text">N° Contratos</div><br>
				<div class="number">
				<a href="index.php?page=011"> 
                    <?php	
									while ( $row = $contratos->fetch_array ( MYSQLI_NUM ) ) {
									echo $row [0] . "<br/>\n";
									}
								 ?></a></div>
			
			</div>			
		</div>
	</div>	

	<div class="col-md-3 col-sm-6 col-xs-12">
		<div class="info-box hover-zoom-effect">
			<div class="icon bg-yellow">
				<i class="fa fa-envelope-o" aria-hidden="true"></i>
			</div>
			
			<div class="content">
				<div class="text">N° Pendientes</div><br>
				<div class="number">
				<a href="index.php?page=010"> 
                    <?php	
									while ( $row = $pendientes->fetch_array ( MYSQLI_NUM ) ) {
									echo $row [0] . "<br/>\n";
									}
								?></a></div>
			</div>
		</div>
	</div>	
       

      </div>
      <!-- /.row -->
