
<link rel="stylesheet" href="plugins/alertify.default.css">
<link rel="stylesheet" href="plugins/alertify.core.css">
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="plugins/alertify.min.js"></script>





<?php
session_start ();
if ($_SESSION ['authenticated'] == 1) {
	include("../../modelo/conexion.php");
    $con=new conexion();
    
	
	//Obtiene el valor del radioboton que determina la manera de buesqueda del indicador
	$busqueda=$_POST['rbtnBusqueda'];
	
	$mes=$_POST['mes'];
	
	$ano=date("Y");


	if($mes>0 && $mes<10){
	    
	    $mes="0".$mes;
	}
	
	//echo $mes;
	//echo $ano;
	
	$nombre_mes=$con->conexion->query("select descripcion from mes where id_mes=$mes ");
	
	$mes_nom=$nombre_mes->fetch_assoc();
	
	if ($busqueda=='general'){
		
		$res=$con->conexion->query("select a.* from (select a.* ,b.* from (SELECT b.id_cliente,a.nombre,b.cliente ,b.zona ,
c.ANS from servicio_indicador a, cliente b, cliente_servicio c where c.id_cliente=b.id_cliente 
and c.id_servicio=a.id_servicio)a left join (select a.id,a.descripcion_servicio,a.cliente as 'clientes',a.zona as 
'zonas',a.fecha,a.ans_acordado,a.indicador_cr,a.indicador_cl,a.indicador_general,a.cumplimiento,a.justificacion,
a.plan_accion from indicador_operacion a, cliente b where YEAR(a.fecha)='2018' and MONTH(a.fecha)='$mes' 
and a.cliente=b.cliente)b on a.nombre=b.descripcion_servicio and a.cliente=b.clientes group 
by a.nombre,a.cliente)a order by a.cliente asc");
		
		
		
	}else{
		$cliente=$_POST['clientes'];
				
		
		$res=$con->conexion->query("select a.*,b.* from (SELECT b.id_cliente,a.nombre,b.cliente,b.zona,c.ANS 
from servicio_indicador a, cliente b, cliente_servicio c where c.id_cliente=b.id_cliente 
and c.id_servicio=a.id_servicio and b.id_cliente=$cliente)a LEFT JOIN (select a.* from indicador_operacion a,
cliente b where YEAR(a.fecha)='$ano' and MONTH(a.fecha)='$mes' and a.cliente=b.cliente and b.id_cliente=$cliente)b 
on a.nombre=b.descripcion_servicio");
		
	
		$res1=$con->conexion->query("SELECT cliente,zona from cliente where
id_cliente=$cliente");
		
		$datos_cliente=$res1->fetch_assoc();
		$nom_cli=$datos_cliente["cliente"];
	
		$zona_cliente=$datos_cliente["zona"];
		
		//echo $nom_cli;
		//echo $zona_cliente;
		
	}
	

	

}
?>
        <div class="search">      
        
<input type="text" id="txt_buscar" class="form-control input-sm" maxlength="64" placeholder="Buscar..." />
 <button type="submit" id="btn_search" class="btn btn-primary btn-sm">Buscar</button>
 
</div><br><br><br>

           
 <div style=" width: 101.5%; height:280px; overflow-y: scroll;">

<table id="indicadores_operacion" class="datagrid">  
         <thead>
          <tr id="tbl_titulo">
           
           <th><b>DESCRIPCIÓN NIVEL SERVICIO </b></th>
           <th><b>CLIENTE</b></th>
           <th><b>ZONA</b></th>
           <th><b>FECHA</b></th>
           <th><b>ANS ACORDADO </b></th>
           <th><b>INDICADOR ARUS (%)</b></th>
           <th><b>INDICADOR CLIENTE (%)</b></th>
           <th><b>INDICADOR GRAL (%)</b></th>
           <th><b>CUMPLIMIENTO (%)</b></th>
           <th><b>JUSTIFICACIÓN</b></th>
           <th><b>PLAN DE ACCIÓN</b></th>
          
          </tr>
      
        </thead>
       <tbody>
       
 
       
     <?php $i=1; while($row=$res->fetch_assoc()){
         
         $indi_cr=$row["indicador_cr"];
         $indi_cl=$row["indicador_cl"];
         $indi_gral=$row["indicador_general"];
         $cumplimiento=$row["cumplimiento"];
         
         
         if($indi_cl != '' && $indi_cl != '' && $indi_gral != '' && $cumplimiento != ''){?>
             
               <tr id="fila<?php echo $i?>" onclick="clic_cal(<?php echo $i?>)">     	
           <td><label id="nombre_servicio<?php echo $i;?>" ><?php  echo $row['nombre'] ?></label></td>
           <td><label id="cliente<?php echo $i;?>"  ><?php  echo $row['cliente'] ?></label></td>
           <td><label id="zona<?php echo $i;?>" ><?php  echo $row['zona'] ?></label></td>
           <td><label id="mes<?php echo $i;?>" ><?php  echo $mes_nom['descripcion']." ". date ("Y");  ?></label></td>
           <td><label id="ans<?php echo $i;?>"  style="width:75px" ><?php  echo $row['ANS'] ?></label></td>
           <td><label id="ind_cr<?php echo $i;?>" style="width:75px" ><?php echo $indi_cr?></label></td>
           <td><label id="ind_cl<?php echo $i;?>" style="width:75px"><?php echo $indi_cl?></label></td>
           <td><label id="ind_gral_calc<?php echo $i;?>"  style="width:75px"><?php echo $indi_gral?> </label></td>
           <td><label id="cumplimiento<?php echo $i;?>" style="width:75px"><?php echo $cumplimiento?></label></td>
           <td><label id="justificacion<?php echo $i;?>"  style="width:75px" ><?php echo $row["justificacion"]?></label></td>
           <td><label id="plan_acc<?php echo $i;?>" style="width:75px" ><?php echo $row["plan_accion"]?></label></td>
             </tr> 	
             
       <?php $i++;}else{ 
       
           ?>  
          
                 
         <tr id="fila<?php echo $i?>" onclick="clic_cal(<?php echo $i?>)">     	
           <td><label id="nombre_servicio<?php echo $i;?>" ><?php  echo $row['nombre'] ?></label></td>
           <?php if($busqueda!='general'){?>
           <td><label id="cliente<?php echo $i;?>" ><?php   echo $nom_cli ?></label></td>
           <td><label id="zona<?php echo $i;?>"><?php echo $zona_cliente ?></label></td>
           <?php }else{?>
           <td><label id="cliente<?php echo $i;?>" ><?php   echo $row['cliente'] ?></label></td>
           <td><label id="zona<?php echo $i;?>" ><?php echo $row['zona'] ?></label></td>
           <?php }?>
           <td><label id="mes<?php echo $i;?>" ><?php  echo $mes_nom['descripcion']." ". date ("Y");  ?></label></td>
           <td><label id="ans<?php echo $i;?>" style="width:75px"><?php  echo $row['ANS'] ?></label></td>
           <td><input id="ind_cr<?php echo $i;?>" class="w3-input war" onkeydown="EnterToTab(<?php echo $i?>)" name="ind_cr"  type="number" min="1" max="100" style="width:75px" required></td>
           <td><input id="ind_cl<?php echo $i;?>" class="w3-input war"  onkeydown="EnterToTab(<?php echo $i?>)" name="ind_cl" min="1" max="100"  type="number" style="width:75px" required></td>
           <td><input id="ind_gral_calc<?php echo $i;?>" name="ind_gral"  class="w3-input war" type="text" style="width:75px"  readonly></td>
           <td><input id="cumplimiento<?php echo $i;?>" name="cumplimiento" style="width:75px"  class="w3-input war" type="text"  readonly></td>
           <td><textarea id="justificacion<?php echo $i;?>" onkeydown="EnterToTab(<?php echo $i?>)"  class="w3-input war" style="width:75px" ></textarea></td>
           <td><textarea id="plan_acc<?php echo $i;?>"   class="w3-input war" style="width:75px" ></textarea></td>
             </tr> 	
      <?php $i++;}
             

     }
              ?>
      </tbody>
      

                  
        </table>

   </div>
   
<script>
function calculo(valor){
	num=valor;

	
	var x = document.getElementById('ind_cr'+num).value;
	var y = document.getElementById('ind_cl'+num).value;
	
	var z= document.getElementById('ans'+num).innerHTML;
	
    patron = "%";
    nuevoValor    = "";
    nuevaCadena = z.replace(patron, nuevoValor);
   
    patron1=",",
    nuevoValor1=".",
    nuevaCadena1=nuevaCadena.replace(patron1,nuevoValor1);
    
    //var b = parseFloat(nuevaCadena);
   
    
	var res = (x/100)*(y/100);
	var div=(x/100)/(nuevaCadena1/100);

	
    var general=res*100;
    var cumpli=div*100;


    var gen = general.toFixed(2);
    var cum = cumpli.toFixed(2);


      $('#ind_gral_calc'+num).val(gen);
      $('#cumplimiento'+num).val(cum);
    



}
</script>


<script>
function inserta_datos(diligenciados){
 

	diligenciados.forEach(function(entry) {

		    var servicio = document.getElementById('nombre_servicio'+entry).innerHTML;	
			var cliente = document.getElementById('cliente'+entry).innerHTML;
			var zona = document.getElementById('zona'+entry).innerHTML;
			var mes = document.getElementById('mes'+entry).innerHTML;
			var ans = document.getElementById('ans'+entry).innerHTML;    
			var ind_cr = document.getElementById('ind_cr'+entry).value;
			var ind_cl = document.getElementById('ind_cl'+entry).value;
			var ind_gral = document.getElementById('ind_gral_calc'+entry).value;    	
			var cumplimiento = document.getElementById('cumplimiento'+entry).value;
			var justificacion = document.getElementById('justificacion'+entry).value;
			var plan_acc = document.getElementById('plan_acc'+entry).value;
	    	var id_mes  = '<?php echo $mes; ?>';


	    	 realizaProceso(servicio,cliente,zona,mes,ans,ind_cr,ind_cl,ind_gral,cumplimiento,
	    			   justificacion,plan_acc,id_mes);
	        
				
			
		});  


}







function EnterToTab(i){
	  if (event.keyCode==13 || event.keyCode==9){
	    //event.keyCode=9;
           
      var fila = document.getElementById('fila'+i);
		  
      var ind_cr=document.getElementById("ind_cr"+i).value;
      var ind_cl=document.getElementById("ind_cl"+i).value;


      var ind_cr1 = document.getElementById('ind_cr'+i);
      var ind_cl1 = document.getElementById('ind_cl'+i);

     

      if(ind_cr != "" && ind_cl != ""){
          fila.setAttribute("style","width:75px;");

          }
      
      if(ind_cr == "" && ind_cl==""){

          ind_cr1.setAttribute("style","box-shadow: 0 0 5px rgba(255,0,0,1);border:1px solid rgba(255,0,0,0.8);width:75px;");
          ind_cl1.setAttribute("style","box-shadow: 0 0 5px rgba(255,0,0,1);border:1px solid rgba(255,0,0,0.8);width:75px");
  
          return;
          }
      
      if(ind_cr == ""){

          ind_cr1.setAttribute("style","box-shadow: 0 0 5px rgba(255,0,0,1);border:1px solid rgba(255,0,0,0.8);width:75px;"); 
          ind_cl1.setAttribute("style","width:75px;");
    	  
          return;
          }


      if(ind_cl == ""){
          ind_cr1.setAttribute("style","width:75px;");
          ind_cl1.setAttribute("style","box-shadow: 0 0 5px rgba(255,0,0,1);border:1px solid rgba(255,0,0,0.8);width:75px");
 
       return;   
      }

      ind_cl1.setAttribute("style","width:75px;");
      
      ind_cr1.setAttribute("style","width:75px;");
     calculo(i);


        var ans = document.getElementById('ans'+i).innerHTML;    
		patron = "%";
		nuevoValor    = "";
		nuevaCadena_ans = ans.replace(patron, nuevoValor);

		patron_com= ",";
		nuevo_val=".";	
		nueva_cadena_ans_acor=nuevaCadena_ans.replace(patron_com,nuevo_val);
		
		 var cumplimiento = document.getElementById('cumplimiento'+i).value;
		 patron1=",",
		 nuevoValor1=".",
		 nuevaCadena_cumplimiento=cumplimiento.replace(patron1,nuevoValor1);



     var justificacion = document.getElementById('justificacion'+i);
	 var justificacion_valor = document.getElementById('justificacion'+i).value;



	 if(nuevaCadena_cumplimiento <= 100 && nuevaCadena_cumplimiento > 0.00){
	
		 						
		  	if((nueva_cadena_ans_acor > nuevaCadena_cumplimiento) && (justificacion_valor == "")){
		     // alert(cumplimiento+" cumplimiento");
		      //alert(nuevaCadena+" nueva cadena");						      
				justificacion.setAttribute("style","box-shadow: 0 0 5px rgba(255,0,0,1);border:1px solid rgba(255,0,0,0.8);width:75px;");

			  	   }else if ((nueva_cadena_ans_acor > nuevaCadena_cumplimiento) && (justificacion_valor != "")) {
			  		 justificacion.setAttribute("style","width:75px;");
			  		
				}
		  	}



     
	  }
	  
	    
	  }
	



function realizaProceso(servicio,cliente,zona,mes,ans,ind_cr,ind_cl,ind_gral,cumplimiento,
		   justificacion,plan_acc,id_mes) {
	
    var parametros = {
        "servicio": servicio,     
        "cliente": cliente,
        "zona": zona,
        "mes" : mes,
        "ans": ans,
        "ind_cr": ind_cr,
        "ind_cl": ind_cl,
        "ind_gral":ind_gral,
        "cumplimiento": cumplimiento,
        "justificacion": justificacion,
        "plan_acc":plan_acc,
        "id_mes": id_mes
    };
    $.ajax({
        data: parametros,
        url: 'pages/backend/includes/insertar_indicadores.php',
        type: 'post',
       
        success: function (response) {
            $("#resultado").html(response);
        	window.setTimeout('location.reload()');
        }
    });
}




</script>


<!-- script para filtrar en la busqueda de la tabla -->

<script>
 // Write on keyup event of keyword input element
 $(document).ready(function(){
 $("#txt_buscar").keyup(function(){
 _this = this;
 // Show only matching TR, hide rest of them
 $.each($("#indicadores_operacion tbody tr"), function() {
 if($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
 $(this).hide();
 else
 $(this).show();
 });
 });
});
</script>


<script>




$( "#indicadores_operacion" ).click(function() {

	 var num_rows=document.getElementById("indicadores_operacion").rows.length;

	  var diligenciados_clic = []; // contiene los ids de os que estan diligenciados
      var justi=[];
      
		for(i=1;i<num_rows;i++){

			var ind_cr = document.getElementById('ind_cr'+i).value;
		    var ind_cl = document.getElementById('ind_cl'+i).value;
			

			  if(ind_cr != '' && ind_cl != ''){
				  diligenciados_clic.push(i); //ingresamos los ids de las filas diligenciadas
				  }

		}




				diligenciados_clic.forEach(function(entry){
			
					var ind_cr1 = document.getElementById('ind_cr'+entry);
				    var ind_cl1 = document.getElementById('ind_cl'+entry);
				    ind_cr1.setAttribute("style","width:75px;");
				    ind_cl1.setAttribute("style","width:75px;");
					calculo(entry);
			
				    
					

					});



				diligenciados_clic.forEach(function(entry1){

					var ans = document.getElementById('ans'+entry1).innerHTML;    
					patron = "%";
					nuevoValor    = "";
					nuevaCadena_ans = ans.replace(patron, nuevoValor);

					patron_com= ",";
					nuevo_val=".";	
					nueva_cadena_ans_acor=nuevaCadena_ans.replace(patron_com,nuevo_val);
					
					 var cumplimiento = document.getElementById('cumplimiento'+entry1).value;
					 patron1=",",
					 nuevoValor1=".",
					 nuevaCadena_cumplimiento=cumplimiento.replace(patron1,nuevoValor1);


					 var indi_cr = document.getElementById('ind_cr'+entry1).value;
					 var indi_cl = document.getElementById('ind_cl'+entry1).value;
					 var indi_gral = document.getElementById('ind_gral_calc'+entry1).value;
					 
					 
					 var justificacion = document.getElementById('justificacion'+entry1);
					 var justificacion_valor = document.getElementById('justificacion'+entry1).value;
   

				     var fila = document.getElementById('fila'+entry1);
					 
	
					 if(nuevaCadena_cumplimiento <= 100 && nuevaCadena_cumplimiento > 0.00){
					
						 						
						  	if((nueva_cadena_ans_acor > nuevaCadena_cumplimiento) && (justificacion_valor == "")){
						     // alert(cumplimiento+" cumplimiento");
						      //alert(nuevaCadena+" nueva cadena");						      
								justificacion.setAttribute("style","box-shadow: 0 0 5px rgba(255,0,0,1);border:1px solid rgba(255,0,0,0.8);width:75px;");

							  	   }else if ((nueva_cadena_ans_acor > nuevaCadena_cumplimiento) && (justificacion_valor != "")) {
							  		 justificacion.setAttribute("style","width:75px;");
								}
						  	}

					  	
                    if((indi_cr != "") && (indi_cl != "") && (indi_gral != "") && (cumplimiento != "")){

   					 fila.setAttribute("style","width:75px;");
                 	

                        }



					 


					});


	
});




		



function verifica_datos() {


	 var num_rows=document.getElementById("indicadores_operacion").rows.length;
     //alert(num_rows);

		// num_rows=num_rows-1;

		
   aux=0;
   aux1=0;
   aux2=0;
   aux3=0;

   var servicios="";
   var cumplimiento="";
   var diligenciados = []; // contiene los que estan completos
   var mal_diligenciados=[]; //contiene los que estan incompletos
   var diligenciados_justi=[]; //contiene los que estan completos y no tienen justificación
   var no_diligenciados=[]; //Valida si no se han diligenciado los campos d eningun 



	for(i=1;i<num_rows;i++){
		var x = document.getElementById("ind_cr"+(i)).type;

		if(x == "number"){
         aux=aux+1;  // numero de filas editables en la tabla
         
		}// fin if


	}




   
	for(i=1;i<num_rows;i++){
		var x = document.getElementById("ind_cr"+(i)).type;

		if(x == "number"){
	
			 
		var servicio = document.getElementById('nombre_servicio'+i).innerHTML;	  
	  	var cliente = document.getElementById('cliente'+i).innerHTML;
	  	var zona = document.getElementById('zona'+i).innerHTML;
	  	var mes = document.getElementById('mes'+i).innerHTML;
	  	var ans = document.getElementById('ans'+i).innerHTML;    
	  	var ind_cr = document.getElementById('ind_cr'+i).value;
	    var ind_cl = document.getElementById('ind_cl'+i).value;
	  	var ind_gral = document.getElementById('ind_gral_calc'+i).value;    	
	  	var cumplimiento = document.getElementById('cumplimiento'+i).value;
	  	var justificacion = document.getElementById('justificacion'+i).value;
	  	var plan_acc = document.getElementById('plan_acc'+i).value;


	  	
       if(ind_cr == '' && ind_cl == '' && ind_gral == '' && cumplimiento == ''){
       
    	   no_diligenciados.push(i);
               
        }


        if(ind_cr != '' && ind_cl=='' && ind_gral == '' && cumplimiento == '' ){

    	   mal_diligenciados.push(i);

        }else if (ind_cr == '' && ind_cl != '' && ind_gral == '' && cumplimiento == '') {
     	   mal_diligenciados.push(i);
			
		}else if (ind_cr != '' && ind_cl != '' && ind_gral == '' && cumplimiento == '') {

	     	   mal_diligenciados.push(i);
				
		}else if (ind_cr == '' && ind_cl == '' && ind_gral != '' && cumplimiento != '') {

	     	   mal_diligenciados.push(i);
				
		}else if (ind_cr != '' && ind_cl == '' && ind_gral != '' && cumplimiento != '') {

	     	   mal_diligenciados.push(i);
				
		}else if (ind_cr == '' && ind_cl != '' && ind_gral != '' && cumplimiento != '') {

	     	   mal_diligenciados.push(i);
				
		}


		if(ind_cr != '' && ind_cl !='' && ind_gral != '' && cumplimiento != '' ){

			diligenciados.push(i);
			aux2=1;
			 
             }

		}

   }// fin for
		
      var tamano=mal_diligenciados.length;

	if(no_diligenciados.length==aux){
		alertify.alert('<b>No hay datos diliegenciados<br>Inténtalo de nuevo</b>');
        return;
	       }

	if(mal_diligenciados.length != 0){
		alertify.alert('<b>Hay datos <font color="red">mal diligenciados</font> o <font color="red">incompletos</font>,por favor verifica e intentalo de nuevo</b>');

	       
		mal_diligenciados.forEach(function(entry) {

			var fila = document.getElementById('fila'+entry);
			fila.setAttribute("style","box-shadow: 0 0 20px rgba(255,0,0,1);border:3px solid rgba(255,0,0,0.8);width:75px;");
		   
			}); 

		aux2=0;
		return;
	       }

    

    


	
  if(aux2 != 0){
	diligenciados.forEach(function(entry) {

		var fila1 = document.getElementById('fila'+entry);

		//fila1.setAttribute("style","box-shadow: 0 0 20px rgba(255,0,0,1);border:3px solid rgba(255,0,0,0.8);");
		

var servicio = document.getElementById('nombre_servicio'+entry).innerHTML;	
	var cliente = document.getElementById('cliente'+entry).innerHTML;
	var zona = document.getElementById('zona'+entry).innerHTML;
	var mes = document.getElementById('mes'+entry).innerHTML;
	var ans = document.getElementById('ans'+entry).innerHTML;    
	var ind_cr = document.getElementById('ind_cr'+entry).value;
	var ind_cl = document.getElementById('ind_cl'+entry).value;
	var ind_gral = document.getElementById('ind_gral_calc'+entry).value;    	
	var cumplimiento = document.getElementById('cumplimiento'+entry).value;
	var justificacion = document.getElementById('justificacion'+entry).value;
	var plan_acc = document.getElementById('plan_acc'+entry).value;

patron = "%";
nuevoValor    = "";
nuevaCadena = ans.replace(patron, nuevoValor);


if(cumplimiento < 100 && cumplimiento> 0.00){
  	if((cumplimiento < nuevaCadena) && (justificacion=='')){
       aux=1;
       diligenciados_justi.push(entry);
     // alert(cumplimiento+" cumplimiento");
      //alert(nuevaCadena+" nueva cadena");
      servicios=servicios+"<font color='red'><b>*"+cliente+"</b></font> --->"+servicio+".<br>";
  	   }
  	}
		
	
});  

	if(aux==1){
		alertify.alert('<P align=left>Los siguientes clientes <font color="red"><b>no cumplieron</b></font> con los indicadores mensuales en los sevicios establecidos, y es necesario dar una justificación adecuada:<br><br>'+servicios);

		diligenciados_justi.forEach(function(entry) { 
			var justificacion = document.getElementById('justificacion'+entry);
			justificacion.setAttribute("style","box-shadow: 0 0 5px rgba(255,0,0,1);border:1px solid rgba(255,0,0,0.8);width:75px;");
		        
		}); 
	

		}else{


			alertify.confirm( 'Desea registrar los datos actuales en los indicadores de operación?', function (e) {
			    if (e) {
			  
			    	//agregar_indicador();

			    	inserta_datos(diligenciados);
				    
			    } else {
			    	alertify.error('Cancelado');
			    }
			});  

			
			
			
		}
  }

	

	   
		
}






</script>
   
   <div><button id="guardar_indicadores" type="button" style="margin: 25px;" class="btn btn-primary" onclick="verifica_datos()">Guardar indicadores</button></div>
   
 <div id="resultado"></div>  
 
 
 
 	<style> 
 	
#guardar_indicadores{

background: -webkit-gradient( linear, left top, left bottom, color-stop(0.05, #006699), color-stop(1, #008FD6) );
} 	
	
.first-name {
	margin: 0 25px 25px;
	overflow: hidden;
	text-align: center;
	width: 500px;
	padding: 20px;
	background-color: #f0f8ff;
	-moz-box-shadow: 0px 0px 20px #000000;
	-webkit-box-shadow: 0px 0px 20px #000000;
	box-shadow: 0px 0px 20px #000000;
	}
	
	
	
.sticky {
  position: fixed;
  top: 0;
  width: 100%
}

/* Add some top padding to the page content to prevent sudden quick movement (as the header gets a new position at the top of the page (position:fixed and top:0) */
.sticky + .content {
  padding-top: 102px;
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

.w3-input {
    padding: 5px;
    display: block;
    border: none;
    border-bottom: 1px solid #ccc;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.27);
}



.datagrid  { border-collapse: collapse; text-align: left; width: 100%; } 
.datagrid {font: normal 12px/150% Arial, Helvetica, sans-serif; background: #fff; overflow: hidden; 
 -webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px; }
.datagrid td, .datagrid table th { padding: 3px 10px; }
.datagrid thead th {background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #006699), 
color-stop(1, #008FD6) );     font-style: italic;  height: 31px;background:-moz-linear-gradient( center top, #006699 5%, #008FD6 100% );
text-align:center;filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#006699', endColorstr='#008FD6');
background-color:#006699; color:#FFFFFF;font-size: 12px; font-weight: bold; border-left: 1px solid #0070A8; } 
.datagrid thead th:first-child { border: none; }
.datagrid tbody td {
color: #526d7b;  
  font-style: italic;
    border-left: 1px solid #E1EEF4;
    text-align: center;
    font-size: 14px;
    font-weight: normal;
        padding: 10px;
}

.demotbl {
    border: 0px solid #69899F;
    font-size: 11px;   
  }

.demotbl td{
    width:100px;
    padding:10px;
    text-align:center;
    vertical-align: top;
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
	   /* border: none; */
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

#guardar_indicadores{

background: -webkit-gradient( linear, left top, left bottom, color-stop(0.05, #006699), color-stop(1, #008FD6) );}

}

#guardar_indicadores:hover{
background: -webkit-gradient( linear, left top, left bottom, color-stop(0.05, #07496a), color-stop(1, #397999) );
}	
 </style>
