<?php

include ('../../../modelo/conexion.php');
$oe= new conexion();
$id = $_GET['info_id'];

$conn = $oe->conexion->query("select distinct plataforma from hosts where plataforma 
is not null and plataforma <> '' and plataforma <> 'NULL'");


echo '<option value="" disabled selected></option>';
while($row = $conn->fetch_assoc())
{
    echo '<option value="'.$row['plataforma']. '">'.$row['plataforma'].'</option>';
}

$oe->cerrar();
?>