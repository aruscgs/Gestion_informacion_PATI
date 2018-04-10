<?php

include ('../../../modelo/conexion.php');
$oe= new conexion();
$id = $_GET['info_id'];

$conn = $oe->conexion->query("select b.descripcion from (SELECT rol FROM new_usuario WHERE cedula='$id')a, cargo b where a.rol=b.id");

while($row = $conn->fetch_assoc())
  {
  	echo $row['descripcion'];
  }

$oe->cerrar();
?>
