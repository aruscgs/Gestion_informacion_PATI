<?php

include ('../../../modelo/conexion.php');
$oe= new conexion();
$id = $_GET['info_id'];

$conn = $oe->conexion->query("select b.nombre from (SELECT jefe FROM new_personas WHERE cedula='$id')a,new_personas b where a.jefe=b.cedula");

while($row = $conn->fetch_assoc())
  {
  	echo $row['nombre'];
  }

$oe->cerrar();
?>
