 
 
<style>


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



.demotbl {
    border: 0px solid #69899F;
    font-size: 15px;   
  }
.demotbl th {
    /* padding: 15px; */
    color: #fff;
    /* text-shadow: 1px 1px 1px #568F23; */
    /* background-color: #9DD929; */
    /* background: -webkit-gradient( linear, left bottom, left top, color-stop(0.02, rgb(123,192,67)), color-stop(0.51, rgb(139,198,66)), color-stop(0.87, rgb(158,217,41)) ); */
    background: -webkit-gradient( linear, left top, left bottom, color-stop(0.05, #006699), color-stop(1, #008FD6) );
    background: -moz-linear-gradient( center bottom, rgb(123,192,67) 3%, rgb(139,198,66) 52%, rgb(158,217,41) 88% );
    -webkit-border-top-left-radius: 5px;
    -webkit-border-top-right-radius: 5px;
    -moz-border-radius: 5px 5px 0px 0px;
    border-top-left-radius: 2px;
    border-top-right-radius: 0px;
        text-align: center;
            PADDING: 10PX;
}
.demotbl td{
    width:100px;
    padding:10px;
    text-align:center;
    vertical-align: top;
    background-color:white;
    -moz-border-radius:2px;
    -webkit-border-radius:2px;
    border-radius:2px;
    color:#666;
    text-shadow:1px 1px 1px #fff;

  }



tr:hover td { background: #d0dafd; }


	.select2-container--default .select2-selection--single, .w3-input
	{
		padding: 5px;
	    display: block;
	    border: none;
	    border-bottom: 1px solid #ccc;
	}


	.select2-container--default .select2-selection--single, .w3-input
	{
		padding: 5px;
	    display: block;
	    border: none;
	    border-bottom: 1px solid #ccc;
	
	}
	
	.ms-options ms-active
	{
		min-height: 100px; 
		max-height: 100px;
	}
	
	.ms-drop.bottom
	{
		width: 310px;
		
	}

    #busqueda{

    
    width: 204px;
    line-height: 18px;
}


#buscar{
    margin-left: 34px;
        padding: 7px;
}


#btnExport{
   cursor: pointer;
    width: 65px;
     margin-right: 594px;
    position: relative;
    display: inline-block;
    box-sizing: border-box;
    padding: 0.5em 1em;
    border: 1px solid #999;
    border-radius: 2px;
    cursor: pointer;
    font-size: 0.88em;
    color: black;
    white-space: nowrap;
    overflow: hidden;
    background-color: #e9e9e9;
    background-image: -webkit-linear-gradient(top, #fff 0%, #e9e9e9 100%);
    background-image: -moz-linear-gradient(top, #fff 0%, #e9e9e9 100%);
    background-image: -ms-linear-gradient(top, #fff 0%, #e9e9e9 100%);
    background-image: -o-linear-gradient(top, #fff 0%, #e9e9e9 100%);
    background-image: linear-gradient(to bottom, #fff 0%, #e2dcdc 100%);
    filter: progid:DXImageTransform.Microsoft.gradient(GradientType=0,StartColorStr='white', EndColorStr='#e9e9e9');
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    text-decoration: none;
    outline: none;
    margin-left: 35px;
    margin-bottom: 11px;
    
    
    
}


#btnEx{
MARGIN-LEFT: 9px;
}

</style>




<?php
session_start ();
if ($_SESSION ['authenticated'] == 1) {
    include("../../modelo/conexion.php");
    
   // $id  =$_POST['id'];
    $aux="";
    
    $wish = new conexion;
   
    $mes=$_POST["mes"];
    $ano=$_POST["ano"];
    
    $month = explode (".'-'.",$mes);
    
    $id_mes=$month[0];
    
    

    
    $descripcion_mes=$month[1];
   
    
    //echo "yo soy el mes".$id_mes." yo sopy el aÃ±o: ".$ano." yo soy la descripcion: ".$descripcion_mes;
    

    
   
    $consulta=$wish->conexion->query("select a.cliente,a.zona,b.descripcion,max(a.ans_acordado) as ans,
 round(AVG(a.cumplimiento),2) as promedio,a.justificacion,a.plan_accion from indicador_operacion a,mes b where DATE_FORMAT(fecha, '%m')='$mes' 
and YEAR(fecha) = '$ano' and '3' group by cliente");
    
    $consulta1=$wish->conexion->query("select a.cliente,a.zona,b.descripcion,max(a.ans_acordado) as ans,
 round(AVG(a.cumplimiento),2) as promedio,a.justificacion,a.plan_accion from indicador_operacion a,mes b where DATE_FORMAT(fecha, '%m')='$mes'
and YEAR(fecha) = '$ano' and '3' group by cliente");
    
   // $fecha=$descripcion_mes." ".$ano;
   
  
    //$consulta2=$wish->conexion->query("select cliente,descripcion_servicio, justificacion, plan_accion from indicador_operacion where 
//DATE_FORMAT(fecha, '%m')=$id_mes and YEAR(fecha) = '$ano' group by justificacion");
   
    
   $consulta2=$wish->conexion->query("select cliente,descripcion_servicio, justificacion, plan_accion from indicador_operacion where
    DATE_FORMAT(fecha, '%m')=$id_mes and YEAR(fecha) = '$ano' group by justificacion order by cliente ASC"); 
    
  while($resul=$consulta->fetch_assoc()){  
   
    $temp=$resul["ans"];
    
    
    $nuevo_temp = str_replace("%","", $temp);
    
    if($resul["promedio"] < $nuevo_temp){
        
        $clientes[]= $resul["cliente"];
        $justificacion[]=$resul["justificacion"];
        $plan_accion[]=$resul["plan_accion"];
        $aux=0;
        
  
        
    }elseif(($resul["promedio"] >= $nuevo_temp)){
      
     
        $mensaje="Para el mes de ".$descripcion_mes.", todos los clientes <b><font color=\"green\">cumplieron</font></b> con los indicadores de operación.<br><br>";
        $aux=1;
        
    }elseif(($resul["promedio"] == null)) {
        
        $aux=2;
        
        
    }
        
        //$mensaje1="No hay registros";
        //$aux=2;
    
    
  }?>
  <div class="box box-default" >
  
  	<div class="box-header with-border">
  
  <div class="box-body" >
     
     
     
     
     
        <?php
        
   
        
  if(($aux == '0')){      
        
  echo "<b>Para el mes de ".$descripcion_mes." los clientes que <b><font color=\"red\">no cumplieron</font></b> con sus indicadores de operación fueron:</b></br><br>";
   
  for($i=0;$i<count($clientes);$i++){
      
     echo "* <font color=\"red\">".$clientes[$i]."</font><br>";
  }
  
  
  
  
  ?> 
   <br>
   <!--  <br><button id="btnJusti" ><img src="dist/img/excel.png" /></button><br><br> --> 


  <label><b>Tabla de justificación por cliente para el mes de <?php echo $descripcion_mes?></b></label><br>
   

   
   
 <table id="justificacion" class="demotbl">
 
    <thead>
    	<tr>
        	<th><b>CLIENTE</b></th>
        	<th><b>SERVICIO</b></th>
        	<th><b>JUSTIFICACIÓN</b></th>
        	<th><b>PLAN DE ACCIÓN</b></th>
    	</tr>
    </thead>
 
 	<tbody>

   
     
    <?php 
    while($res1=$consulta2->fetch_assoc()){
    
        $just=$res1["justificacion"];
        $plan=$res1["plan_accion"];
        
        
        if(($just != "") || ($plan != "")){
       
             if(($just != "") && ($plan=="")){
        ?>
        <tr>
              <td><?php echo $res1["cliente"]?></td>
              <td> <?php echo $res1["descripcion_servicio"]?></td>
              <td><?php echo $res1["justificacion"]?></td>
              <td><font color="red"><b>N/A</b></font></td>
        </tr>
            
     

    <?php 
             }elseif (($just == "") && ($plan != "")){
                 ?>
                 
              <tr>
              <td><?php echo $res1["cliente"]?></td>
              <td> <?php echo $res1["descripcion_servicio"]?></td>
              <td><font color="red"><b>N/A</b></font></td>
              <td> <?php echo $res1["plan_accion"]?></td>              
              </tr>
                 
                 <?php
             }else{
                 ?>
                 
              <tr>
              <td><?php echo $res1["cliente"]?></td>
              <td> <?php echo $res1["descripcion_servicio"]?></td>
              <td><?php echo $res1["justificacion"]?></td>
              <td> <?php echo $res1["plan_accion"]?></td>
              </tr>
                 
                 <?php
             }
           }
        
        }?>
    
    </tbody>

 </table>
  
  <?php
 
  echo '<br>';
  }elseif(($aux == '1')){
        
      echo $mensaje;
    }else{
        
        echo '<script language = javascript>
 alertify.alert("<b>NO EXISTEN REGISTROS PARA LA FECHA ESTABLECIDA, <BR><font color=\"red\">INTÉNTALO NUEVAMENTE</font>");
</script>';
        
        
  return ;
    } 
   ?>
  
    <?php $wish->cerrar();
    
}



?>

 

<div id="tabla_cumplimiento" class="demotbl">

       <label><b>Tabla de promedio cumplimiento por cliente para el mes de <?php echo $descripcion_mes?></b></label><br><br>   



             	<div class="excel">
        <div class="search">      
        
<input type="text" id="txt_buscar" class="form-control input-sm" maxlength="64" placeholder="Buscar..." />
 <button type="submit" id="btn_search" class="btn btn-primary btn-sm">Buscar</button>
 
</div>
       <button id="btnExport" class="btn btn-primary pull-left" img	><img src="dist/img/excel.png" /></button> 

	</div>

            
        <!--    <button id="consultar_tiempo" ><img src="dist/img/excel.png" /></button><br><br>    --> 
     
 <div style=" width: 101.5%; height:280px; overflow-y: scroll;">
            
            
            <table id='promedio'>
             
              <thead>   
             <tr>
                  <th><b>CLIENTE</b></th>
                  <th><b>ZONA</b></th>
                  <th><b>ANS ACORDADO</b></th>
                  <th><b>PROMEDIO DE CUMPLIMIENTO</b></th>
            
             </tr>
               </thead>
               
               <tbody>
    <?php 
    while($res=$consulta1->fetch_assoc()){
    
        $ans_acordado = str_replace(".", ",",  $res["ans"]);
        $promedio = str_replace(".", ",", $res["promedio"]);
        ?>
        
              <tr>
              
                 <td><?php echo $res["cliente"]?></td>
                 <td><?php echo $res["zona"]?></td>
                 <td><?php echo $ans_acordado?>
                 <td><?php echo $promedio."%"?></td>
              
              </tr>
         
         

    <?php }?>
    
          </tbody>
    </table>
     </div>

 </div>
 
 
 </div>
</div>
</div>


<script src="plugins/jquery.table2excel.js"></script>


<script>

$("#btnExport").click(function(){
	  $("#promedio").table2excel({
	    filename: "Cumplimiento"
	  }); 
	});

//Write on keyup event of keyword input element
$(document).ready(function(){
$("#txt_buscar").keyup(function(){
_this = this;
// Show only matching TR, hide rest of them
$.each($("#promedio tbody tr"), function() {
if($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
$(this).hide();
else
$(this).show();
});
}); 
});


</script>











