<link rel="stylesheet" href="plugins/alertify.default.css">
<link rel="stylesheet" href="plugins/alertify.core.css">
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>


<?php
session_start ();
if ($_SESSION ['authenticated'] == 1) {

include("../../modelo/conexion.php");

$wish=new conexion();

$nombre=$_POST['nombre'];
$cedula=$_POST['cedula'];
$correo=$_POST['correo'];
$correo_personal=$_POST['correo_personal'];
$celular=$_POST['celular'];
$cargo=$_POST['cargo'];
$rol=$_POST['rol'];
$proyecto=$_POST['proyecto'];
$jefe=$_POST['jefe'];
$area=$_POST['area'];
$hoy =date("Y-m-d");



$nombre_user=$wish->conexion->query("select count(cedula) from new_personas where cedula='$cedula'");
$ced=$nombre_user->fetch_array();

$nombre_usuario=$wish->conexion->query("select count(cedula) from new_usuario where cedula='$cedula'");
$cedul=$nombre_usuario->fetch_array();

$user_name=$ced[0];
$nombre_de_usuario=$cedul[0];

//$varifica=$wish->conexion->query("select * from new_personas where cedula='$cedula'");

//$res=$varifica->fetch_assoc();

if ($user_name != 0 || $user_name == 1){

  if ($nombre_de_usuario != 0 || $nombre_de_usuario == 1) {

    echo "<script>
  alertify.alert('<b>Ya existe un usuario con la misma cedula</b>', function(){ alertify.success('Ok') });
           </script>";
      //header("Location: ../../index.php");

  }else{
    $id=$wish->conexion->query("select id from new_usuario order by id desc limit 1");
    $idplus=$id->fetch_array();
    $id=$idplus[0];
    $id=$id+1;
  $wish->crearUsuario($id, $cedula, $correo, $rol, $hoy, $area);

    echo "<script>
    alertify.alert('<b>Usuario Bitacora Creado Correctamente!</b>', function(){ alertify.success('Ok') });
         </script>";
    //header("Location: ../../index.php");

  }


}else{

    $wish->crearPersona($cedula, $nombre, $proyecto, $cargo, $jefe, $correo, $correo_personal, $celular);

    //$wish->cerrar();
if ($nombre_de_usuario != 0 || $nombre_de_usuario == 1) {

    echo "<script>
    alertify.alert('<b>Persona Registrada Correctamente</b>', function(){ alertify.success('Ok') });
         </script>";
    //header("Location: ../../index.php");

}else{
  $id=$wish->conexion->query("select id from new_usuario order by id desc limit 1");
  $idplus=$id->fetch_array();
  $id=$idplus[0];
  $id=$id+1;

$wish->crearUsuario($id, $cedula, $correo, $rol, $hoy, $area);


  echo "<script>
  alertify.alert('<b>Usuario Bitacora Creado Correctamente!</b>', function(){ alertify.success('Ok') });
       </script>";
  //header("Location: ../../index.php");

}
}
}

?>
