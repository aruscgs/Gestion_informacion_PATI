
<link rel="stylesheet" href="plugins/alertify.default.css">
<link rel="stylesheet" href="plugins/alertify.core.css">
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="plugins/alertify.min.js"></script>


<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>



<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">    

<style>

table {
    
    border-collapse: collapse;
    width: 100%;
}

th, td {
    text-align: left;
    padding: 8px;
}

tr:nth-child(even){background-color: #f2f2f2}

th {
    background-color: #4CAF50;
    color: white;
}

th {
    background-color: #4CAF50;
    color: white;
}

</style>



<?php
session_start ();
if ($_SESSION ['authenticated'] == 1) {
    include("../../modelo/conexion.php");
    
    $con=new conexion();

    
    $nombre_cliente=$_POST["cliente"];//trae el id del cliente
    $servicios=$_POST['cis'];//trae los ids de los servicios
    
    
   
    $cont=0;
    
    //cantidad de servicios elegidos 
    foreach ($servicios as $servi){
        
        $cont=$cont+1;
        
    }
    
   
$verificacion=$con->conexion->query("select * from cliente_servicio where id_cliente='$nombre_cliente'");
$cantidad=$con->conexion->query("SELECT count(id_cliente_servicio) from cliente_servicio where id_cliente='$nombre_cliente'");



while($row=$verificacion->fetch_assoc()){
    
    $serv_bd[]=$row['id_servicio'];
}


$ser="";
$nuevo_ser[]="";
$aux=0;
$cont_rep=0;

$cant_servi=$cantidad->fetch_array();

for($i=0;$i<$cont;$i++){
    
    for($j=0;$j<$cant_servi[0];$j++){
        
        if($servicios[$i]==$serv_bd[$j]){
            
            $nombre=$con->conexion->query("select nombre from servicio_indicador where id_servicio='$servicios[$i]'");
            $nombres=$nombre->fetch_assoc();
            
            
            $ser=$ser."<br>*".$nombres["nombre"];
            $cont_rep=$cont_rep+1;
            $aux=1;
            
        }
    
    }
    if($aux!=1){
    $nuevo_ser[]=$servicios[$i];
    }
    $aux=0;
 }
     
 
 
 /*foreach($nuevo_ser as $nuevo ){
     
     echo $nuevo."<br>";
     
 }*/
 
 $new=(int)(count($nuevo_ser));

 $con_new=$new-1;
 
 if($ser!="" && $con_new==0){
    echo("
<label><b><FONT COLOR=red>LOS SIGUIENTES SERVICIOS YA ESTÁN ASIGNADOS AL CLIENTE: </FONT></b></lebel>
<label>$ser</label><br>   
   
");
 }else if(($ser!="") && ($nuevo_ser!= "")){
echo("
<label><b><FONT COLOR=red>LOS SIGUIENTES SERVICIOS YA ESTÁN ASIGNADOS AL CLIENTE: </FONT></b></lebel>
<label>$ser</label><br>
<label><FONT COLOR=red>Desea continuar asignando los servicios aún no asignados al cliente?</FONT></label>
<input type='button'style='width: 150px;' value='Asignar' class='btn btn-success' data-target='#myModal' data-toggle='modal' onclick='modal_ans()'></input>


");

 }else if($ser=="" && $con_new!=0){
    
    
    echo "
<label><b><FONT COLOR=red>SI ESTA SEGURO DE ASIGNAR LOS SERVICIOS ELEGIDOS, POR FAVOR CLIC EN ASIGNAR, PARA PARA PROCEDER INGRESANDO EL ANS ACORDADO PARA CADA SERVICIO. </FONT></b></lebel><br><br>
<input type='button'style='width: 150px;' value='Asignar' class='btn btn-success' data-target='#myModal' data-toggle='modal' onclick='modal_ans()'></input>

";
    
        
}


}



?>


   



<!-- Modal ANS -->
  <div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
    
    <form>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Asignación de servicios</h4>
      </div>
      <div class="modal-body">
        <input type="hidden" id="id_cliente" value="<?php echo $nombre_cliente?>">
        <table id="ans_servicio">
        <tr>
         <th><h5><b>SERVICIO</b></h5></th>
         <th><h5><b>ANS ACORDADO</b></h5></th>
        
        </tr>
        
        <?php 
           
     for($i=1;$i<=$con_new;$i++){
          
          $nombre_servicio=$con->conexion->query("select nombre from servicio_indicador where id_servicio='$nuevo_ser[$i]'");
          $res=$nombre_servicio->fetch_assoc();
          
          ?>
          <input id="id_servicio<?php echo $i?>" type="hidden" value="<?php echo $nuevo_ser[$i];?>"></input>
          <tr>
          
           <td>
             
              <label id="nombre_servicio<?php echo $i;?>"><?php echo $res["nombre"] ?></label>
           </td>
           
           <td>
              <input type="text" id="ans<?php echo $i?>" ></input>
           </td>
           
      
          </tr>
          
    <?php  } ?>  
         

        

        </table>
        
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-dismiss="modal" onclick="asigna_servicio_cliente()">Guardar</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="location.reload()">Cerrar</button>
      </div>
      
      </form>
    </div>

  </div>
</div> 

<!-- FIN MODAL ANS -->
  
<script>

function asigna_servicio_cliente() {

var num_row=document.getElementById("ans_servicio").rows.length;
var num=num_row-1;
var id_cliente=document.getElementById("id_cliente").value;
var aux=0;
var aux2=0;

for(i=1;i<=num;i++){

var id_servicio=document.getElementById("id_servicio"+i).value;

var ans=document.getElementById("ans"+i).value;

if(ans==""){

	aux=1;
	// alert("DEBES DILIGENCIAR LOS CAMPOS ANS CORRECTAMENTE.");
	
}

//inserta_datos_ans(id_cliente,id_servicio,ans);
}
if(aux!=0){
	alertify.alert('<b>Antes de asignar los servicios al cliente, debes asegurarte de diligenciar correctamente los campos <font color="red">ANS</font> acordados.</b>');
	//location.reload();
}else{

	for(i=1;i<=num;i++){

		var id_servicio=document.getElementById("id_servicio"+i).value;
	
		var ans=document.getElementById("ans"+i).value;

		inserta_datos_ans(id_cliente,id_servicio,ans,aux2);

		  aux2=aux2+1;
		}
}


}








function inserta_datos_ans(id_cliente,id_servicio,ans,aux2) {

	
  
	 var parametros = {
		        "id_cliente": id_cliente,     
		        "id_servicio": id_servicio,
		        "ans": ans,
		        "aux2":aux2
		    };
		    $.ajax({
		        data: parametros,
		        url: 'pages/backend/includes/asigna_servicio_cliente.php',
		        type: 'post',
		       
		        success: function (response) {
			      
		            $("#res").html(response);
		        	//window.setTimeout('location.reload()');
		        }
		    });
		}
			
	

</script>


<div id="res"> </div>

