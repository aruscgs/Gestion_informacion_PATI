<?php
session_start ();
if ($_SESSION ['authenticated'] == 1) {
	
	include("../../modelo/conexion.php");
	
	
	$tipo=$_POST['tipo'];
	
	$con = new conexion;
	
	$consulta = $con->conexion->query ( "select count(*) from tipo_servicios where tipo='$tipo'");
	$num=$consulta->fetch_array();
	
	if ($num[0]==0)
	{
		$con->nuevoservicio($tipo);
	}
	$con->cerrar();
	
}
?>
