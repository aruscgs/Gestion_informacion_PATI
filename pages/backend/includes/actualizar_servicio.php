<?php
session_start ();
if ($_SESSION ['authenticated'] == 1) {

        include("../../../modelo/conexion.php");
        $con = new conexion;
        $id=$_POST['id_detalles'];
        $nom_servicio=$_POST['Uservicio'];
        $dispo=$_POST['Udispo'];
        $delay=$_POST['Udelay'];
        $check=$_POST['Ucheck'];
        $war=$_POST['Uwar'];
        $cri=$_POST['Ucri'];
        $tip=$_POST['Utipo_umbral'];
        $respon=$_POST['Urespo'];
        $horario=$_POST['Uhorario'];
        $puerto=$_POST['Upuerto'];
        $accion_critico=$_POST['Uaccion'];

$contrato=$_POST['contrato'];
$cedula=$_POST['cedula'];

$nombre_actualiza=$con->conexion->query("select nombre,correo from new_personas where cedula='$cedula'");
$nombre_act=$nombre_actualiza->fetch_assoc();
$nombre_actua=$nombre_act["nombre"];
$correo_actualiza=$nombre_act["correo"];

        $algo=explode("-", $tip);
        $tipo=$algo[0];
        $tipo_nom=$algo[1];

        $nuevo=array($delay,$check,$war,$cri,$puerto,$accion_critico,$dispo,$tipo_nom,$horario);
        //$nuevo=array(12,3,'10%','60%','90','si que si hay','1',3,'habil');
        //$anti=array(12,1,'10%','60%','90','si que si hay','1',3,'habil');

        $servicio=array("delay","tiempo de chequeo","valor warning","valor critical","puerto",
                        "accion critica","disponibilidad","tipo umbral","horario"
        );


        $cambio=array();

        $registro_ant=$con->conexion->query("select a.nombre, b.* from hosts a, detalle_servicio b where a.id=b.id_host and b.id_detalle=$id");

        $reg_ant=$registro_ant->fetch_array();

        $anti=array($reg_ant['delay'],$reg_ant['tiempo_chequeo'],$reg_ant['val_war'],$reg_ant['val_cri'],
        		$reg_ant['puerto'],$reg_ant['accion_critico'],$reg_ant['disponibilidad'],
        		$reg_ant['id_tipo_umbral'],$reg_ant['horario']);
        
        $ci=$reg_ant['nombre'];
        for($i=0;$i<count($nuevo);$i++){
        	
        	if($nuevo [$i] != $anti[$i]){
        		
        		$cambio[$i]=$servicio[$i].": ".$nuevo[$i];
        		
        		
        	}else{
        		
        		$cambio[$i]=$servicio[$i].": Sin cambios";
        	}
        }
        
        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
        
        $headers .= "From: Monitoreo NOC <compuredescgcnoc@arus.com.co>" . "\r\n";
        $this_mail = mail("$correo_actualiza,linux_noc@arus.com.co", "Cambio en subcomponente de CI del contrato [$contrato]", " Subcomponentes  modificados:<br><br> <strong>$nom_servicio</strong> del CI: <strong>$ci</strong><br><br>Detalles del cambio:<br><br>$cambio[0]<br>$cambio[1]<br>$cambio[2]<br>$cambio[3]
        		<br>$cambio[4]<br>$cambio[5]<br>$cambio[6]<br>$cambio[7]<br>$cambio[8]<br><br>Persona que generó el cambio: $nombre_actua", $headers);
        
        
        for($i=0;$i<count($cambio);$i++){
        	
        	echo $cambio[$i] ."<br>";
        }
        
        $con->update_servicio_ci($id, $dispo, $delay, $check, $war, $cri, $tipo, $horario, $puerto, $accion_critico);
        
        $con->deleteEscalamiento($id);
        
        foreach ($respon as $responsable)
        {
        	$con->insertEscalamiento($id, $responsable);
        }
        
        
        $nuevo_responsable=$con->conexion->query("select a.nombre , a.correo from new_personas a, escalamiento b where b.id_persona=a.cedula and b.id_detalle=$id");
        $con->cerrar();
}


?>
