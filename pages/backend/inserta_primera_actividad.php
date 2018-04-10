<?php
session_start ();
if ($_SESSION ['authenticated'] == 1) {
    include("../../modelo/conexion.php");
    
    $wish = new conexion;  
    
    setlocale (LC_TIME, 'es_ES.utf8','esp');
    date_default_timezone_set ('America/Bogota');
    $fecha=strftime("%Y-%m-%d %H:%M:%S");
    
    $fecha_fin = strtotime ( '+50 minutes' , strtotime ( $fecha ) ) ;
    $fecha_final = date ( 'Y-m-d H:i:s' , $fecha_fin );
    
    $fecha_med=($hoy = date("Y-m-d 12:00:00"));
    $fecha_fin_1 = strtotime ( '+50 minutes' , strtotime ( $fecha_med ) ) ;
    $fecha_final_1 = date ( 'Y-m-d H:i:s' , $fecha_fin_1 );
    

    $cedula=$_POST["cedula"];

    //consulta previa para saber si el usuario ha registrado tiempo en dia actual
    $consulta=$wish->conexion->query("select sum(a.tiempoReal) as total,b.proyecto from registro_actividad a,
new_personas b where a.cedula ='$cedula' and a.cedula=b.cedula and DATE(fecha_inicio) = DATE(NOW()) and a.estado in ('F', 'R');");
    
    $proyecto=$wish->conexion->query("select proyecto from new_personas where cedula='$cedula'");
    $pro=$proyecto->fetch_assoc();
    $proyecto=$pro["proyecto"];
    
   $res=$consulta->fetch_row();
   
   //$proyecto=$res[1];
    
   

   $dia=date("l");
   
   
    
   if($res[0]==0 && $dia!='Saturday' && $dia!='Sunday' ){
       
       for($i==0;$i<2;$i++){
           
           if($i != 0){
               $wish->inserta_primera_actividad($fecha_med,$fecha_final_1,$cedula,$proyecto);
               
           }else{
    $wish->inserta_primera_actividad($fecha,$fecha_final,$cedula,$proyecto);
       
           }
           
          }
       
       
       }



    $wish->cerrar();
    
}


?>

