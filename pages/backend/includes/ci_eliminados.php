<?php

include ('../../../modelo/conexion.php');
$oe= new conexion();
$id = $_GET['param_id'];


$conn = $oe->conexion->query("SELECT id, nombre, ip FROM hosts WHERE id_contrato = '$id' and estado='I'");

echo '<option value="0"></option>';

while($row = $conn->fetch_assoc())
{
    echo '<option value="'.$row['id']. '">'.$row['nombre']. " ------ ".  $row['ip'].'</option>';
}

$oe->cerrar();
?>
