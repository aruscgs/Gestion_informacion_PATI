<?php
session_start ();
if ($_SESSION ['authenticated'] == 1) {
	
	include("../../../modelo/conexion.php");
	$con = new conexion;
	
	
	$servicio_indi=$_POST['servicio'];
	$cliente=$_POST['cliente'];
	$zona=$_POST['zona'];
	$mes=$_POST['mes'];
	$ans=$_POST['ans'];
	$ind_cr=$_POST['ind_cr'];
	$ind_cl=$_POST['ind_cl'];
	$ind_gral=$_POST['ind_gral'];
	$cumplimiento=$_POST['cumplimiento'];
	$justificacion=$_POST['justificacion'];
	$plan_acc=$_POST['plan_acc'];
	$id_mes=$_POST['id_mes'];
	
	if($id_mes<10){
		$id_mes='0'.$id_mes;
	
	}
	
     $fecha=date("Y")."-"."$id_mes"."-"."01";
     
     //reemplazamos en las variables numericas el "." por una "," para que asi quede 
     //en el formato correcto para la base de datos
     

    
  

	$con->insertar_indicadores($servicio_indi, $cliente, $zona, $fecha, $ans, $ind_cr, $ind_cl,
		$ind_gral, $cumplimiento, $justificacion,$plan_acc);
	
//	$con->deleteEscalamiento($id);
	
	
	echo $cumplimiento;
	echo $ind_gral;
	$con->cerrar();
}


?>