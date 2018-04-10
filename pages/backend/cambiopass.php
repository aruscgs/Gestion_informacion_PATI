<?php
session_start ();
if ($_SESSION ['authenticated'] == 1) {
include("../../modelo/conexion.php");

session_start(); 

$user_id      = $_SESSION['user_id'];
$cambiopass   =$_POST['cambiopass'];

$wish = new conexion; 
$wish->cambiopass($user_id,$cambiopass);
$wish->cerrar(); 
    
header("Location: ../../index.php");

}

?>
