
<?php
session_start ();
if ($_SESSION ['authenticated'] == 1) {
    
    
    

include ('../../../modelo/conexion.php');
$wish=new conexion();

$id_evento=$_POST['id_evento'];
$tiquet=$_POST['tiquet'];
$tipo=$_POST['tipo'];
$rfc=$_POST['rfc'];
$fecha_fin=$_POST['fecha_fin'];
$detalles=$_POST['detalles'];
$tipo_evento = $_POST['tipo_evento'];
$cedula = $_POST['cedula'];



$query = "select ticket from solucion_incidente where ticket='$tiquet'";
$consulta = $wish->conexion->query($query);
$num = $consulta->fetch_assoc();



if($tipo_evento=='ind'){
    $tipo_incidente='individual';
    $wish->cambiarEstadoIncidente($id_evento);
}else{
    $tipo_incidente='masivo';
    $wish->cambiarEstadoIncidenteMasivo($id_evento);
}


$wish->insertarNuevoTiquet($tiquet,$id_evento,$tipo,$tipo_incidente,$rfc,$fecha_fin,
    $cedula,$detalles);
$wish->cerrar();

echo "true";


//echo "<script> redireccionar1(); </script>";


//header("Location: ../../index.php");

}
?>