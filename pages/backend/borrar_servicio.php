<?php
session_start ();
if ($_SESSION ['authenticated'] == 1) {

include("../../modelo/conexion.php");
$con = new conexion;

	$borrar=$_POST['borrar'];
	$cedula=$_POST['cedula'];
	$contrato=$_POST['contrato'];
	

	$correo2="jhon.montoya@arus.com.co";
	$correo1="linux_noc@arus.com.co";
	
	
	$nombre_usuario=$con->conexion->query("select nombre from new_personas where cedula='$cedula'");
	$nom=$nombre_usuario->fetch_assoc();
	$nombre_user=$nom["nombre"];
	
	
	
	$query = $con->conexion->query ( "select  e.nombre as CI, b.tipo as Servicio from detalle_servicio a, tipo_servicios b,
									  hosts e where	a.id_host=e.id and a.id_tipo_servicio=b.id and a.id_detalle=$borrar" );
	
	$row = $query->fetch_assoc ();
	
	$con->deleteservicio($borrar);
	$con->cerrar();
	
	
	$headers = "MIME-Version: 1.0\r\n";
	$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
	$headers .= "From: Monitoreo NOC <compuredescgcnoc@arus.com.co>\r\n";
	$this_mail = mail($correo1, "Se elimina servicio en CI del contrato [$contrato]", "Se ha eliminado el servicio: ". $row['Servicio']." del CI :".$row['CI']."<br>
Persona que elimina: ".$nombre_user, $headers);

}

?>
