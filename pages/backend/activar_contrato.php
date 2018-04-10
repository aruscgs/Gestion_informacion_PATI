<?php
session_start ();
if ($_SESSION ['authenticated'] == 1) {
	include("../../modelo/conexion.php");

$codigo  =$_POST['codigo'];
$lider  =$_POST['lider'];
$alias  =$_POST['alias'];

$wish = new conexion; 
$wish->activarContrato($codigo,$alias,$lider);
$wish->cerrar(); 

}


?>