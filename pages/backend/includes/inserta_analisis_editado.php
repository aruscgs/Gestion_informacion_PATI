<link rel="stylesheet" href="plugins/alertify.default.css">
<link rel="stylesheet" href="plugins/alertify.core.css">
<script src="plugins/alertify.min.js"></script>


<?php

include ('../../../modelo/conexion.php');
$oe= new conexion();
$id_analisis = $_POST['id_analisis'];
$descripcion_analisis = $_POST['analisis'];


echo $descripcion_analisis;
echo $id_analisis;

$oe->edita_analisis($id_analisis, $descripcion_analisis);

//echo "alertify.alert('<b>Cambios guardados correctamente');";

$oe->cerrar();
?>