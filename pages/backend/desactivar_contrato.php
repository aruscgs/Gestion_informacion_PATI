<?php
session_start ();
if ($_SESSION ['authenticated'] == 1) {
	include("../../modelo/conexion.php");

$codigo  =$_POST['codigo'];
$lider  =$_POST['lider'];

$wish = new conexion; 
$wish->desactivarContrato($codigo,$lider);
$wish->cerrar(); 

}


?>