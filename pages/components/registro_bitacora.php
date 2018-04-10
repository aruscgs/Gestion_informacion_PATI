<script src="plugins/jquery.table2excel.js"></script>

<style>
#cronometro [type=button] {
	font: normal 9pt arial;
	width: 14%;
}



.boton.disabled, .boton[disabled], fieldset[disabled] .boton {
	cursor: not-allowed;
	filter: alpha(opacity = 65);
	-webkit-box-shadow: none;
	box-shadow: none;
	opacity: .75;
}

.boton:hover {
	color: #333;
	background-color: #e6e6e6;
	border-color: #adadad;
}

@media ( max-width : 700px) {
	#cronometro {
		width: 40%;
	}
}
</style>




<script>
function inserta_actividad(cedula){

		var parametros = {
	           
	            "cedula": cedula
	        };
		
	    $.ajax({
	        
	       	type:  'POST',
	       	
	       	url:   'pages/backend/inserta_primera_actividad.php',
	       	
	        data: parametros,
	              
	               success:  function (data) 
	               {
	                  $("#tiempo").html(data);

	               }
	       });


		

		
	}
</script>



<?php
// Para los festivos
$dias = array ();
$conn = $wish->conexion->query ( "SELECT fecha FROM festivo " );
$horas = $wish->conexion->query ( "select sum(tiempoReal) as total from registro_actividad r 
								where cedula = $userinfo->user_id and DATE(fecha_inicio) = DATE(NOW()) and estado in ('F', 'R');" );

$min1 = $wish->conexion->query ( "select tiempo_calculado, descripcion, fecha_inicio from registro_actividad where id_contrato=1 and cedula=$userinfo->user_id" );
$valor1 = $min1->fetch_row ();

$min2 = $wish->conexion->query ( "select tiempo_calculado, descripcion, fecha_inicio from registro_actividad where id_contrato=2 and cedula=$userinfo->user_id" );
$valor2 = $min2->fetch_row ();

$min3 = $wish->conexion->query ( "select tiempo_calculado, descripcion, fecha_inicio from registro_actividad where id_contrato=3 and cedula=$userinfo->user_id" );
$valor3 = $min3->fetch_row ();

$total = $horas->fetch_row ();
$falta = 570 - $total [0];
while ( $row = $conn->fetch_assoc () ) {
	$dias [] = $row ['fecha'];
}

$ctrl = $wish->getFechaControlUser ( $userinfo->user_id );




/*$pending_query = "select 
v.selected_date, 
(select  (sum(tiempoReal)/60) as registro 
	from registro_actividad 
    where cedula = $userinfo->user_id 
		and DATE_FORMAT(fecha_inicio,'%Y-%m-%d') = v.selected_date
) as tiempo 
from 
(select adddate('1970-01-01',t4.i*10000 + t3.i*1000 + t2.i*100 + t1.i*10 + t0.i) selected_date from
 (select 0 i union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9) t0,
 (select 0 i union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9) t1,
 (select 0 i union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9) t2,
 (select 0 i union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9) t3,
 (select 0 i union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9) t4) v
where v.selected_date between '$ctrl' and NOW() - INTERVAL 1 DAY
and DATE_FORMAT(v.selected_date,'%w') <> 0 
and DATE_FORMAT(v.selected_date,'%w') <> 6
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[0]'
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[1]'
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[2]'
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[3]'
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[4]'
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[5]'
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[6]'
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[7]'
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[8]'
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[9]'
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[10]' 
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[11]'
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[12]'
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[13]'
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[14]'
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[15]'
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[16]'";*/


$primer_dia=$wish->conexion->query("select DATE_FORMAT(now(),'%Y-%m-%d') - interval (day(now())-1) day as primero");
$primero=$primer_dia->fetch_assoc();
$primer_dia_mes= $primero["primero"];


$estado_usuario=$wish->conexion->query("select estado from new_personas where cedula=$userinfo->user_id");
$estado=$estado_usuario->fetch_assoc();


if($estado["estado"]=='2'){

    $cedula=$userinfo->user_id;
    
   // echo $cedula."<br>";
    
    $fecha = date('Y-m-j');
    //echo "fecha actual ".$fecha. "<br>";
    //echo date('j')." dia actual <br>";
    $nuevafecha = strtotime ( '+1 day' , strtotime ( $fecha ) ) ;
    $nuevafecha = date ( 'Y-m-j' , $nuevafecha );
    $primer_dia_mes=$nuevafecha;   
    //echo $primer_dia_mes." dia actual mas 1" ;
    
    if(date('j')=='01'){
        
        $wish->cambia_estado_persona($cedula);
        
    }
    //echo $estado["estado"];

}

$pending_query ="select v.selected_date,(select (sum(tiempoReal)/60) as registro
 from registro_actividad where cedula = $userinfo->user_id and DATE_FORMAT(fecha_inicio,'%Y-%m-%d') = v.selected_date ) 
as tiempo from (select fecha as selected_date from fecha_control)v where v.selected_date BETWEEN '$primer_dia_mes' 
and date_add(NOW(), INTERVAL -1 DAY) and DATE_FORMAT(v.selected_date,'%w') <> 0 and DATE_FORMAT(v.selected_date,'%w') <> 6
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[0]'
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[1]'
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[2]'
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[3]'
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[4]'
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[5]'
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[6]'
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[7]'
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[8]'
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[9]'
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[10]' 
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[11]'
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[12]'
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[13]'
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[14]'
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[15]'
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[16]'";






$pen = $wish->conexion->query ( $pending_query );
$registros = 0;
$reg_pen = array ();
while ( $arr = $pen->fetch_array () ) {
	$selected_date = $arr ["selected_date"];
	$tiempo = $arr ["tiempo"];
	$tmp = array (
			$selected_date => $tiempo 
	);
	if ($tiempo < 8.5) {
		array_push ( $reg_pen, $tmp );
		$registros ++;
	}
}

$current_query = "select 
DATE_FORMAT(fecha_inicio,'%T') hora, id,
(select a.actividad from actividad a where a.id = r.id_actividad) actividad,
(select a.categoria from actividad a where a.id = r.id_actividad) categoria,
descripcion,
tiempoReal
from 
registro_actividad r 
where cedula = $userinfo->user_id and DATE(fecha_inicio) = DATE(NOW()) and estado = 'F'
order by fecha_inicio desc;";

$reg_cur = $wish->conexion->query ( $current_query );

?>
<!-- Cronometro -->

<script src="dist/js/pages/operaciones.js"></script>
<script src="dist/js/pages/cronometro.js"></script>
<script src="dist/js/pages/registro_actividad.js"></script>


<link type="text/css" rel="stylesheet"
	href="dist/css/pages/contador.css">




<link type="text/css" rel="stylesheet"
	href="dist/css/pages/cronometro.css">

<link href="https://fonts.googleapis.com/icon?family=Material+Icons"
	rel="stylesheet" type="text/css">





<script>


function reiniciar(val)
{	
	num=val
	alertify.confirm( 'Reiniciar actividad', function (e) {
	    if (e) {
	    	reiniciando(num);
	    } else {
	    	alertify.error('Cancelado');
	    }
	});    
}

            document.getElementById("inicio").disabled = true;             
            $(document).ready(function() {
                $('#zctb').DataTable( {
                    "aaSorting": [[ 4, "desc" ]]
                } );
            } );

            function test(link){
                var id = link.name;
                console.log("Link seleccionado: "+link.name);
                $('html,body').scrollTop(0);
            }
        </script>


<?php
$query = $wish->getActiveTaskForUser ( $userinfo->user_id );
$row = mysqli_fetch_array ( $query );
$numero_filas = mysqli_num_rows ( $query );
$initialDate = $row ['fecha_inicio'];

?>


<!-- /.row -->
<!-- Main row -->
<div class="box box-success">
	<div class="box-header with-border">
		<h3 class="box-title">Actividades</h3>


	</div>
	<!-- /.box-header -->
	<div class="box-body no-padding">

		<div class="pad">
			<section class="col-lg-12 connectedSortable">

				<!-- Custom tabs (Charts with tabs)-->


				<!-- Tabs within a box -->		
			
			
					<?php
					if ($registros == 0) {
						?>
			
						<!-- EPACIO DE BOTONES E INPUTS -->




				<div id="n1">
					<div class="col-md-4">
						<div class="form-group">
							<form id="stopForm1" action="index.php?page=004" method="POST">
								<input type="hidden" name="especifica" value="1"> <input
									type="hidden" name="initDate1" id="initDate1"
									value="<?php echo $valor1[2];?>"> <input type="hidden"
									name="endTime1" id="endTime1" value="<?php echo $valor1[0];?>">
								<input type="hidden" id="user_id1"
									value="<?php echo $user_id ?>">
							</form>
							<div id="box">
								<div id="cronometro">
									<h2 id="act1"><?php echo $valor1[1];?></h2>

									<div id="counter">
										<div class="block">
											<span id="horas1">00</span>
										</div>

										<div class="block">
											<span id="minutos1">00</span>
										</div>

										<div class="block">
											<span id="segundos1">00</span>
										</div>
									</div>

									<div class="btns">
										<button type="button" class="btn btn-success waves-effect"
										
												class="boton" id="inicio1" onclick="empezar(1);inserta_actividad('<?php echo $user_id ?>');">

											<i class="fa fa-play" aria-hidden="true"></i>
										</button>


										<button type="button" class="btn btn-warning waves-effect"
											class="boton" id="parar1" onclick="parar(1);" disabled>
											<i class="fa fa-pause" aria-hidden="true"></i>
										</button>

										<button type="button" class="btn btn-danger waves-effect"
											class="boton" id="guardar1" onclick="guardar(1);" disabled>
											<i class="fa fa-floppy-o" aria-hidden="true"></i>
										</button>



										<button type="button" class="btn btn-primary waves-effect"
											class="boton" id="reiniciar1" onclick="reiniciar(1);"
											disabled>
											<i class="fa fa-refresh" aria-hidden="true"></i>
										</button>








										<button type="button" class="btn btn-info waves-effect"
											class="boton" id="btn1">2</button>
										<button type="button" class="btn btn-info waves-effect"
											class="boton" id="btn2">3</button>







									</div>
									<div id="resultado"></div>
									<div id="naziv"></div>

								</div>





							</div>
						</div>
					</div>
				</div>
				
				
				<!-- RELOJ FIN NEW #2 -->
				
				<div id="n2">
					<div class="col-md-4">
						<div class="form-group">
							<form id="stopForm2" action="index.php?page=004" method="POST">
								<input type="hidden" name="especifica" value="2"> <input
									type="hidden" name="initDate2" id="initDate2"
									value="<?php echo $valor2[2];?>"> <input type="hidden"
									name="endTime2" id="endTime2" value="<?php echo $valor2[0];?>">
								<input type="hidden" id="user_id2"
									value="<?php echo $user_id ?>">
							</form>
							<div id="box1">
								<div id="cronometro">
								<h2 id="act2"><?php echo $valor2[1];?></h2>

									<div id="counter1">
										<div class="block1">
											<span id="horas2">00</span>
										</div>

										<div class="block1">
											<span id="minutos2">00</span>
										</div>

										<div class="block1">
											<span id="segundos2">00</span>
										</div>
									</div>

										<div class="btns">
											<button type="button" class="btn btn-success waves-effect"
											
													class="boton" id="inicio2" onclick="empezar(2);inserta_actividad('<?php echo $user_id ?>');">

												<i class="fa fa-play" aria-hidden="true"></i>
											</button>
											<button type="button" class="btn btn-warning waves-effect"
												class="boton" id="parar2" onclick="parar(2);" disabled>
												<i class="fa fa-pause" aria-hidden="true"></i>
											</button>




											<button type="button" class="btn btn-danger waves-effect"
												class="boton" id="guardar2" onclick="guardar(2);" disabled>
												<i class="fa fa-floppy-o" aria-hidden="true"></i>
											</button>


											<button type="button" class="btn btn-primary waves-effect"
												class="boton" id="reiniciar2" onclick="reiniciar(2);"
												disabled>
												<i class="fa fa-refresh" aria-hidden="true"></i>
											</button>








											<button type="button" class="btn btn-info waves-effect"
												class="boton" id="btn3" disabled>1</button>
											<button type="button" class="btn btn-info waves-effect"
												class="boton" id="btn4" disabled>3</button>
										</div>
									<div id="resultado"></div>
									<div id="naziv"></div>

								</div>





							</div>
						</div>
					</div>
				</div>


				

				

							
							
									


				<!-- FIN RELOJ NEW #2 -->
				
				
				
				<div id="n3">
					<div class="col-md-4">
						<div class="form-group">
							<form id="stopForm3" action="index.php?page=004" method="POST">
								<input type="hidden" name="especifica" value="3"> <input
									type="hidden" name="initDate3" id="initDate3"
									value="<?php echo $valor3[2];?>"> <input type="hidden"
									name="endTime3" id="endTime3" value="<?php echo $valor3[0];?>">
								<input type="hidden" id="user_id3"
									value="<?php echo $user_id ?>">
							</form>
							<div id="box2">
								<div id="cronometro">
								<h2 id="act3"><?php echo $valor3[1];?></h2>

									<div id="counter2">
										<div class="block2">
											<span id="horas3">00</span>
										</div>

										<div class="block2">
											<span id="minutos3">00</span>
										</div>

										<div class="block2">
											<span id="segundos3">00</span>
										</div>
									</div>
									
									<div class="btns">

											<button type="button" class="btn btn-success waves-effect"
											
													class="boton" id="inicio3" onclick="empezar(3);inserta_actividad('<?php echo $user_id ?>');">

												<i class="fa fa-play" aria-hidden="true"></i>
											</button>



											<button type="button" class="btn btn-warning waves-effect"
												class="boton" id="parar3" onclick="parar(3);" disabled>
												<i class="fa fa-pause" aria-hidden="true"></i>

											</button>


											<button type="button" class="btn btn-danger waves-effect"
												class="boton" id="guardar3" onclick="guardar(3);" disabled>
												<i class="fa fa-floppy-o" aria-hidden="true"></i>
											</button>


											<button type="button" class="btn btn-primary waves-effect"
												class="boton" id="reiniciar3" onclick="reiniciar(3);"
												disabled>
												<i class="fa fa-refresh" aria-hidden="true"></i>
											</button>
											<button type="button" class="btn btn-info waves-effect"
												class="boton" id="btn5" disabled>1</button>
											<button type="button" class="btn btn-info waves-effect"
												class="boton" id="btn6" disabled>2</button>
										</div>

										
									<div id="resultado"></div>
									<div id="naziv"></div>

								</div>





							</div>
						</div>
					</div>
				</div>
				
				
				
				
				
				
				




				<!-- RELOJ NEW #3 -->

				<div></div>				
				<div> </div>
				<div> 								


					<!-- FIN RELOJ NEW #3 -->
					<table id="pendientes" class="table table-striped table-bordered">

						<tr>
							<td><label>Minutos Restantes</label></td>
							<td> <?php echo $falta;?></td>
						</tr>

					</table>
					<!-- FIN DE EPACIO DE BOTONES E INPUTS -->

					<div style="text-align: center;">

						<?php if($userinfo->area==23){?>							
							<a href="index.php?page=046&e=F" class="btn btn-app" id="e"   > 								<i class="fa fa-plane"></i> Registro Actividad
							</a>
								<?php }?>


                                                               
<?php if($userinfo->area!=23){?>	
<a href="index.php?page=046" class="btn btn-app"  > 
<i class="fa fa-edit"></i> Registro por Demanda
</a>

<?php }


$tiempo_pendiente=$wish->conexion->query("select v.selected_date as fecha,(select round(sum(tiempoReal)/60,2) as registro from
registro_actividad where cedula = $userinfo->user_id and DATE_FORMAT(fecha_inicio,'%Y-%m-%d') = v.selected_date ) as tiempo
from (select fecha as selected_date from fecha_control)v where YEAR(v.selected_date) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH)
AND MONTH(v.selected_date) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH) and DATE_FORMAT(v.selected_date,'%w') <> 0 and
DATE_FORMAT(v.selected_date,'%w') <> 6 
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[0]'
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[1]'
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[2]'
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[3]'
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[4]'
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[5]'
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[6]'
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[7]'
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[8]'
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[9]'
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[10]' 
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[11]'
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[12]'
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[13]'
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[14]'
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[15]'
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[16]'");

$tiempo_pendiente1=$wish->conexion->query("select v.selected_date as fecha,(select round(sum(tiempoReal)/60,2) as registro from
registro_actividad where cedula = $userinfo->user_id and DATE_FORMAT(fecha_inicio,'%Y-%m-%d') = v.selected_date ) as tiempo
from (select fecha as selected_date from fecha_control)v where YEAR(v.selected_date) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH)
AND MONTH(v.selected_date) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH) and DATE_FORMAT(v.selected_date,'%w') <> 0 and
DATE_FORMAT(v.selected_date,'%w') <> 6 
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[0]'
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[1]'
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[2]'
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[3]'
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[4]'
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[5]'
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[6]'
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[7]'
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[8]'
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[9]'
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[10]' 
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[11]'
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[12]'
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[13]'
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[14]'
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[15]'
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[16]'");

$fecha_control_usuario=$wish->conexion->query("select  Date_format(fecha_control,'%Y-%m') as fecha from new_usuario where cedula=$userinfo->user_id");
$f_control=$fecha_control_usuario->fetch_assoc();


 //año y mes actual
$fecha = date('Y-m');

 
$aux=0;

if($fecha != $f_control["fecha"]){
while($datos=$tiempo_pendiente->fetch_array()){
    
    if(($datos["fecha"] < "2018-02-09") && ($datos[1]==0 || $datos[1] < 8.50 || $datos[1]=="") ){
        
        $aux=1;
    }else{

        $aux=0;
    /*if($datos[1]==0 || $datos[1] < 9.50 || $datos[1]==""){
    $aux=1;
        }*/}
}
}
if($aux != 0){
   ?>
   	<a class="btn btn-app"  > <i
							class="fa fa-clock-o" title="Consulta el tiempo registrado en el mes anterior" id="consultar_tiempo"></i> <b><font color="red">Consultar tiempo pendiente</font></b>
						</a>
  
   <?php
}

?>
                                                                
							<a href="index.php?page=014" class="btn btn-app"  > <i
							class="fa fa-plane"></i> Registro de ausentismo
						</a>
						
					</div>
					
	<?php 
	

	
	?>
	
	<table id="tiempo_pendiente" style="display: none;">
	<thead>
	<tr>
	<td><b>FECHA</b></td>
	<td><b>TIEMPO REGISTRADO POR DÍA</b></td>
	<td><b>TIEMPO PENDIENTE EN MINUTOS</b></td>
	</tr>
	
	</thead>
	 <tbody>
	<?php while($row=$tiempo_pendiente1->fetch_assoc()){
	    
	    
	    ?>
	   
	        
	         
	         <?php 

if($row["fecha"] < "2018-02-09"){?>
    
    
           <tr>
  
	           <td><?php echo $row["fecha"]?></td>
	           
	           <td>
	           <?php      
	           if($row["tiempo"]=="" || $row["tiempo"]< "8.50"){
	               
	               //echo "<font color='red'>PENDIENTE</font><br>";
	               $valor=$row["tiempo"];
	               echo "<b><font color='red'>".$valor."</font></b>";
	               if($row["tiempo"]==""){
	                   echo "<b><font color='red'> 0 </font></b>";
	               }
	             
	           }else{
	               
	               echo $row["tiempo"];
	               
	               
	           }
	           
	           ?>
	           </td>
	               
	           <td>
	          <?php  
	           if($row["tiempo"]< "8.50"){
	               //echo 8.5-$row["tiempo"];
	               $valor=8.5-$row["tiempo"];
	               $final= (($valor*30)/0.5)." min";
	            
	                   
	               echo "<b><font color='red'>".$final."</font></b>";
       
	           }else{
	               
	               echo "<b><font color='green'>COMPLETADO</font></b>";
	           }
	               
	               
	           ?>
	           </td>
	         
	         
	         </tr>
	    
    
    
	<?php }else {?>         

   <tr>
  
	           <td><?php echo $row["fecha"]?></td>
	           
	           <td>
	           <?php      
	           if($row["tiempo"]=="" || $row["tiempo"]< "9.50"){
	               
	               //echo "<font color='red'>PENDIENTE</font><br>";
	               $valor=$row["tiempo"];
	               echo "<b><font color='red'>".$valor."</font></b>";
	               if($row["tiempo"]==""){
	                   echo "<b><font color='red'> 0 </font></b>";
	               }
	             
	           }else{
	               
	               echo $row["tiempo"];
	               
	               
	           }
	           
	           ?>
	           </td>
	               
	           <td>
	          <?php  
	           if($row["tiempo"]< "9.50"){
	               //echo 8.5-$row["tiempo"];
	               $valor=9.5-$row["tiempo"];
	               $final= (($valor*30)/0.5)." min";
	            
	                   
	               echo "<b><font color='red'>".$final."</font></b>";
       
	           }else{
	               
	               echo "<b><font color='green'>COMPLETADO</font></b>";
	           }
	               
	               
	           ?>
	           </td>
	         
	         
	         </tr>
         
	
	<?php }?>
	
	<?php }
	
	?>				
	   </tbody>
	    
	    </table>					
			
			<?php
					} else {
						?>
						<br>
					<div class="row">
						<div class="col-md-10 col-md-offset-1">
							<div class="callout callout-danger">
								<h3>Alerta!</h3>
								<p>
									El cronómetro no se activará hasta que se complete el tiempo
									diario necesario, el cual es de mínimo 8 horas y 30 minutos, en
									caso de ausentismos (vacaciones, permisos, incapacidades), por
									favor registrarlo en la sección de ausentismos, de lo contrario
									usar el registro por demanda para completar las horas
									pendientes. <br>
								</p>
							</div>


							<div class="pad">
								<!-- Map will be created here -->
								<h3 class="box-title">Registros Pendientes</h3>
								<table id="pendientes"
									class="table table-striped table-bordered">

									<thead>
										<tr>
											<th>Fecha </th>
											<th>Tiempo registrado</th>
											<th>Tiempo pendiente</th>
										</tr>
									</thead>
									<tbody>
                               <?php
						foreach ( $reg_pen as $r ) {
							foreach ( $r as $key => $value ) {
								$falta = 9.5 - $value;
								?>
                                    <tr>
											<td><?php printf($key);?></td>
											<td><?php printf(round($value,2));?></td>
											<td><?php printf(round($falta,2));?></td>
										</tr>
                                            <?php
							}
						}
						?>
                                        </tbody>
								</table>
								<div class="col-md-offset-4">
									<a href="index.php?page=046" class="btn btn-app"> <i
										class="fa fa-edit"></i> Registro por Demanda
									</a> <a href="index.php?page=014" class="btn btn-app"> <i
										class="fa fa-plane"></i> Registro de ausentismo
									</a>
									
								</div>
							</div>
						</div>
					</div>
 			
 			
			<?php }?>
		</div>




				<script>
    
    $('.count').each(function () {
    $(this).prop('Counter',0).animate({
        Counter: $(this).text()
    }, {
        duration: 2500,
        easing: 'swing',
        step: function (now) {
            $(this).text(Math.ceil(now));
        }
    });
});
    
    </script>


    <?php
				if ($numero_filas > 0) {
					?>
    <script>
    /*
       // var d = <?php// echo "'".$initialDate."'" ?>;
        var date = new Date(d.substr(0, 4), d.substr(5, 2) - 1, d.substr(8, 2), d.substr(11, 2), d.substr(14, 2), d.substr(17, 2));
        console.log("date: "+date);
        inicioAutomatico(date);*/
        
    </script>
    <?php
				}
				?>		
			
			</section>

		</div>
	</div>
</div>
<script>

	$(document).ready(function(){
	    	 $("#n2").find("input,select,button").prop("disabled",true);
			 $("#n3").find("input,select,button").prop("disabled",true); 
	    	});

	$("#btn1").on("click", function(){
		$("#n2").find("input, #inicio2, #btn3, #btn4").prop("disabled",false);
		$("#n1").find("input, button").prop("disabled",true);
	});
	$("#btn2").on("click", function(){
		$("#n3").find("input, #inicio3, #btn5, #btn6").prop("disabled",false);
		$("#n1").find("input, button").prop("disabled",true);
		$("#n2").find("input, button").prop("disabled",true);
	});
	$("#btn3").on("click", function(){
		$("#n1").find("input, #inicio1, #btn1, #btn2").prop("disabled",false);
		$("#n2").find("input, button").prop("disabled",true);
		$("#n3").find("input, button").prop("disabled",true);
	});
	$("#btn4").on("click", function(){
		$("#n3").find("input, #inicio3, #btn5, #btn6").prop("disabled",false);
		$("#n1").find("input, button").prop("disabled",true);
		$("#n2").find("input, button").prop("disabled",true);
	});
	$("#btn5").on("click", function(){
		$("#n1").find("input, #inicio1, #btn1, #btn2").prop("disabled",false);
		$("#n2").find("input, button").prop("disabled",true);
		$("#n3").find("input, button").prop("disabled",true);
	});
	$("#btn6").on("click", function(){
		$("#n2").find("input, #inicio2, #btn3, #btn4").prop("disabled",false);
		$("#n1").find("input, button").prop("disabled",true);
		$("#n3").find("input, button").prop("disabled",true);
	});
	
	
	$("#parar1").on("click", function(){
		document.getElementById("btn1").disabled = false;
		document.getElementById("btn2").disabled = false;
		document.getElementById("guardar1").disabled = false;		
	});
	
	$("#parar2").on("click", function(){
		document.getElementById("btn3").disabled = false;
		document.getElementById("btn4").disabled = false;
		document.getElementById("guardar2").disabled = false;
	});
	
	$("#parar3").on("click", function(){
		document.getElementById("btn5").disabled = false;
		document.getElementById("btn6").disabled = false;
		document.getElementById("guardar3").disabled = false;
	});



	$("#consultar_tiempo").click(function(){
		  $("#tiempo_pendiente").table2excel({
		    filename: "Tiempo pendiente"
		  }); 
		});


</script>
