
<?php
session_start();
if ($_SESSION['authenticated'] == 1) {
    include ("../../modelo/conexion.php");

    ob_start();



    ob_end_flush();

    $wish = new conexion();

    $contrato = $_POST['contrato'];
    $i=0;
    $tipos = array();
    $aux2=0;
    $num_compo;
    $conexion = new conexion();


}?>

<script src="plugins/jquery.table2excel.js"></script>
  <form action="plantilla/plantilla_caracterizacion.php" method="post">
    <input type="hidden" name="contrato" value="<?php echo $contrato?>">
    <input type="submit" class="btn btn-info" value="Descargar Caracterizacion " id="export_carac">
  </form>
