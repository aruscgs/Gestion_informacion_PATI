<?php
session_start ();
if ($_SESSION ['authenticated'] == 1) {
    include("../../modelo/conexion.php");
    
    
    $wish = new conexion;
    
    
    $cedula_user=$_POST["cedula_user"];
    $crear=$_POST["crear"];
    $consultar=$_POST["consultar"];
    $editar=$_POST["editar"];
    $administrar=$_POST["administrar"];
    $fecha_inicio_crear=$_POST["fecha_inicio_crear"];
    $fecha_fin_crear=$_POST["fecha_fin_crear"];
    $fecha_inicio_modificar=$_POST["fecha_inicio_modificar"];
    $fecha_fin_modificar=$_POST["fecha_fin_modificar"];
    $ano=$_POST["ano"];
    $mes=$_POST["mes"];
    
    if($crear==0){
        $fecha_inicio_crear='2018-01-01';
        $fecha_fin_crear='2018-01-02';
        
    }
    
    if($editar==0){
        $fecha_inicio_modificar='2018-01-01';
        $fecha_fin_modificar='2018-01-02';
        $ano=0;
        $mes=0;
    
    }
    
    
    
    $usuario_indicador=$wish->conexion->query("select count(id) as cantidad from permiso_indicador where cedula='$cedula_user'");
    
    $num=$usuario_indicador->fetch_assoc();
    $num_id=$num["cantidad"];
    
    if($num_id != 0){
        
        $wish->actualizar_permiso_indicador($cedula_user, $crear, $consultar, $editar, $administrar, 
            $fecha_inicio_crear, $fecha_fin_crear, $fecha_inicio_modificar, $fecha_fin_modificar, $ano, $mes);
        
    }else{
        
        $wish->dar_permiso_indicador($cedula_user, $crear, $consultar, $editar, $administrar, $fecha_inicio_crear, 
            $fecha_fin_crear, $fecha_inicio_modificar, $fecha_fin_modificar, $ano, $mes);
        
    }
    
        $wish->cerrar();
    
}


?>