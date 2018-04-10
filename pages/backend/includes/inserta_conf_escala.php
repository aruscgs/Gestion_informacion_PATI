<?php

include ('../../../modelo/conexion.php');
$con= new conexion();


$id_host = $_POST['id_host'];
$id_servicio = $_POST['id_servicio'];
$dispo = $_POST['dispo'];
$delay = $_POST['delay'];
$val_war = $_POST['val_war'];
$val_cri = $_POST['val_cri'];
$tipo_umbral = $_POST['tipo_umbral'];
$check = $_POST['check'];
$horario = $_POST['horario'];
$puerto = $_POST['puerto'];
$accion_critica=$_POST['accion_critica'];
$responsable=$_POST['cedulas'];
$escala=$_POST["escala"];

$aux=$_POST["aux"];

$nombre_ci=$_POST["nombre_ci"];
$ip_ci=$_POST["ip_ci"];
$nombre_contrato=$_POST["nombre_contrato"];
$codigo_contrato=$_POST["codigo_contrato"];
$nom_usuario=$_POST["nom_usuario"];

$algo=explode("-", $tipo_umbral);
$tipo=$algo[0];
$tipo_nom=$algo[1];



$ced_respo = explode (',',$responsable);
$nivel_respo = explode (',',$escala);



$cant=substr_count($responsable, ',');



for($i=0;$i<=$cant;$i++){
    
    $responsables_cedulas[]=$ced_respo[$i];
    $nivel_escala[]=$nivel_respo[$i];
            
}





$con->servicio_ci($id_host, $id_servicio, $dispo, $delay, $val_war, $val_cri, $tipo, $check, $horario, $puerto, $accion_critica);

$query2=$con->conexion->query("select id_detalle from detalle_servicio order by 1 desc");
$row=$query2->fetch_row();
$id_detalle=$row[0];

for($i=0;$i<=$cant;$i++){
    
    $con->insertEscalamiento($id_detalle, $responsables_cedulas[$i],$nivel_escala[$i]);
    
    
}



$con->cerrar();
?>