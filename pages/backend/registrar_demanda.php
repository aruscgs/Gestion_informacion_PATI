<?php
session_start ();
if ($_SESSION ['authenticated'] == 1) {

include("../../modelo/conexion.php");

$editar             =$_POST['editar'];
$user_id            = $_SESSION['user_id'];
$id                 =$_POST['id_actividad'];
$numerotiquete      =$_POST['numerotiquete'];
$descripcion        =$_POST['descripcion'];
$id_contrato        =$_POST['id_contrato'];
$tiempoReal         =$_POST['tiempoReal'];
$dato=$_POST['dato'];
$estado=$_POST['estado'];
$horaExtra = $_POST ['horaExtra'];

$descripcion = str_replace("'", '\\\'', $descripcion );



if($horaExtra == 'Si'){
	$estado = 'P';
}else{
	$horaExtra = 'No';
	$estado = 'F';
}
$wish = new conexion ();
    

	date_default_timezone_set ('America/Bogota');
	$fecha=$dato;
	$fecha_fin = strtotime ( '+'.$tiempoReal.' minute' , strtotime ( $fecha ) ) ;
	$fecha_fin= strftime( '%Y-%m-%d %H:%M:%S', $fecha_fin);
	
$wish->registrardemanda ($user_id,$id,$descripcion,$fecha_fin,$tiempoReal,$numerotiquete,$id_contrato, $horaExtra, $dato, $estado);

$wish->cerrar(); 

header("Location: ../../index.php");
}
?>
