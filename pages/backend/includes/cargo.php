<?php

include ('../../../modelo/conexion.php');
$oe= new conexion();
$id = $_GET['info_id'];

$conn = $oe->conexion->query("SELECT cargo FROM new_personas WHERE cedula='$id'");

while($row = $conn->fetch_assoc())
  {
  	echo $row['cargo'];
  }

$oe->cerrar();
?>
