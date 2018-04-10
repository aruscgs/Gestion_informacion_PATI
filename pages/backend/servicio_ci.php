	
	<link rel="stylesheet" href="plugins/alertify.default.css">
<link rel="stylesheet" href="plugins/alertify.core.css">
<script src="plugins/alertify.min.js"></script>


<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<?php
session_start ();
if ($_SESSION ['authenticated'] == 1) {
    
    
    
    
	
	error_reporting(E_ALL ^ E_NOTICE);
	include("../../modelo/conexion.php");
	
	$con = new conexion;
	
	
	$servicio=$_POST['servicio']; //ID TIPO SERVICIO
	$delay=$_POST['delay'];
	$check=$_POST['chequeo'];
	$war=$_POST['val_war'];
	$cri=$_POST['val_cri'];
	$tip=$_POST['tipo_umbral'];
	$respon=$_POST['responsables'];
	$id=$_POST['id_host']; // ID DE HOST
	$horario=$_POST['horario_noti'];
	$accion=$_POST['accion_cri'];
	$dispo='-';
	$puerto="N/A";
	
	$nombre_host=$_POST['nombre_host'];
	$ip=$_POST['ip'];
	$contrato=$_POST['contrato'];
	$codigo_contrato=$_POST['codigo_contrato']; //CODIGO DE CONTRATO
	$cedula=$_POST["cedula"];
	
	

	
	$nombre=$con->conexion->query("select nombre from new_personas where cedula='$cedula'");
	$nombre_usuario=$nombre->fetch_assoc();
	$nom=$nombre_usuario["nombre"];
	
		
	$ced = explode ('|',$respon);
	
	

	$cant=substr_count($respon, '|');
		
	for($i=0;$i<=$cant;$i++){
	    
	    $cedulas[]=$ced[$i];
	    
	    
	}
	
	
	?>
	
	
	
		<style>

table {
    border-collapse: collapse;
    width: 100%;
}

th, td {
    text-align: left;
    padding: 8px;
}

tr:nth-child(even){background-color: #f2f2f2}

th {
    background-color: #4CAF50;
    color: white;
}

th {
    background-color: #4CAF50;
    color: white;
}



</style>
	
	
        <form id="conf_escala" name="conf_escalamiento" action="" onSubmit="confi_escala(); return false" >
<div id="resultado3" style="display: none"><?php echo $nom?></div>
	<table id="configurar_escalamiento">
	
	
	 <thead>
	 
	 <tr>
	    <th><label>NOMBRE DE USUARIO</label></th>
	    <th><label>NIVEL DE ESCALAMIENTO</label></th>
	 </tr>
	 
	 </thead>
	
      <tbody>

<?php 



	 for($i=0;$i<count($cedulas);$i++){
	    
	     $nombre=$con->conexion->query("select nombre from new_personas where cedula='$cedulas[$i]'");
	     $nom=$nombre->fetch_assoc();
	     
	     
	     ?>
	     
	     <tr>
	           <td><label title="responsable<?php echo ($i+1)?>"  id="responsable<?php echo ($i+1)?>"><?php echo $nom["nombre"] ?></label></td>
               <td><select title="nivel_escala<?php echo ($i+1)?>" class="form-control" required="required" id="nivel_escala<?php echo ($i+1)?>">
                     <option></option>
                     <option value="1">1</option>
                     <option value="2">2</option>
                     <option value="3">3</option>
                     
                     </select></td>	     
	     </tr>
	     
	     <?php 
                } 

                ?>

     </tbody>	
	
	</table><br><br>
	
	
	
	<?php 
	$aux="nuevo";
	
	$arr_cedulas = "";
	$i = 0;
	
	foreach ($cedulas as $ced) {
	    
	    if ($i == 0) {
	        $arr_cedulas =  $ced;
	    } else {
	        $arr_cedulas = $arr_cedulas . "," . $ced;
	    }
	    
	    $i++;
	    
	}
	
	?>
	
	
	<!-- array de  cedulas -->
	
	<input id="cedula_responsables" type="hidden" name="cedulas" value="<?php echo $arr_cedulas?>">
	
	<input id="id_hosts" type="hidden" name="id_host" value="<?php echo $id?>">
	<input id="id_servicios" type="hidden" name="id_servicio" value="<?php echo $servicio?>">
	<input id="dispositivo" type="hidden" name="dispo" value="<?php echo $dispo?>">
	<input id="num_delay" type="hidden" name="delay" value="<?php echo $delay?>">
	<input id="valor_warning" type="hidden" name="val_war" value="<?php echo $war?>">
	<input id="valor_critical" type="hidden" name="val_cri" value="<?php echo $cri?>">
	<input id="umbral" type="hidden" name="tipo_umbral" value="<?php echo $tip?>">
	<input id="chequeo" type="hidden" name="check" value="<?php echo $check?>">
	<input id="horario_op" type="hidden" name="horario" value="<?php echo $horario?>">
	<input id="puertos" type="hidden" name="puerto" value="<?php echo $puerto?>">
	<input id="accion_cri" type="hidden" name="accion_critica" value="<?php echo $accion?>">
	<input id="auxiliar" type="hidden" name="aux" value="<?php echo $aux?>">
	
		<input id="nom_host" type="hidden" name="nombre_ci" value="<?php echo $nombre_host?>">
		<input id="ip" type="hidden" name="ip_ci" value="<?php echo $ip?>">
		<input id="nombre_contra" type="hidden" name="nombre_contrato" value="<?php echo $contrato?>">
		<input id="cod_contra" type="hidden" name="codigo_contrato" value="<?php echo $codigo_contrato?>">
		<input id="nombre_usuario" type="hidden" name="nom_usuario" value="<?php echo $nom?>">
	
	
	  
		<button type="submit" class="btn btn-success" style="width: 150px;">Guardar</button>

					<a><button onclick="refresca()" type="button" class="btn btn-danger"
							style="width: 150px;">Cancelar</button></a>
	
	</form>
	
	
	<script>

	function refresca() {
        setTimeout('document.location.reload()');
		
	}





	function confi_escala() {

        var escala="";
		var filas=document.getElementById("configurar_escalamiento").rows.length;
        var esc=(filas-1);
        var aux1=1;
 	   
        

for(i=1;i<=esc;i++){
  if(aux1 != esc){

		escala+=(document.getElementById("nivel_escala"+i).value)+",";
		  

	  }else{
			escala+=(document.getElementById("nivel_escala"+i).value);

	  }
  aux1+=1;
}



var cedulas=document.getElementById("cedula_responsables").value;
var id_host=document.getElementById("id_hosts").value;
var id_servicio=document.getElementById("id_servicios").value;
var dispo=document.getElementById("dispositivo").value;
var delay=document.getElementById("num_delay").value;
var val_war=document.getElementById("valor_warning").value;
var val_cri=document.getElementById("valor_critical").value;
var tipo_umbral=document.getElementById("umbral").value;
var check=document.getElementById("chequeo").value;
var horario=document.getElementById("horario_op").value;
var puerto=document.getElementById("puertos").value;
var accion_critica=document.getElementById("accion_cri").value;
var puerto=document.getElementById("puertos").value;
var aux=document.getElementById("auxiliar").value;

var nombre_ci=document.getElementById("nom_host").value;
var ip_ci=document.getElementById("ip").value;
var nombre_contrato=document.getElementById("nombre_contra").value;
var codigo_contrato=document.getElementById("cod_contra").value;
var nom_usuario=document.getElementById("resultado3").innerText;

		
		alertify.confirm( '<b>Desea guardar los datos diligenciados para el nuevo subcomponente?</b>', function (e) {
		    if (e) {


		    	
		        var parametros = {
	                    "cedulas": cedulas,     
	                    "id_host": id_host,     
	                    "id_servicio": id_servicio,                 
	                    "dispo": dispo,     
	                    "delay": delay,     
	                    "val_war": val_war,     
	                    "val_cri": val_cri,     
	                    "tipo_umbral": tipo_umbral,     
	                    "check": check,
	                    "horario": horario,
	                    "puerto": puerto,
	                    "accion_critica": accion_critica,
	                    "puerto": puerto,
	                    "aux": aux,
	                    "escala":escala,
	                    
	                    "nombre_ci":nombre_ci,
	                    "ip_ci":ip_ci,
	                    "nombre_contrato":nombre_contrato,
	                    "codigo_contrato":codigo_contrato,
	                    "nom_usuario":nom_usuario
	                    
	                };


		    	
		    	$.ajax({
			       
				type:  'POST',
				
				url:   'pages/backend/includes/inserta_conf_escala.php',
				
		         data: parametros,
				       success: function (response) {
				    	   $("#resultado").html(response);
   	   	   		         setTimeout(alertify.alert('<b>Subcomponente creado correctamente</b>'),5000);

   	   	   		//setTimeout(alertify.alert('<b>Subcomponente creado correctamente</b>', function(){ alertify.success('Ok') }),5000);
	                         setTimeout('document.location.reload()',5000);
			                   
		                    }
				});
             


		    	
		    } else {
		    	alertify.error('Cancelado');
		    }
		});  
		
	
	}

	
	
	</script>
	
	
	
	<?php
$con->cerrar();

}

?>
