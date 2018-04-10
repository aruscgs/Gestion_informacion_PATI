<?php

include ('../../../modelo/conexion.php');
$oe= new conexion();


$ci= $_POST['ci'];
$componente = $_POST['componente'];

$oe->recuperar_detalle($ci, $componente);

$oe->cerrar();

?>