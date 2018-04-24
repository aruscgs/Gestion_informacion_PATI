<link rel="stylesheet" href="pages/components/styles/metricas">
<style media="screen">
.info-box .content .text {
    font-size: 15px;
    margin-top: 8px;
    color: rgba(84, 83, 83, 0.95);
    font-weight: bold;
}
</style>
<?php
/*
 $query = $wish->getActiveTaskForUser ( $user_id );

 $row = mysqli_fetch_array ( $query );
 $numero_filas = mysqli_num_rows ( $query );
 $initialDate = $row ['fecha_inicio'];
 */
// Actividades del mes



$actividadesdelmes = $wish->getActividadesMesAnalista($userinfo->user_id);
$eventosAbiertos=$wish->getEventosAbiertos($userinfo->user_id);
$eventosMasivosAbiertos=$wish->getEventosMasivosAbiertos($userinfo->user_id);
$productividad = $wish->getProductividad($userinfo->user_id);
$eventos_cerrados=$wish->numero_eventos_cerrados($userinfo->user_id);




?>

<div class="row">

        	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="info-box hover-zoom-effect">
			<div class="icon bg-blue">
				<i class="fa fa-check-square-o" aria-hidden="true"></i>
			</div>

			<div class="content">
				<div class="text">Mis Eventos Cerrados</div><br>
				<div class="number">
					<a href="index.php?page=065"  >
					<span class="count"><?php


					while ( $row2 = $eventos_cerrados->fetch_array ( MYSQLI_NUM ) ) {
						echo $row2[0] . "<br/>\n";
					}

					?><br></span>
					</a>
				</div>
			</div>

		</div>

	</div>


     	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="info-box hover-zoom-effect">
			<div class="icon bg-green">
				<i class="fa fa-envelope" aria-hidden="true"></i>
			</div>

			<div class="content">
				<div class="text">Mis Eventos Pendientes</div><br>
				<div class="number">
					<a href="index.php?page=028"  >
					<span class="count"><?php





							while ( $row1 = $eventosAbiertos->fetch_array ( MYSQLI_NUM ) ) {
								echo $row1[0] . "<br/>\n";
						}

					?></span>
					</a>
				</div>
			</div>

		</div>

	</div>

<div class="col-md-3 col-sm-6 col-xs-12">
		<div class="info-box hover-zoom-effect">
			<div class="icon bg-yellow">
				<i class="fa fa-line-chart" aria-hidden="true"></i>
			</div>
			<div class="content">
				<div class="text">Productividad del mes</div><br>
				<div class="number">
                    <?php
																				while ( $row = $productividad->fetch_array ( MYSQLI_NUM ) ) {

																					echo $row [0] . "<br/>\n";
																				}
																				?></div>
			</div>
		</div>

	</div>








	<!-- ./col -->

	<!-- ./col -->
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="info-box hover-zoom-effect">
			<div class="icon bg-red">
				<i class="fa fa-calendar-check-o" aria-hidden="true"></i>
			</div>

			<div class="content">
				<div class="text">Actividades del mes</div><br>
				<div class="number">
					<a href="index.php?page=006"  >
					<span class="count"><?php
					while ( $row = $actividadesdelmes->fetch_array ( MYSQLI_NUM ) ) {
						echo $row [0] . "<br/>\n";
					}
					?></span>
					</a>
				</div>
			</div>

		</div>

	</div>
	<!-- ./col -->





</div>
