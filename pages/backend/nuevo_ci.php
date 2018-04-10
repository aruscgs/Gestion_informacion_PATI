<link rel="stylesheet" href="plugins/alertify.default.css">
<link rel="stylesheet" href="plugins/alertify.core.css">
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>


<?php
session_start ();
if ($_SESSION ['authenticated'] == 1) {

include("../../modelo/conexion.php");

$wish=new conexion();

$ip=$_POST['ip'];
$nombre_ci=$_POST['host'];
$id_contrato=$_POST['contrato'];
$horario_operativo=$_POST['horario_operacion'];
$ambiente=$_POST['ambiente'];
$tipo_dispositivo=$_POST['tipo_dispositivo'];
$servicio_nego=$_POST['sn'];
$servicio_admin=$_POST['sa'];
$plataforma=$_POST['plataforma'];
$cedula=$_POST["cedula_usuario"];



$nombre_user=$wish->conexion->query("select nombre from new_personas where cedula='$cedula'");
$ced=$nombre_user->fetch_assoc();

$user_name=$ced["nombre"];


$varifica=$wish->conexion->query("select * from hosts where ip='$ip' and id_contrato='$id_contrato' and estado='A'");

$res=$varifica->fetch_assoc();




$nombre_contrato=$wish->conexion->query("select nombre from new_proyectos where codigo='$id_contrato'");

$nom_contrato=$nombre_contrato->fetch_assoc();

$nom_con=$nom_contrato["nombre"];

if ($res["id"] != ""){
    
  echo "<script>
alertify.alert('<b>Ya existe un dispositivo con la misma IP</b>', function(){ alertify.success('Ok') });
         </script>";
    
}else{
    
    $wish->crearCI($ip, $nombre_ci, $id_contrato, $horario_operativo, $ambiente, $tipo_dispositivo,$servicio_nego,$servicio_admin,$plataforma);
    
    //$wish->cerrar(); 
    
    
    echo "<script>
alertify.alert('<b>Host agregado correctamente</b>', function(){ alertify.success('Ok') });
         </script>";
    //header("Location: ../../index.php");
    
    
    
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=UTF-8\r\n";
    
    $headers .= "From: Monitoreo NOC <compuredescgcnoc@arus.com.co>" . "\r\n";
    $this_mail = mail("","CI Creado [$nom_con]: ",
        "Buen día,se reporta lo siguiente:<br><br>Se ha creado el siguiente CI:<br><br><b>Nombre del CI:</b> $nombre_ci<br>
<b>IP:</b> $ip<br><b>Contrato:</b> $nom_con <br>
<b>Persona que crea:</b> $user_name<br>", $headers);
    
    
    
}





  
}

?>
