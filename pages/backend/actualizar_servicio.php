	
	<link rel="stylesheet" href="plugins/alertify.default.css">
<link rel="stylesheet" href="plugins/alertify.core.css">
<script src="plugins/alertify.min.js"></script>
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

<?php
session_start ();
if ($_SESSION ['authenticated'] == 1) {

        include("../../modelo/conexion.php");
        $con = new conexion();
        
        
        $respon=$_POST['Uresponsable']; // RESPONSABLE
        $nombre_host=$_POST['nombre_host']; //NOMBRE HOST
        $id=$_POST['id_detalles']; //ID DETALLE
        $dispo="-";
        $nom_servicio=$_POST['Uservicio']; //SERVICIO
        $delay=$_POST['Udelay'];//DELAY
        $check=$_POST['Ucheck']; //CHECK
        $war=$_POST['Uwar']; //VALOR WAR
        $cri=$_POST['Ucri']; //VALOR CRI
        $tip=$_POST['Utipo_umbral']; //TIPO_UMBRAL
        $horario=$_POST['Uhorario']; //HORARIO
        $puerto="N/A";
        $accion_critico=$_POST['Uaccion']; //ACCION_CRITICA
        $ip=$_POST['ip']; //IP
        $contrato=$_POST['contrato'];// NOMBRE DE CONTRATO
        $codigo_contrato=$_POST['codigo_contrato']; //CODIGO CONTRATO
        
        
        
        $cedula=$_POST['cedula']; //CEDULA DE QUIEN ACTUALIZA

        $i=0;

$nombre_actualiza=$con->conexion->query("select nombre,correo from new_personas where cedula='$cedula'");
$nombre_act=$nombre_actualiza->fetch_assoc();
$nombre_actua=$nombre_act["nombre"];
$correo_actualiza=$nombre_act["correo"];

         

   
        $num=0;
        $j=0;
        for($j;$j<count($respon);$j++){
            
            $num=$num+1;
            
        }
   
   
?>


	
    <form id="conf_escala" name="conf_escalamiento" action="" onSubmit="confi_escala(); return false" >
	<table id="configurar_escalamiento">
	 <thead>
	 
	 <tr>
	    <th><label>NOMBRE DE USUARIO</label></th>
	    <th><label>NIVEL DE ESCALAMIENTO</label></th>
	 </tr>
	 
	 </thead>
	
      <tbody>

<?php 

$string_cedulas="";


for($i;$i<count($respon);$i++){
    
if($i==($num-1)){
    $string_cedulas=$string_cedulas.$respon[$i];
}else{
    $string_cedulas=$string_cedulas.$respon[$i].",";
  
}
    
    $nombre=$con->conexion->query("select nombre from new_personas where cedula='$respon[$i]'");
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
	
	
	<!-- array de  cedulas -->
	
	<input id="cedula_responsables" type="hidden" name="cedulas" value="<?php echo $string_cedulas?>">
    <input id="nombre_host" type="hidden" name="nom_host" value="<?php echo $nombre_host?>">
	<input id="id_detalle_mod" type="hidden" name="id_detalle" value="<?php echo $id?>">
	<input id="disponibilidad" type="hidden" name="dispo" value="<?php echo $dispo?>">
   	<input id="nom_servicio" type="hidden" name="nombre_servicio" value="<?php echo $nom_servicio  ?>">
   	<input id="num_delay" type="hidden" name="delay" value="<?php echo $delay?>">
   	<input id="chequeo" type="hidden" name="check" value="<?php echo $check?>">
   	<input id="valor_warning" type="hidden" name="val_war" value="<?php echo $war?>">
	<input id="valor_critical" type="hidden" name="val_cri" value="<?php echo $cri?>">
   	<input id="umbral" type="hidden" name="tipo_umbral" value="<?php echo $tip?>">
       <input id="horario_op" type="hidden" name="horario" value="<?php echo $horario?>">
	   <input id="puertos" type="hidden" name="puerto" value="<?php echo $puerto?>">
	   <input id="accion_cri" type="hidden" name="accion_critica" value="<?php echo $accion_critico?>">
		<input id="ip" type="hidden" name="ip_ci" value="<?php echo $ip?>">
		<input id="nombre_contra" type="hidden" name="nombre_contrato" value="<?php echo $contrato?>">
		<input id="cod_contra" type="hidden" name="codigo_contrato" value="<?php echo $codigo_contrato?>">
		<input id="nombre_usuario_actualiza" type="hidden" name="nom_usuario" value="<?php echo $nombre_actua?>">
        <input id="correo_usuario_actualiza" type="hidden" name="nom_usuario" value="<?php echo $correo_actualiza?>">
		
		
	
	  
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



    	 var cedulas= $('#cedula_responsables').val(); 
    	 var nombre_host=document.getElementById("nombre_host").value;
    	 var id_detalle=document.getElementById("id_detalle_mod").value;
    	 var disponibilidad=document.getElementById("disponibilidad").value;
    	 var nom_servicio=document.getElementById("nom_servicio").value;
    	 var num_delay=document.getElementById("num_delay").value;    	 
    	 var chequeo=document.getElementById("chequeo").value;
     	 var valor_warning=document.getElementById("valor_warning").value;
    	 var valor_critical=document.getElementById("valor_critical").value;
    	 var umbral=document.getElementById("umbral").value;
    	 var horario_op=document.getElementById("horario_op").value;
    	 var puertos=document.getElementById("puertos").value;   	 
    	 var accion_cri=document.getElementById("accion_cri").value;
    	 var ip=document.getElementById("ip").value;
    	 var nombre_contra=document.getElementById("nombre_contra").value;
    	 var cod_contra=document.getElementById("cod_contra").value;
    	 var nombre_usuario_actualiza=document.getElementById("nombre_usuario_actualiza").value;
    	 var correo_usuario_actualiza=document.getElementById("correo_usuario_actualiza").value;
    	 

     	   var parametros1 = {
	    		     
     	             "cedulas":cedulas,
     	   		     "nombre_host":nombre_host,
     	   		     "id_detalle":id_detalle,
     	   		     "disponibilidad":disponibilidad,
     	   		     "nom_servicio":nom_servicio,
     			     "num_delay":num_delay,
     			     "chequeo":chequeo,
     			     "valor_warning":valor_warning,
     			     "valor_critical":valor_critical,
     	             "umbral":umbral,
     	             "horario_op":horario_op,
     	             "puertos":puertos, 	
     	             "accion_cri":accion_cri, 	
     	             "ip":ip, 	
     	             "nombre_contra":nombre_contra, 	
     	             "cod_contra":cod_contra,
     	             "nombre_usuario_actualiza":nombre_usuario_actualiza,
     	             "correo_usuario_actualiza":correo_usuario_actualiza,
     	             "escala":escala
     		    		    };
     	   		    $.ajax({
     	   		        data: parametros1,
     	   		        url: 'pages/backend/includes/actualiza_servicio.php',
     	   		        type: 'post',
     	   		       
     	   		        success: function (response) {

     			           // $('#configura_escala1').modal({show: 'false',backdrop: 'static', keyboard: false});
     	   	   		         setTimeout(alertify.alert('<b>Registros actualizados correctamente'),5000);
	                         setTimeout('document.location.reload()',5000);
     	   		         //  $("#resultado4").html(response);
     	   		        	//window.setTimeout('location.reload()');
     	   		        }
     	   		    });
}

</script>


<?php 
$con->cerrar();
}


?>
