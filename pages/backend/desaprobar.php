<?php
session_start ();
if ($_SESSION ['authenticated'] == 1) {
include("../../modelo/conexion.php");

$id  =$_POST['id'];

$wish = new conexion; 
$wish->actualizarEstado($id,"D");
$wish->cerrar(); 
}
?>