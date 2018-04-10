<?php

include ('../../../modelo/conexion.php');
$oe= new conexion();
$id_cliente = $_POST['id_cliente'];
$id_servicio=$_POST["id_servicio"];
$ans=$_POST["ans"];
$aux2=$_POST["aux2"];



$ans_mod = str_replace(".", ",", $ans);
$ans_mod_por=$ans_mod."%";



$oe->asigna_servicio_cliente($id_cliente, $id_servicio, $ans_mod_por);
$oe->cerrar();
if($aux2==0){
echo "<script>alertify.alert('<b>Se han asignado correctamente los servicios</b>', function(){ alertify.success('Ok')});
     setTimeout('document.location.reload()',5000);
</script>";
}

?>
