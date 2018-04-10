<?php

include ('../../../modelo/conexion.php');
$oe= new conexion();
$id = $_GET['param_id'];


$conn = $oe->conexion->query("SELECT a.cedula, a.nombre FROM (SELECT T1.nombre, T1.cedula, T1.proyecto, T1.estado from new_personas T1 where T1.cedula not in ( select cedula from sub_grupo T2)) a WHERE a.proyecto='$id'");

echo '<option value="0"></option>';

while($row = $conn->fetch_assoc())
	{
		echo '<option value="'.$row['cedula']. '">'.$row['nombre'].'</option>';
	}

$oe->cerrar();
?>
