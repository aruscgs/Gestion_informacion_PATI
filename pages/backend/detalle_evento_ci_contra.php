<style>

.datagrid table { border-collapse: collapse; text-align: left; width: 100%; } 
.datagrid {font: normal 12px/150% Arial, Helvetica, sans-serif; background: #fff; overflow: hidden; 
 -webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px; }
.datagrid table td, .datagrid table th { padding: 3px 10px; }
.datagrid table thead th {background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #006699), 
color-stop(1, #008FD6) );    height: 31px;background:-moz-linear-gradient( center top, #006699 5%, #008FD6 100% );
text-align:center;filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#006699', endColorstr='#008FD6');
background-color:#006699; color:#FFFFFF; font-size: 15px; font-weight: bold; border-left: 1px solid #0070A8; } 
.datagrid table thead th:first-child { border: none; }
.datagrid table tbody td { color: #00496B; border-left: 1px solid #E1EEF4;text-align:center;font-size: 12px;font-weight: normal; }.datagrid table tbody .alt td { background: #E1EEF4; color: #00496B; }.datagrid table tbody td:first-child { border-left: none; }.datagrid table tbody tr:last-child td { border-bottom: none; }.datagrid table tfoot td div { border-top: 1px solid #006699;background: #E1EEF4;} .datagrid table tfoot td { padding: 0; font-size: 12px } .datagrid table tfoot td div{ padding: 2px; }.datagrid table tfoot td ul { margin: 0; padding:0; list-style: none; text-align: right; }.datagrid table tfoot  li { display: inline; }.datagrid table tfoot li a { text-decoration: none; display: inline-block;  padding: 2px 8px; margin: 1px;color: #FFFFFF;border: 1px solid #006699;-webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px; background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #006699), color-stop(1, #00557F) );background:-moz-linear-gradient( center top, #006699 5%, #00557F 100% );filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#006699', endColorstr='#00557F');background-color:#006699; }.datagrid table tfoot ul.active, .datagrid table tfoot ul a:hover { text-decoration: none;border-color: #006699; color: #FFFFFF; background: none; background-color:#00557F;}div.dhtmlx_window_active, div.dhx_modal_cover_dv { position: fixed !important; }
img {
    border: 243;
    width: 26px;
}


</style>

<?php
session_start ();
if ($_SESSION ['authenticated'] == 1) {
    include("../../modelo/conexion.php");
    
    $contrato  =$_POST['contrato'];
    $f_ini  =$_POST['f_ini'];
    $f_fin  =$_POST['f_fin'];
    
    $aux=0;
      $con=new conexion();
   
   $eventos=$con->conexion->query("select * from (select a.nombre,a.id_ci,a.ip,count(a.id_host) as 'num' 
from (select a.id,b.id as 'id_ci',a.estado,a.id_host,b.nombre,b.ip from incidentecop a, hosts b where 
b.id_contrato='$contrato' and a.fecha between '$f_ini' and '$f_fin' and a.id_host=b.id)a group by 
a.id_host order by  num desc)a limit 10");
    
}


?>



<div class="datagrid">
<table>
<thead>
<tr>
<th>Nombre de CI</th>
<th>IP</th>
<th>Cantidad de eventos</th>
</tr>
</thead>

<tbody>
<?php $i=1; while($res=$eventos->fetch_assoc()){?>

  <tr>
  
    <td id="nombre<?php echo $i?>" onclick="info('<?php echo $i?>','<?php echo $f_ini?>','<?php echo $f_fin?>','<?php echo $res["id_ci"]?>')"><a href="#"><?php echo $res["nombre"]?></a></td>    
    <td id="ip"<?php echo $i?>><?php echo $res["ip"]?></td>
    <td><?php echo $res["num"]?></td>
    
    
  </tr>
  
  <?php   $i=$i+1;}?>

</tbody>

</table>
</div>

<script>

function info(val,f_ini,f_fin,id_ci) {

	
	
	var parametros = {
	        "id_ci": id_ci, 
	        "f_ini": f_ini,   
	        "f_fin": f_fin
	    };
	    $.ajax({
	        data: parametros,
	        url: 'pages/backend/includes/detalle_evento_contrato.php',
	        type: 'post',
	    
	        success: function (response) {
	            $("#tabla_info").html(response);
	        }  
	    });

	
}




</script>

<div id="tabla_info"></div>