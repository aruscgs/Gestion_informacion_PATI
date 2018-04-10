<script type='text/javascript'>
    function redireccionar1()
    {
        window.location = "../../index.php";
    }
    setTimeout("redireccionar()", 20); 
</script>
 
<script type='text/javascript'>
    function redireccionar2()
    {
        window.location = "../../index.php?page=028";
    }
    setTimeout("redireccionar()", 20);
</script> 




<?php
session_start();
if ($_SESSION ['authenticated'] == 1) {
    include("../../modelo/conexion.php");
    
    $id = $_POST['id_evento'];// ya 1
    $ticket = $_POST['ticket'];// ya //numero de tiquet
    $tipo_incidente=$_POST['tipo_evento'];/// masivo o individual 
   
    $tipo=$_POST['tipo_incidente'];// requeri
    $num_rfc=$_POST['rfc_number'];
    $fecha_cierre=$_POST['fecha_final'];
    $detalles = $_POST['detalle'];
   
  
    //$tipo=$_POST['tipo'];
    //$tipo_evento = $_POST['evento'];//recibe en valor del radio button
    
  
    //$usuario=$_POST['usuario'];
    
    $id_usuario=$_POST['cedula_usuario'];
    
    //$usuario=$_POST['btnus'];
    
    //$algo=explode("-", $ids);
    
    
    //$id=$algo[0];
    //$tipo_eve=$algo[1];
 
 
    $wish = new conexion();
   
    //$query = "select ticket from solucion_incidente where ticket='$ticket'";
    //$consulta = $wish->conexion->query($query);
    //$num = $consulta->fetch_array();

  
    
        if($tipo_incidente=='Individual'){
        $tipo_incidente='individual';
        $wish->cambiarEstadoIncidente($id);
    }else{
        $tipo_incidente='masivo';
        $wish->cambiarEstadoIncidenteMasivo($id);
    }
    
    $wish->insertarNuevoTiquet($ticket,$id,$tipo,$tipo_incidente,$num_rfc,$fecha_cierre,
        $id_usuario,$detalles);
    $wish->cerrar();
    
    
    
    
    
    echo "<script> redireccionar1(); </script>";
}
    
/*
    if ($num == 0) {

        if ($tipo == "individual") {
        	
           
            $con->insertarNuevoTiquet($ticket, $id, $tipo, $tipo_evento,$num_rfc, $fecha_cierre,$id_usuario,$detalles);
            $con->cambiarEstadoIncidente($id);
            $con->cerrar();
        }
        else {

            $con->cambiarEstadoIncidenteMasivo($id);
            $con->insertarNuevoTiquet($ticket, $id, $tipo, $tipo_evento,$num_rfc, $fecha_cierre,$id_usuario,$detalles);
            $con->cerrar();
        }
 
    } else {
        echo "<script> alert('El nÃºmero del ticket ya se encuentra') </script>";
        echo "<script> redireccionar2(); </script>";
    }
   */ 


?>