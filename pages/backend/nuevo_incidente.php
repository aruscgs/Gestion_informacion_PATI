<script type='text/javascript'>
    function redireccionar1()
    {
        window.location = "../../index.php";
    }
    setTimeout("redireccionar()", 20);
</script>
<?php
session_start ();
if ($_SESSION ['authenticated'] == 1) {

include("../../modelo/conexion.php");

$servicio=$_POST['servicio'];// id de subcomponente
$nomservicio=$_POST['nomservicio']; //Nombre subcomponente
$tipo_evento=$_POST['evento']; // warning o critical
$id_evento=$_POST['id_evento']; //id evento
$causa_evento=$_POST['causa_evento']; //disponibilidad o capasidad
$tipo_actividad=$_POST['tipo_actividad']; //programada , no programada
$reporta=$_POST['reporta']; //cedula del usuario que reporta
$fecha=$_POST['fecha_inicio'];
$hrs_actividad=$_POST['hrs_actividad'];
$mesa=$_POST['mesa'];
$responsable=$_POST['idresponsable'];
$nombre_reporta=$_POST['nombre_reporta'];
$nombre_responsable=$_POST['corresponsable'];
$estado='P';
$correo=$_POST['correo'];
$nombre_host=$_POST['nombre_host'];
$ip=$_POST['ip'];
$id_host=$_POST['id_host'];
$observaciones=$_POST['observaciones'];
$contrato=$_POST['contrato'];
$correo_diponible=$_POST["correo_reponsable_diponible"];
//el estado lo mando directo


$miarreglo = explode ('-',$correo_diponible);

$cedula_disponible=$miarreglo[0];  //este valor sera la cedula del responsable
$correo_disponible=$miarreglo[1];  //este valor sera el correo del reponssable


$wish=new conexion();

if($correo_diponible == "temporal"){

    $wish->registrarIncidente($servicio, $tipo_evento, $causa_evento, $tipo_actividad, $reporta, $fecha, $hrs_actividad,
         $mesa,$responsable,$estado,$id_host,$observaciones);

         $headers = "MIME-Version: 1.0\r\n";
         $headers .= "Content-type: text/html; charset=UTF-8\r\n";

         $headers .= "From: Monitoreo NOC <compuredescgcnoc@arus.com.co>" . "\r\n";
         $this_mail = mail("$correo,$correo_disponible,$mesa,compuredescgcnoc@arus.com.co","Alertamiento Crítico [$contrato] - Evento:$id_evento","Buen día,se reporta lo siguiente:<br><br>Contrato: $contrato <br>Evento: $id_evento<br> Host: $nombre_host<br> IP: $ip<br> Servicio afectado: $nomservicio <br> Tipo Evento: $tipo_evento<br>
         					Causa Evento: $causa_evento<br> Minutos de Actividad: $hrs_actividad<br> Tipo Actividad: $tipo_actividad<br> Persona que Reporta: $nombre_reporta<br>Nombre del reponsable: $nombre_responsable.<br> Fecha y Hora: $fecha<br>Observaciones: $observaciones", $headers);
         echo "<script> alert('Mensaje enviado') </script>";
         echo "<script> redireccionar1(); </script>";

}else{

  $wish->registrarIncidente($servicio, $tipo_evento, $causa_evento, $tipo_actividad, $reporta, $fecha, $hrs_actividad,
      $mesa,$cedula_disponible,$estado,$id_host,$observaciones);

      $conn = $wish->conexion->query("SELECT nombre, cedula FROM new_personas WHERE correo='$correo_disponible'");
      $info = $conn->fetch_assoc();
      $nombre_disponible = $info["nombre"];


      $headers = "MIME-Version: 1.0\r\n";
      $headers .= "Content-type: text/html; charset=UTF-8\r\n";

      $headers .= "From: Monitoreo NOC <compuredescgcnoc@arus.com.co>" . "\r\n";
      $this_mail = mail("$correo,$correo_disponible,$mesa,compuredescgcnoc@arus.com.co","Alertamiento Crítico [$contrato] - Evento:$id_evento","Buen día,se reporta lo siguiente:<br><br>Contrato: $contrato <br>Evento: $id_evento<br> Host: $nombre_host<br> IP: $ip<br> Servicio afectado: $nomservicio <br> Tipo Evento: $tipo_evento<br>
      					Causa Evento: $causa_evento<br> Minutos de Actividad: $hrs_actividad<br> Tipo Actividad: $tipo_actividad<br> Persona que Reporta: $nombre_reporta<br>Nombre del reponsable: $nombre_responsable. $nombre_disponible<br> Fecha y Hora: $fecha<br>Observaciones: $observaciones", $headers);
      echo "<script> alert('Mensaje enviado') </script>";
      echo "<script> redireccionar1(); </script>";

}



$wish->cerrar();

}

?>
