<?php

include ('../../../modelo/conexion.php');
$con= new conexion();

$cedulas=$_POST['cedulas'];
$nombre_host=$_POST['nombre_host'];
$id_detalle=$_POST['id_detalle'];
$nom_servicio=$_POST['nom_servicio'];

$num_delay=$_POST['num_delay'];

$chequeo=$_POST['chequeo'];
$valor_warning=$_POST['valor_warning'];
$valor_critical=$_POST['valor_critical'];
$puertos=$_POST['puertos'];
$accion_cri=$_POST['accion_cri'];
$disponibilidad=$_POST['disponibilidad'];
echo $disponibilidad;
echo $num_delay;
echo $chequeo;
echo $valor_warning;
echo $valor_critical;
$horario_op=$_POST['horario_op'];


$umbral=$_POST['umbral'];
$ip=$_POST['ip'];
$nombre_contra=$_POST['nombre_contra'];
$cod_contra=$_POST['cod_contra'];
$nombre_usuario_actualiza=$_POST['nombre_usuario_actualiza'];
$correo_usuario_actualiza=$_POST['correo_usuario_actualiza'];

$escala=$_POST["escala"];

$algo=explode("-", $umbral);
$tipo=$algo[0];
$tipo_nom=$algo[1];

echo $tipo;
echo $horario_op;
echo $puertos;
echo $accion_cri;

$nuevo=array($num_delay,$chequeo,$valor_warning,$valor_critical,$puertos,$accion_cri,$disponibilidad,$tipo_nom,$horario_op);


$servicio=array("delay","tiempo de chequeo","valor warning","valor critical","puerto",
    "accion critica","disponibilidad","tipo umbral","horario");


$cambio=array();

$registro_ant=$con->conexion->query("select a.nombre, b.* from hosts a, detalle_servicio b where a.id=b.id_host and b.id_detalle=$id_detalle");

$reg_ant=$registro_ant->fetch_array();

$anti=array($reg_ant['delay'],$reg_ant['tiempo_chequeo'],$reg_ant['val_war'],$reg_ant['val_cri'],
    $reg_ant['puerto'],$reg_ant['accion_critico'],$reg_ant['disponibilidad'],
    $reg_ant['id_tipo_umbral'],$reg_ant['horario']);


//$ci=$reg_ant['nombre'];
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
$this_mail = mail("$correo_usuario_actualiza,linux_noc@arus.com.co", "Cambio en subcomponente de CI del contrato [$nombre_contra]", " Subcomponentes  modificados:<br><br> <strong>$nom_servicio</strong> del CI: <strong>$nombre_host</strong><br><br>Detalles del cambio:<br><br>$cambio[0]<br>$cambio[1]<br>$cambio[2]<br>$cambio[3]
        		<br>$cambio[4]<br>$cambio[5]<br>$cambio[6]<br>$cambio[7]<br>$cambio[8]<br><br>Persona que generó el cambio: $nombre_usuario_actualiza", $headers);






$con->update_servicio_ci($id_detalle, $disponibilidad, $num_delay, $chequeo, $valor_warning, $valor_critical, 
    $tipo, $horario_op, $puertos, $accion_cri);

$con->deleteEscalamiento($id_detalle);




//separando cedulas
$ced = explode (',',$cedulas);
$esc = explode (',',$escala);

$cant=substr_count($cedulas, ',');

for($i=0;$i<=$cant;$i++){
    
    $con->insertEscalamiento($id_detalle, $ced[$i],$esc[$i]);
    
    
}




$con->cerrar();

?>
