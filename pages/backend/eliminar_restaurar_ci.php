<?php
session_start ();
if ($_SESSION ['authenticated'] == 1) {
include("../../modelo/conexion.php");

$con=new conexion();

$id_contrato  =$_POST['contrato'];
$id_ci  =$_POST['ci'];
$valor=$_POST['valor'];
$cedula=$_POST["cedula"];



$subcomponentes=$con->conexion->query("select a.tipo ,b.val_war ,b.val_cri,
c.nombre from tipo_servicios a,detalle_servicio b,tipo_umbral c where 
b.id_tipo_servicio=a.id and b.id_tipo_umbral=c.id_tipo_umbral and b.id_host='$id_ci'");



$compo="";
    

while($sub_compo=$subcomponentes->fetch_assoc()){
    if($sub_compo["val_war"]==""){
        $sub_compo["val_war"]="N/A";
    }
    if($sub_compo["val_cri"]==""){
        $sub_compo["val_cri"]="N/A";
    }
    
    $compo=$compo."* ".$sub_compo['tipo']." : <font color='red'> W:</font> "
        .$sub_compo["val_war"].", <font color='red'>C: </font>"
        .$sub_compo["val_cri"].", <font color='red'>U: </font>".$sub_compo["nombre"]."<br>";
    
}




if($compo==""){
    
    $compo="El CI recuperado , no tiene subcomponentes asociados.";

}


$nombre_usuario=$con->conexion->query("select nombre from new_personas where cedula='$cedula'");

$nombre_repor=$nombre_usuario->fetch_assoc();

$nombre_reporta=$nombre_repor["nombre"];


$nombre_ci=$con->conexion->query("select ip,nombre from hosts where id='$id_ci'");
$nombre_contrato=$con->conexion->query("select nombre from new_proyectos where codigo='$id_contrato'");

$nombre_contra=$nombre_contrato->fetch_assoc();
$nombre=$nombre_ci->fetch_assoc();

$nom_con=$nombre_contra["nombre"];

$nom=$nombre["nombre"];

$ip=$nombre["ip"];

setlocale (LC_TIME, 'es_ES.utf8','esp');
date_default_timezone_set ('America/Bogota');
$fecha=strftime("%Y-%m-%d %H:%M:%S");

if($valor=="eliminar_ci"){

$con->cambia_estado_ci_desactivar($id_contrato, $id_ci);

$headers = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=UTF-8\r\n";

$headers .= "From: Monitoreo NOC <compuredescgcnoc@arus.com.co>" . "\r\n";
$this_mail = mail("jhon.montoya@arus.com.co,linux_noc@arus.com.co","CI Eliminado [$nom_con] ", 
"Se ha eliminado el siguiente CI:<br><br>Nombre del CI: $nom<br> 
IP: $ip<br>Contrato: $nom_con <br> Fecha y hora:  $fecha<br>
Persona que elimina: $nombre_reporta<br>", $headers);

echo "<script> 

  		alertify.alert('<b>CI eliminado correctamente.', function(){ alertify.success('Ok') });

 </script>";


}else{
    
$con->cambia_estado_ci_activar($id_contrato, $id_ci);


$headers = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=UTF-8\r\n";

$headers .= "From: Monitoreo NOC <compuredescgcnoc@arus.com.co>" . "\r\n";
$this_mail = mail("jhon.montoya@arus.com.co,linux_noc@arus.com.co","CI Recuperado [$nom_con] ",
    "Se ha recuperado el siguiente CI:<br><br>Nombre del CI: $nom<br>
IP: $ip<br>Contrato: $nom_con <br> Fecha y hora:  $fecha<br>
Persona que recupera: $nombre_reporta<br>Subcomponentes del CI:<br>$compo", $headers);

echo "<script>
    
  		alertify.alert('<b>CI recuperado correctamente.', function(){ alertify.success('Ok') });
    
 </script>";



}
}
?>
