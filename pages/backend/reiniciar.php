<?php
session_start ();
if ($_SESSION ['authenticated'] == 1) {
	include("../../modelo/conexion.php");
	
	$user_id = $_POST['user'];
	$numero=$_POST['numero'];
	
	$wish = new conexion;
	$wish->reiniciar_reloj($user_id, $numero);
	$wish->cerrar();
}
?>