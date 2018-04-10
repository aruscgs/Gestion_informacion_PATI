
  
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
    
    $id_componente  =$_POST['id_componente'];
    $id_ci=$_POST["id_ci"];
    
  
    $con = new conexion;
    
    $detalles=$con->conexion->query("SELECT a.val_war,a.val_cri,b.nombre,a.disponibilidad,a.delay,a.tiempo_chequeo,a.horario,
    a.puerto,a.accion_critico from detalle_servicio a,tipo_umbral b where a.id_tipo_umbral=b.id_tipo_umbral and a.id_host='$id_ci' 
    and a.id_tipo_servicio='$id_componente' and
    estado='I'");
    
   // $wish->activarContrato($codigo,$alias,$lider);

    
}


?>

<div>
<table >

   <tr>
      <th>WARNING</th>
      <th>CRITICAL</th>
      <th>TIPO UMBRAL</th>
      <th>DISPONIBILIDAD</th>
      <th>DELAY</th>
      <th>T.CHEQUEO</th>
      <th>HORARIO</th>
      <th>PUERTO</th>
      <th>A.CRÍTICA</th>
     
   
   </tr>
   
   <?php while($det=$detalles->fetch_assoc()){?>
   
   <tr>
     <td><?php echo $det["val_war"]?></td>
     <td><?php echo $det["val_cri"]?></td>
     <td><?php echo $det["nombre"]?></td>
     <td><?php echo $det["disponibilidad"]?></td>
     <td><?php echo $det["delay"]?></td>
     <td><?php echo $det["tiempo_chequeo"]?></td>
     <td><?php echo $det["horario"]?></td>
     <td><?php echo $det["puerto"]?></td>
     <td><?php echo $det["accion_critico"]?></td>
   
   </tr>
           
  <?php } ?>

</table>



</div>
<br>


 <button  class="btn btn-success pull" onclick="recupera('<?php echo $id_ci?>','<?php echo $id_componente?>')">Recuperar componente</button> 
         <a href="index.php"><button type="button" class="btn btn-danger">Cancelar</button></a>


<script>


function recupera(ci,componente) {

   $.ajax({
        type: 'POST',
        url: 'pages/backend/includes/recuperar_detalle.php',
        data: {ci: ci,
               componente: componente},

               success: function (response) {

            	   alertify.alert("<b>Componente recuperado existosamente", function () {
            			 location.reload();
            		    });

            	     
            	   
            	  // window.setTimeout('location.reload()');
               }
               
	   });

	
}

</script>
