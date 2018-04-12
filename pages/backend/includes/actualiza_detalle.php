<?php

include ('../../../modelo/conexion.php');
$con= new conexion();

$nombre_host=$_POST['nombre_host'];
$id_detalle=$_POST['id_detalles'];
$nom_servicio=$_POST['Uservicio'];
$num_delay=$_POST['Udelay'];
$chequeo=$_POST['Ucheck'];
$valor_warning=$_POST['Uwar'];
$valor_critical=$_POST['Ucri'];
$horario_op=$_POST['Uhorario'];
$umbral=$_POST['Utipo_umbral'];
$ip=$_POST['ip'];
$cedula=$_POST['cedula'];
$nombre_contra=$_POST['contrato'];
$cod_contra=$_POST['codigo_contrato'];

$nombre_usuario_actualiza=$con->conexion->query("select nombre,correo from new_personas where cedula='$cedula'");
$nombre_act=$nombre_usuario_actualiza->fetch_assoc();
$nombre_usuario_actualiza=$nombre_act["nombre"];
$correo_actualiza=$nombre_act["correo"];

$nuevo=array($num_delay,$chequeo,$valor_warning,$valor_critical,$horario_op);
$servicio=array("delay","tiempo de chequeo","valor warning","valor critical","puerto",
    "accion critica","disponibilidad","tipo umbral","horario");
$cambio=array();
$registro_ant=$con->conexion->query("select a.nombre, b.* from hosts a, detalle_servicio b where a.id=b.id_host and b.id_detalle=$id_detalle");
$reg_ant=$registro_ant->fetch_array();
$anti=array($reg_ant['delay'],$reg_ant['tiempo_chequeo'],$reg_ant['val_war'],$reg_ant['val_cri'],
$reg_ant['id_tipo_umbral'],$reg_ant['horario']);
for($i=0;$i<count($nuevo);$i++){
    if($nuevo [$i] != $anti[$i]){
        $cambio[$i]=$servicio[$i].": ".$nuevo[$i];
    }else{
        $cambio[$i]=$servicio[$i].": Sin cambios";
    }
}
$headers = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=UTF-8\r\n";
$headers .= "From: Monitoreo NOC <compuredescgcnoc@arus.com.co>" . "\r\n";
$this_mail = mail("juan.maya@arus.com.co,", "Cambio en subcomponente de CI del contrato [$nombre_contra]", " Subcomponentes  modificados:<br><br> <strong>$nom_servicio</strong> del CI: <strong>$nombre_host</strong><br><br>Detalles del cambio:<br><br>$cambio[0]<br>$cambio[1]<br>$cambio[2]<br>$cambio[3]
        		<br>$cambio[4]<br><br>Persona que generó el cambio: $nombre_usuario_actualiza", $headers);
$con->update_detalle_ci($id_detalle, $num_delay, $chequeo, $valor_warning, $valor_critical, $umbral, $horario_op);
$con->cerrar();
?>
