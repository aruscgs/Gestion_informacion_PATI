

<?php
session_start ();
if ($_SESSION ['authenticated'] == 1) {

include("../../modelo/conexion.php");


		$id_evento=$_POST['event'];
		$host=$_POST['cis'];
		$f_inicio=$_POST['f_inicio'];
		$tipo_evento=$_POST['t_evento'];
		$causa_evento=$_POST['c_evento'];
		$tipo_actividad=$_POST['t_actividad'];
		$horas_actividad=$_POST['h_actividad'];
		$mesa=$_POST['mesa'];
		$descripcion=$_POST['desc'];
		$responsable=$_POST['respo'];
		$contrato=$_POST['contrato'];
		
                $algo=explode("-", $responsable);
		
		$correo=$algo[0];
		$respo=$algo[1];
                $nombre_responsable=$algo[2];
		//echo $respo."<br>".$correo;
	        // echo $responsable;
             
                //echo $nombre_responsable;    	
		$con = new conexion;
		
		foreach ($host as $id_host)
		{

                  echo $id_host;		 
		$con->registro_masivo($id_evento, $id_host, $f_inicio, $tipo_evento, $causa_evento, $tipo_actividad, $horas_actividad, 			$descripcion, $mesa, $respo);
			
		$consulta = $con->conexion->query ( "select nombre, ip from hosts where id=$id_host");
			$row=$consulta->fetch_array();
			$oe=$row[0]." IP:  ".$row[1].",\n ".$oe;
		}
		$con->cerrar();
		
		
		$headers .= "From: Monitoreo NOC  <compuredescgcnoc@arus.com.co > " . "\r\n";
		$this_mail = mail("$correo, $mesa,compuredescgcnoc@arus.com.co","Se ha generado un Incidente Masivo",                                    "               Contrato: $contrato
               ID del evento: $id_evento
               Fecha de inicio: $f_inicio
               Tipo de evento: $tipo_evento
               Causa del evento: $causa_evento
               Tipo de actividad: $tipo_actividad
               Horas de actividad: $horas_actividad
               Mesa de ayuda: $mesa
               Descripción: $descripcion
               Responsable: $nombre_responsable
	       CI's afectados: \n $oe
		",

               
                 $headers);
		
		
		header("Location: ../../index.php");
	
	        
  
}
?>
