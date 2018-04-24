<link rel="stylesheet" href="plugins/alertify.default.css">
<link rel="stylesheet" href="plugins/alertify.core.css">
<script src="plugins/alertify.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
<script src="plugins/jquery.simplePagination.js"></script>

<style>

.datagrid table { border-collapse: collapse; text-align: left; width: 100%; } 
.datagrid {font: normal 12px/150% Arial, Helvetica, sans-serif; background: #fff; overflow: hidden; 
 -webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px; }
.datagrid table td, .datagrid table th { padding: 3px 10px; }
.datagrid table thead th {background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #006699), 
color-stop(1, #008FD6) );    height: 31px;background:-moz-linear-gradient( center top, #006699 5%, #008FD6 100% );
text-align:center;filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#006699', endColorstr='#008FD6');
background-color:#006699; color:#FFFFFF; font-size: 15px; font-weight: bold; border-left: 1px solid #0070A8;    width: 133px; } 
.datagrid table thead th:first-child { border: none; }
.datagrid table tbody td {border-left: 1px solid #E1EEF4;text-align:center;font-size: 12px;font-weight: normal; }.datagrid table tbody .alt td { background: #E1EEF4; color: #00496B; }.datagrid table tbody td:first-child { border-left: none; }.datagrid table tbody tr:last-child td { border-bottom: none; }.datagrid table tfoot td div { border-top: 1px solid #006699;background: #E1EEF4;} .datagrid table tfoot td { padding: 0; font-size: 12px } .datagrid table tfoot td div{ padding: 2px; }.datagrid table tfoot td ul { margin: 0; padding:0; list-style: none; text-align: right; }.datagrid table tfoot  li { display: inline; }.datagrid table tfoot li a { text-decoration: none; display: inline-block;  padding: 2px 8px; margin: 1px;color: #FFFFFF;border: 1px solid #006699;-webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px; background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #006699), color-stop(1, #00557F) );background:-moz-linear-gradient( center top, #006699 5%, #00557F 100% );filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#006699', endColorstr='#00557F');background-color:#006699; }.datagrid table tfoot ul.active, .datagrid table tfoot ul a:hover { text-decoration: none;border-color: #006699; color: #FFFFFF; background: none; background-color:#00557F;}div.dhtmlx_window_active, div.dhx_modal_cover_dv { position: fixed !important; }
img {
    border: 243;
    width: 26px;
}

.datagrid table tbody tr:hover {
    color: #00496B;
    border-left: 1px solid #12a6ea;
    text-align: center;
    font-size: 12px;
    color: #ffffff;
    font-weight: normal;
    background: -webkit-gradient( linear, left top, left bottom, color-stop(0.05, #4c9ec7ad), color-stop(1, #5a82ea) );
}

.paging-nav {
  text-align: right;
  padding-top: 2px;
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

 
.paging-nav .selected-page {
  background: #187ed5;
  font-weight: bold;
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

$oe = new conexion();

//<!-- OBTENEMOS EL ID DE ADMIN EVENTO PARA VALIDAR SI EL USUARIO , TIENE PERMISOS PARA
//PODER MODIFICAR LOS UMBRALES Y LOS DEMAS COMPONENTES -->

$cedula= $userinfo->user_id;

$eventos_cerrados=$oe->conexion->query("select a.id_evento,b.tipo_incidente,b.tipo,a.observaciones,
b.detalles,a.fecha,b.fecha_cierre,b.ticket from (select id as 'id_evento',tipo_evento,fecha,observaciones from 
incidentecop where responsable='$cedula' and estado='S' and fecha between 
date_format((now() - interval (day(now())-1) day),'%Y-%m-%d') and date_format(now(),'%Y-%m-%d') order by
id_evento asc)a 
left join solucion_incidente b on a.id_evento=b.id_evento 
union
select a.id_evento,b.tipo_incidente,b.tipo,a.observaciones,b.detalles,a.fecha,b.fecha_cierre,b.ticket 
 from (select distinct id_evento,tipo_evento,descripcion as 'observaciones',f_inicio as 'fecha' 
 from registro_masivo where responsable='$cedula' and f_inicio between 
date_format((now() - interval (day(now())-1) day),'%Y-%m-%d') and date_format(now(),'%Y-%m-%d') and estado='S')a
 left join 
solucion_incidente b on a.id_evento=b.id_evento and b.tipo='masivo' order by tipo,id_evento asc");

$numero_eventos=$oe->conexion->query("select count(a.id_evento) as num from (select a.id_evento from 
(select id as 'id_evento',tipo_evento,fecha,observaciones from 
incidentecop where responsable='$cedula' and estado='S' and fecha between 
date_format((now() - interval (day(now())-1) day),'%Y-%m-%d') and date_format(now(),'%Y-%m-%d') order by
id_evento asc)a 
left join solucion_incidente b on a.id_evento=b.id_evento 
union
select a.id_evento  from (select distinct id_evento,tipo_evento,descripcion as 'observaciones',f_inicio as
 'fecha'  from registro_masivo where responsable='$cedula' and f_inicio between 
date_format((now() - interval (day(now())-1) day),'%Y-%m-%d') and date_format(now(),'%Y-%m-%d') and estado='S')a
 left join 
solucion_incidente b on a.id_evento=b.id_evento and b.tipo='masivo' order by id_evento asc)a

");
//$res=$oe->conexion->query("select b.admin_evento from new_usuario a, sub_grupo b
	//	where a.cedula=b.cedula and a.cedula='$userinfo->user_id'");

$num=$numero_eventos->fetch_assoc();

?>




<link rel="stylesheet" href="plugins/select2/select2.min.css"/>
<style>

    .select2-container--default .select2-selection--single
    {
        border-radius: 0;
        border-color: #d2d6de;
        width: 100%;
        height: 34px;
    }
</style>



<?php if($num["num"] != "0"){ ?>

<div class="box box-success">
    <div class="box-header with-border">
   <!-- Barra de progreso -->
             <br> <div class="progress progress-sm active">
                <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 40%">                  
                </div>
              </div>   
              <div class="datagrid">
                        <table class="datagrid" id="table-demo">
                        
                          <thead>
                          <tr>
                                <th>ID Evento</th>
                                <th>Incidente / requerimiento</th>
                                <th>Tipo de evento</th>  
                                <th>Detalles evento</th> 
                                <th>Detalles de solución</th> 
                                <th>Fecha de inicio del evento</th>     
                                <th>Fecha de cierre del evento</th>          
                                <th>Ticket</th>           
                                
                           </tr>                  
                          </thead>
                          
                          <tbody>
                              
                            <?php while($res=$eventos_cerrados->fetch_assoc()){?>

  <tr>
  
    <td><?php echo $res["id_evento"]?></td> 
    <td><?php echo $res["tipo_incidente"]?></td>    
    <td><?php echo $res["tipo"]?></td>
    <td><?php echo $res["observaciones"]?></td> 
    <td><?php echo $res["detalles"]?></td>    
    <td><?php echo $res["fecha"]?></td>  
    <td><?php echo $res["fecha_cierre"]?></td>       
    <?php if($res["ticket"] != ""){?>
    <td><?php echo $res["ticket"]?></td>         
   <?php }else{?>
        <td>No diligenciado</td>         
    
    <?php }?>
    
  </tr>
  
  <?php }?> 




                          </tbody>
                          
                        
                        
                        </table>
                        
                        
                      <?php }else{
      
      
      
     echo "<script>
alertify.alert('<b>No tienes eventos cerrados en este mes</b>');
function redireccionar(){window.location='index.php';} 
setTimeout ('redireccionar()', 5000)




</script>";
      
      
      
  } ?>

                </div>    
                    <div class="row">
                    
                    
                    
                        <div class="form-group">


        
                        </div>
                                             
                    </div>
                               
</div>

</div>




<script>

$("#table-demo").simplePagination({

	perPage: 10,
	containerClass: '',
	previousButtonClass: '',
	nextButtonClass: '',
	previousButtonText: 'Anterior',
	nextButtonText: 'Siguiente',
	currentPage: 1

	});


</script>
