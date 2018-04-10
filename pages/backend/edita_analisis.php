<link rel="stylesheet" href="plugins/alertify.default.css">
<link rel="stylesheet" href="plugins/alertify.core.css">
<script src="plugins/alertify.min.js"></script>

<style>
.datagrid table { border-collapse: collapse; text-align: left; width: 100%; } 
.datagrid {font: normal 12px/150% Arial, Helvetica, sans-serif; background: #fff; overflow: hidden; 
border: 1px solid #006699; -webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px; }
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

textarea {
    resize: none;
    border-radius: 7px;
    box-shadow: 1px 0px 30px #888888;
}

#header_modal{background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #006699), 
color-stop(1, #008FD6) );  height: 73px;;background:-moz-linear-gradient( center top, #006699 5%, #008FD6 100% );
text-align:center;filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#006699', endColorstr='#008FD6');
background-color:#006699; color:#FFFFFF; font-size: 15px; font-weight: bold; border-left: 1px solid #0070A8;  
}

.alertify {
    position: fixed;
    z-index: 99999;
    top: 50px;
    left: 43%;
    width: 350px;
    margin-left: -275px;
    margin: 0 auto;
    opacity: 1;
}

#upda{

    background-color: transparent;
    border-color: transparent;
    margin-left: 6px;

}

#search {
    float: right;
    margin-top: 9px;
    width: 250px;
}

.search {
    padding: 5px 0;
    width: 230px;
    height: 30px;
    position: relative;
    left: 10px;
    float: left;
    line-height: 22px;
}

    .search input {
        position: absolute;
        float: Left;


        height: 30px;
        line-height: 18px;
        padding: 0 2px 0 2px;
        border-radius:1px;
    }

        .search:hover input, .search input:focus {
            width: 200px;
            margin-left: 0px;
        }

#btn_search {
    height: 30px;
    position: absolute;
    right: 0;
    top: 5px;
    border-radius:1px;
}

</style>

<?php
session_start ();
if ($_SESSION ['authenticated'] == 1) {
    
    include("../../modelo/conexion.php");
    
    $wish=new conexion();
    
    $contrato=$_POST["contrato"];
    $plataforma=$_POST["plataforma"];
    $ano=$_POST["ano"];
    $mes=$_POST["mes"];
    $aux=0;

$cant=$wish->conexion->query("select count(id) as id from analisis_reporte where id_contrato='$contrato' 
and plataforma='$plataforma' and ano='$ano' and mes=$mes");    
    
$consulta_analisis=$wish->conexion->query("select * from analisis_reporte where id_contrato='$contrato' 
and plataforma='$plataforma' and ano='$ano' and mes=$mes");    
    
$contrato=$wish->conexion->query("select nombre from new_proyectos where codigo='$contrato'"); 
$nombre_contra=$contrato->fetch_assoc();
$nom_contra=$nombre_contra["nombre"];


$mes=$wish->conexion->query("select descripcion from mes where id_mes=$mes");
$nombre_mes=$mes->fetch_assoc();
$nom_mes=$nombre_mes["descripcion"];
}


while($resultado_count=$cant->fetch_assoc()){

    if($resultado_count["id"] != 0){
        
        $aux=1;
    }else{
        
        $aux=0;
    }
}

if ($aux != 0){
    ?>




<div class="container">
	<div class="row" >
        <div class="search">
<input type="text" id="txt_buscar" class="form-control input-sm" maxlength="64" placeholder="Buscar..." />
 <button type="submit" id="btn_search" class="btn btn-primary pull-left">Buscar</button>
</div>
	</div>


</div><br>


<div class="datagrid"><table>
<thead>
<tr>
  <th>NOMBRE DE CONTRATO</th>
  <th>PLATAFORMA</th>
  <th>TIPO</th>
  <th>MES/AÑO</th>
  <th>ANÁLISIS</th>
  <th>ACTUALIZAR</th>
  
  </tr>
</thead>

  <tbody>
  
  
  
 
   <?php while ($resultado=$consulta_analisis->fetch_assoc()){?>
   
    
      <tr>
          <td><label title="<?php echo $resultado["id"]?>" id="nom_contra<?php echo $resultado["id"]?>"><?php echo $nom_contra?></label></td>
          <td><label id="plataforma<?php echo $resultado["id"]?>"><?php echo $resultado["plataforma"]?></label></td>
          <td><label id="tipo<?php echo $resultado["id"]?>"><?php echo $resultado["tipo"]?></label></td>
          <td><label id="fecha<?php echo $resultado["id"]?>"><?php echo $nom_mes." ".$resultado["ano"]?></label></td>
          <td><label id="analisis<?php echo $resultado["id"]?>"><?php echo $resultado["descripcion_analisis"]?></label></td>
  
				<td>
					<div class="col-md-4" style="padding-right: 23px;">
					<div class="form-group">
						<a href="#" data-target="#modalactualizar" data-toggle="modal" onclick="upd('<?php echo $row['Servicio'];?>','<?php echo $textoArea;?>',<?php echo $row['id_detalle'];?>, '<?php echo $row['delay'];?>', '<?php echo $row['tiempo_chequeo'];?>', '<?php echo $row['Warning'];?>', '<?php echo $row['Critical'];?>');">
						<button onclick="datos_modal_editar(<?php echo $resultado["id"]?>)" id="upda" type="submit" class="btn btn-default" 
						data-target="#edita_analisis" data-toggle="modal" title="Editar analisis" ><img src="dist/img/refresh-icon.png" /></button>
						</a>
					</div>
					</div>
				
				</td>
      </tr>
      <?php }?>

</tbody>




</table>

</div>

    
    <?php 
}else{
    
    echo "<script>
alertify.alert('<b>NO HAY DATOS PARA MOSTRAR</b>', function(){ alertify.success('Ok') });
     </script>";
}


?>

<script>

function datos_modal_editar(id) {


var analisis=document.getElementById("analisis"+id).innerHTML;

   $('#edit_analisis').val(analisis);
   $('#id_edit').val(id);
   

	
}


</script>



	<div class="modal fade" id="edita_analisis" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
		<div style="width: 130%; border-radius:10px;" id="modalesc" class="modal-content">
		
		<div class="modal-header" id="header_modal">
				<h4 class="modal-title" id="myModalLabel_conf" style="font-size:20px; text-align:center"><h2><b>Editar análisis</b></h2></h4>

		</div>
		<section class="box_edit">
		<div class="modal-body">
  <form onsubmit="guarda_cambio_analisis(); return false">
 
		<div class="col-md-13">
		<div class="box box-info">
		<div class="box-body">

         <br><label  style="font-size:14px; text-align:center"><h3><b>Análisis a editar.</b></h3></label><br><br>
      
<textarea  required="required" id="edit_analisis"  name="analisis_nuevo" style="margin: 0px; width: 727px; height: 128px;"></textarea>
<input type="hidden" id="id_edit" name="id_analisis_editar">
		<!-- <button type="button" class="btn btn-danger pull-right butt" data-dismiss="modal" aria-hidden="true">Cerrar</button> -->
		 
		</div>
		 </div>
		 		  					  <button style="margin-left: 12px;" type="submit" id="buscar"  class="btn btn-success">Guardar cambios</button>  
		 		  			
		 
		 		 		  	<button style="margin-left: 10px;" data-dismiss="modal"  id="cancelar"  class="btn btn-primary">Cancelar</button>  
		 
		 
		  </div>
		  </form>
		    </div>
		   
		   
 </section>

			<div class="modal-footer">
			
			
			</div>
			</div>
		</div>
	</div>
	  
	<!-- FIN DE MODAL -->
	
	
	
	
	
	<script>

	function guarda_cambio_analisis() {

		var id_analisis=document.getElementById("id_edit").value;
		var analisis=document.getElementById("edit_analisis").value;

	
		var parametros = {
                "id_analisis": id_analisis,     
                "analisis": analisis
            };

		   $.ajax({
		       data: parametros,
		       url: 'pages/backend/includes/inserta_analisis_editado.php',
		       type: 'post',
		   
		       success: function (response) {
		     	  alertify.alert('<b>Cambios guardados correctamente');
		       	 setTimeout('document.location.reload()',5000);    
		       }    	                
		   });

		
	}


    $(document).ready(function(){
   	 $("#txt_buscar").keyup(function(){
   	 _this = this;
   	 // Show only matching TR, hide rest of them
   	 $.each($("#tabla tbody tr"), function() {
   	 if($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
   	 $(this).hide();
   	 else
   	 $(this).show();
   	 });
   	 });
   	});

	</script>
	