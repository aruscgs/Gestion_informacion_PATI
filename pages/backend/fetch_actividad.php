<?php
session_start ();
if ($_SESSION ['authenticated'] == 1) {
   if(isset($_POST['id']))
   {
        include("../../modelo/conexion.php");
        $wish = new conexion; 
        $id=$_POST['id'];
        $query = $wish->getActividadesByID($id);
        $row=$query->fetch_object();
        echo $row->actividad;
        $wish->cerrar(); 
        exit;      
   }
}

?>