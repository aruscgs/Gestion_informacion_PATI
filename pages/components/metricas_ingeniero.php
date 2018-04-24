
<style>



.info-box {
   box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
   height: 80px;
   display: flex;
   background: -webkit-linear-gradient(left, #677e86 -100%,#ffffff 70%);
   border-radius: 50px;
}

.info-box .content .text {
    font-size: 14px;
    margin-top: 11px;
    color: rgba(84, 83, 83, 0.95);
    /* font-weight: bold; */
    font-weight: 700;
    font-style: italic;
}
.bg-blue {
    /* background-color: #2196F3 !important; */
    background: -webkit-gradient( linear, left top, left bottom, color-stop(0.05, #006699), color-stop(1, #008FD6) );
    color: #fff;
}
.bg-green {
    background: -webkit-gradient( linear, left top, left bottom, color-stop(0.05, #0b860a), color-stop(1, #26d600) );
}
.bg-yellow{
background: -webkit-gradient( linear, left top, left bottom, color-stop(0.05, #c5a70a), color-stop(1, #ffda01) );
}
.bg-red{
    background: -webkit-gradient( linear, left top, left bottom, color-stop(0.05, #af0000), color-stop(1, #ff1010) );
    }
    .bg-aqua, .callout.callout-info, .alert-info, .label-info, .modal-info .modal-body {
    /* background-color: #00c0ef !important; */
    background: -webkit-gradient( linear, left top, left bottom, color-stop(0.05, #16b1c0), color-stop(1, #10c8ff) );
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
