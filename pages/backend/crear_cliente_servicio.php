<?php
session_start ();
if ($_SESSION ['authenticated'] == 1) {
    include("../../modelo/conexion.php");
    
    $con=new conexion();
    
    $nombre_ser=$_POST["nombre_ser"];
    $nombre  =$_POST['nombre'];
    $zona=$_POST['zona'];
    $zona_nueva=$_POST['zona_nueva'];
    $opcion=$_POST["opcion"];
    
  
    
    
    
    
    if($opcion=="cliente"){
        
        if($zona_nueva!=""){
            
           $con->crea_cliente_indicador($nombre, $zona_nueva);
           $con->cerrar();
        }else{
            
            $con->crea_cliente_indicador($nombre,$zona);
            $con->cerrar();
        }
        
        
    }else{
        
        
       $con->crear_servicio_indicador($nombre_ser);
       
        
    }
    
   
    
    
}


?>