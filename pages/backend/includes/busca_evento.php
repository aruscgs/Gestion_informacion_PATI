<?php

include ('../../../modelo/conexion.php');
$oe= new conexion();

$tipo_evento=$_POST['tipo_evento'];
$txt='ind';
$txt2='mas';
$cedula=$_POST['cedula'];



if ($tipo_evento=='individual')
{
    $query = $oe->conexion->query ( "SELECT id FROM incidentecop" );
    
    echo '<option value="" disabled selected> Seleccione ID de incidente </option>';
    while($row = $query->fetch_assoc ())
    {
        
        echo '<option value="'.$row['id']."-".$txt."-".$cedula.'">'. $row['id'].' </option>';
    }
}

else
{
    $query = $oe->conexion->query ( "SELECT distinct id_evento  FROM registro_masivo " );
    
    echo '<option value="" disabled selected> Seleccione ID de incidente Masivo </option>';
    while($row = $query->fetch_assoc ())
    {
        echo '<option value="'.$row['id_evento']."-".$txt2."-".$cedula.'">'. $row['id_evento'].' </option>';
    }
}

$oe->cerrar();

?>








