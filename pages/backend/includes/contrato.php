<?php
include ('../../../modelo/conexion.php');
$oe= new conexion();


$conn = $oe->conexion->query("SELECT codigo, nombre FROM new_proyectos where estado='Abrir' ORDER BY nombre");


echo '<option value="0"></option>';

while($row = $conn->fetch_assoc())
{
	echo '<option value="'.$row['codigo'].'">'.$row['nombre'].'</option>';
}

$oe->cerrar();

?>

