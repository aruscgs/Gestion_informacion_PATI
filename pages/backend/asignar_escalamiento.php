<link rel="stylesheet" href="plugins/alertify.default.css">
<link rel="stylesheet" href="plugins/alertify.core.css">
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>


<?php
session_start ();
if ($_SESSION ['authenticated'] == 1) {

include("../../modelo/conexion.php");

$wish=new conexion();

$cedula=$_POST['nombre'];

$wish->crearEscalamiento($cedula);

echo "<script>
alertify.alert('<b>Añadido Correctamente!</b>', function(){ alertify.success('Ok') });
     </script>";



}

?>
