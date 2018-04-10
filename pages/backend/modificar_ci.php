
<?php
session_start ();
if ($_SESSION ['authenticated'] == 1) {

include("../../modelo/conexion.php");
$wish=new conexion();


$id_contrato=$_POST['contrato'];
$id_ci=$_POST['ci'];
$ip=$_POST['ip'];
$servicio_negocio=$_POST['servicio_nego'];
$ambiente=$_POST['ambiente'];
$horario_noti=$_POST['horario_op'];
$tipo_ci=$_POST['tipo_ci'];
$servicio_admin=$_POST['servicio_admin'];
$plataforma=$_POST['plataforma'];
$nombre_ci=$_POST['nombre_ci'];
$cedula=$_POST["cedula"];


$nom_tipo=$wish->conexion->query("select tipo from tipo_dispositivo where id='$tipo_ci'");
$nombre_dispositivo=$nom_tipo->fetch_array();
$dispositivo=$nombre_dispositivo[0];

$nuevo_campos=array("IP","Nombre del CI","Horario de operación","Ambiente","Tipo de dispositivo","Servicio negocio",
    "Servicio administrado","Plataforma");
$nuevo=array($ip,$nombre_ci,$horario_noti,$ambiente,$dispositivo,$servicio_negocio,$servicio_admin,$plataforma);

$cambios=array();

$datos_host_antiguos=$wish->conexion->query("select a.ip,a.nombre,a.horario_operativo,a.ambiente,b.tipo,a.servicio_negocio,
a.servicio_administrado,a.plataforma from hosts a,tipo_dispositivo b where a.id='$id_ci' and a.id_contrato='$id_contrato' 
and a.tipo=b.id");

$datos_host=$datos_host_antiguos->fetch_array();

for($i=0;$i<count($nuevo);$i++){
    
   // echo "<script>alert('$datos_host[$i]')</script>";
    
   if($datos_host[$i] != $nuevo[$i]){
     
        $cambios[$i]="<b>".$nuevo_campos[$i].":</b> ".$nuevo[$i];
        
    }else{ 
        
        $cambios[$i]="<b>".$nuevo_campos[$i].":</b> "."Sin cambios";
        
    }
   
}

echo "<script>alert('$tipo_ci')</script>";


for($i=0;$i<count($cambios);$i++){
    
   echo "<script>alert('$cambios[$i]')</script>";
    
}

$nombre_contrato=$wish->conexion->query("select nombre from new_proyectos where codigo='$id_contrato'");
$nom_con=$nombre_contrato->fetch_assoc();
$nombre_contra=$nom_con["nombre"];

$nombre_usuario=$wish->conexion->query("select nombre from new_personas where cedula='$cedula'");
$nom_user=$nombre_usuario->fetch_assoc();
$nombre_us=$nom_user["nombre"];

$datos_ci=$wish->conexion->query("select ip,nombre from hosts where id='$id_ci'");
$nom_ci=$datos_ci->fetch_assoc();
$nombre_host=$nom_ci["nombre"];

$ip_ci=$nom_ci["ip"];



$wish->modificar_ci($id_ci,$ip,$nombre_ci,$horario_noti,$ambiente, $tipo_ci, $servicio_negocio, $servicio_admin,$plataforma);




$headers = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";

$headers .= "From: Monitoreo NOC <compuredescgcnoc@arus.com.co>" . "\r\n";
$this_mail = mail("jhon.montoya@arus.com.co,linux_noc@arus.com.co", "Se ha modificado un CI del contrato [$nombre_contra]", "<b>Nombre del CI:</b> $nombre_host  <b>IP:</b> $ip_ci <br><br>Detalles del cambio:<br><br>$cambios[0]<br>$cambios[1]<br>$cambios[2]<br>$cambios[3]
        		<br>$cambios[4]<br>$cambios[5]<br>$cambios[6]<br>$cambios[7]<br><br><b>Persona que generó el cambio:</b> $nombre_us", $headers);


$wish->cerrar(); 
}

?>