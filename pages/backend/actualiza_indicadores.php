<?php
session_start ();
if ($_SESSION ['authenticated'] == 1) {
    include("../../modelo/conexion.php");
    
    
    
    $wish = new conexion;
    
    
    $id  =$_POST["id"];
    $ind_cr=$_POST["ind_cr"];
    $ind_cl=$_POST["ind_cl"];
    $ind_gral=$_POST["ind_gral"];
    $cumplimiento=$_POST["cumplimiento"];
    $justificacion=$_POST["justificacion"];
    $plan_accion=$_POST["plan_acc"];
    
      
    echo $id;
    echo $ind_cr;
    echo $ind_cl;
    echo $ind_gral;
    echo $cumplimiento;
    echo $justificacion;
    echo $plan_accion;
    
    
   $wish->actualiza_indicadores($id,$ind_cr,$ind_cl,$ind_gral,$cumplimiento,$justificacion,$plan_accion);
    $wish->cerrar();
    
}


?>