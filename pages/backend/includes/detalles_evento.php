<?php

include ('../../../modelo/conexion.php');
$oe= new conexion();
$ids = $_GET['param_id'];

$algo=explode("-", $ids);


$id=$algo[0];
$mas=$algo[1];


if($mas == "ind")
{

	$query1 = $oe->conexion->query("select a.servicio_afectado,b.nombre,b.id_contrato,b.ip,c.nombre,
 d.tipo,a.fecha,e.nombre,a.estado,f.nombre,a.observaciones from incidentecop a,hosts b,new_proyectos c,tipo_servicios d,new_personas e,new_personas f where a.id='$id' and a.id_host=b.id
 and b.id_contrato=c.codigo and a.servicio_afectado=d.id and a.responsable=e.cedula and a.generado=f.cedula limit 1");
	
	$con=$oe->conexion->query("select a.nombre from new_personas a,solucion_incidente b where b.cierra_evento=a.cedula and b.id_evento='$id'");
	$res=$con->fetch_assoc();
	?>
	
	<br><h3>Información del evento:</h3>
	
	<?php 
	while($row = $query1->fetch_row())
	{
	    
	    if($row[8]=='P'){
	        $estado='Pendiente';
	    }else{
	        $estado='Solucionado';
	    }
	    
	    if($res['nombre']==""){
	        $cerro="Pendiente";
	    }else{
	        $cerro=$res['nombre'];
	    }
	    
		echo "<b>Estado del evento: </b>"."<b><FONT COLOR='red'> ".$estado."</b></FONT>"."<br><b> Nombre de CI: </b>".$row[1]."<br> <b>Código de contrato: </b>".$row[2]. "<br> <b>Nombre de contrato: </b>".  $row[4]."<br><b> IP: </b>".$row[3]."<br><b> Servicio afectado: </b>".$row[5]."<br> <b>Fecha y hora del evento:</b> "
		    .$row[6]."<br> <b>Responsable:</b> ".$row[7]."<br> <b>Persona que reporta: </b>".$row[9]."<br><b>Cerró el evento: </b>".$cerro."<br><b>Detalles: </b>".$row[10];
	}
}


else 
{   
    
    
	$query2 = $oe->conexion->query("select a.id_evento as numero_evento, b.id_contrato as codigo_contrato, c.nombre as nombre_Contrato,a.f_inicio,d.nombre,a.estado,a.descripcion from registro_masivo a,hosts b,new_proyectos c,new_personas d where a.id_host=b.id and
									b.id_contrato=c.codigo and a.id_evento=" . $id . " and a.responsable=d.cedula LIMIT 1");

	$query3 = $oe->conexion->query("SELECT DISTINCT a.nombre from hosts a, registro_masivo b where b.id_host=a.id and b.id_evento=".$id."");
	$cone=$oe->conexion->query("select a.nombre from new_personas a,solucion_incidente b where b.cierra_evento=a.cedula and b.id_evento='$id'");
	$resul=$cone->fetch_assoc();
	?>
	<br><h3>Información del evento:</h3>
	<?php 
	while ($row2 = mysqli_fetch_row($query2))
	{
	    if($row2[5]=='P'){
	        $estado='Pendiente';
	    }else{
	        $estado='Solucionado';
	    }
	    
	    if($resul['nombre']==""){
	        $cerro="Pendiente";
	    }else{
	        $cerro=$resul['nombre'];
	    }
	    
	    
	    echo "<b>Estado del evento: </b>"."<b><FONT COLOR='red'>".$estado."</b></FONT>"."<br><b> Evento número:</b> " . $row2[0] . "<br><b> Código de contrato:</b> " . $row2[1] . "<br> <b>Nombre de contrato:</b> " . $row2[2]."<br><b> Fecha y hora del evento: </b>".$row2[3]."<br><b> Responsable: </b>".$row2[4]."<br><b>Cerró el evento: </b>".$cerro."<br><b>Detalles: </b>".$row2[6]."<br> 
<b>CI's Afectados: </b><br>";
	}
	while ($row3 = $query3->fetch_assoc()){
	    
	    echo "* ".$row3['nombre']."<br>";
	}
}	
	$oe->cerrar();

?>

