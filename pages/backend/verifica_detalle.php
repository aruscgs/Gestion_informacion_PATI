<?php
session_start ();
if ($_SESSION ['authenticated'] == 1) {
    
    include("../../modelo/conexion.php");
    
    
    $id_tipo_servicio=$_POST['id_tipo_servicio'];
    $id_host=$_POST['host'];
    
    //echo $id_tipo_servicio;
   // echo $id_host;
    
    
    $con = new conexion;
    
    $consulta = $con->conexion->query ( "select id_tipo_servicio from detalle_servicio where id_host='$id_host' and id_tipo_servicio=$id_tipo_servicio");
    $num=$consulta->fetch_array();
    
    
    $respuestaValidacion = array();
    $respuestaValidacion["respuesta"] = true;

    
    
    if($num != 0){
        $respuestaValidacion["estado"] = 'existe';
    }else{
        $respuestaValidacion["estado"] = 'no_existe';
    }
    
    $respuesta = json_encode($respuestaValidacion);
    echo $respuesta;
    
    $con->cerrar();
    
}
?>
