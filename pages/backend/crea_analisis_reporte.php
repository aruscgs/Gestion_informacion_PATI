
<link rel="stylesheet" href="plugins/alertify.default.css">
<link rel="stylesheet" href="plugins/alertify.core.css">
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="plugins/alertify.min.js"></script>

<?php
session_start ();
if ($_SESSION ['authenticated'] == 1) {
	include("../../modelo/conexion.php");
	$wish = new conexion; 
	
	
$contrato  =$_POST['contrato'];
$plataforma  =$_POST['plataforma'];
$tipo  =$_POST['tipo'];
$ano  =$_POST['ano'];
$mes  =$_POST['mes'];
$analisis  =$_POST['analisis'];



$wish->registrar_analisis($contrato, $plataforma,$tipo, $ano, $mes, $analisis);

//$wish->actualizarEstado($id,"F");
$wish->cerrar(); 

}
?>




