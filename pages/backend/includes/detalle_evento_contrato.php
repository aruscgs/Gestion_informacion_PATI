<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
<script src="plugins/jquery.simplePagination.js"></script>





<style>
.paging-nav {
  text-align: right;
  padding-top: 2px;
}
 
 .datagrid {
    font: normal 12px/150% Arial, Helvetica, sans-serif;
    background: #fff;
    overflow: hidden;
    border: 0px;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    border-radius: 3px;
}
 
.paging-nav a {
  margin: auto 1px;
  text-decoration: none;
  display: inline-block;
  padding: 1px 7px;
  background: #91b9e6;
  color: white;
  border-radius: 3px;
}

td, th {
    padding: 5px;
    border: 10%;
     font-size: 11px;
    
}
 
.paging-nav .selected-page {
  background: #187ed5;
  font-weight: bold;
}

thead th {
    background: -webkit-gradient( linear, left top, left bottom, color-stop(0.05, #006699), color-stop(1, #008FD6) );
    height: 31px;
    background: -moz-linear-gradient( center top, #006699 5%, #008FD6 100% );
    text-align: center;
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#006699', endColorstr='#008FD6');
    background-color: #006699;
    color: #FFFFFF;
    font-size: 15px;
    font-weight: bold;
    border-left: 1px solid #0070A8;
}

tbody {
    display: table-row-group;
    vertical-align: middle;
    
}

button, html input[type=button], input[type=reset], input[type=submit] {
    -webkit-appearance: button;
    cursor: pointer;
    background: blu;
    background: -webkit-gradient( linear, left top, left bottom, color-stop(0.05, #006699), color-stop(1, #008FD6) );
    color: white;
}

</style>

<?php

include ('../../../modelo/conexion.php');
$oe= new conexion();

$id_ci = $_POST['id_ci'];
$f_ini = $_POST['f_ini'];
$f_fin = $_POST['f_fin'];



$info=$oe->conexion->query("select a.id,b.tipo,c.nombre as 'genero',d.nombre as 'responsable',a.observaciones
 from incidentecop a, tipo_servicios b,new_personas c, new_personas d
 where id_host='$id_ci' and fecha between '$f_ini' and '$f_fin' and
 a.servicio_afectado=b.id and a.generado=c.cedula and a.responsable=d.cedula ");
?>

<table class="datagrid" id="table-demo"> 

<thead>
 <tr> 
  <th>ID</th>
  <th>Servicio afectado</th>
  <th>Generó</th>
  <th>Responsable</th>
  <th>Detalles</th>
</tr>
</thead>

<tbody >
  <?php
  while($res=$info->fetch_assoc()){?>

  <tr>
  
    <td><?php echo $res["id"]?></td>    
    <td><?php echo $res["tipo"]?></td>
    <td><?php echo $res["genero"]?></td>
    <td><?php echo $res["responsable"]?></td>
    <td><?php echo $res["observaciones"]?></td>
    
  </tr>
  
  <?php }?>

</tbody>

</table>


<script>
</script>
<script>

$("#table-demo").simplePagination({

	perPage: 5,
	containerClass: '',
	previousButtonClass: '',
	nextButtonClass: '',
	previousButtonText: 'Anterior',
	nextButtonText: 'Siguiente',
	currentPage: 1

	});


</script>