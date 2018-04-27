
<link rel="stylesheet" href="plugins/alertify.default.css">
<link rel="stylesheet" href="plugins/alertify.core.css">
<script src="plugins/alertify.min.js"></script>
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="plugins/jquery.table2excel.js"></script>



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

.demotbl td {
    width: 100px;
    padding: 10px;
    text-align: center;
    vertical-align: top;
    /* background-color: white; */
    -moz-border-radius: 2px;
    -webkit-border-radius: 2px;
    border-radius: 2px;
    color: #666;
    /* text-shadow: 1px 1px 1px #fff; */
}

b, strong {
    font-weight: 700;
    font-size: 13px;
    font-style: italic;
    /* text-align: center; */
}


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
}


#buscar{
    margin-left: 30px;
        padding: 7px;
}



#btnExport{
   cursor: pointer;
   line-height: 20px;
    width: 70px;
     margin-right: 130px;
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

.w3-input {
    padding: 5px;
    display: block;
    border: none;
    border-bottom: 1px solid #ccc;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.27);
}

#excel{
width: 500px;
height: 40px;
}
</style>



<?php
session_start ();
if ($_SESSION ['authenticated'] == 1) {
	include("../../modelo/conexion.php");
    $con=new conexion();


	//Obtiene el valor del radioboton que determina la manera de buesqueda del indicador
	$busqueda=$_POST['rbtnBusqueda'];

	$year=$_POST["years"];
	$month=$_POST["months"];
	$cedula=$_POST["cedula"];

	//$fecha_inicio=$_POST['fecha_ini'];
	//$fecha_fin=$_POST['fecha_fin'];


	//echo $busqueda." buesqueda <br>";
	//echo $cliente." Id cliente <br>";
	//echo $year." Id año <br>";
//	echo $month." Id mes <br>";

	$mes_actual = date("m");

	$ano_actual=date("Y");



	//echo $mes_actual;

	//echo $ano_actual."<br>";


	if($month<10){
	    $month="0".$month;
	}

//	echo $month." soy el mes escogido<br>";
	$mon=explode(".'-'.", $month);



//	echo $month." Id mes <br>";

	if($busqueda=='general'){

	    if($month==0 || $year==0){
	        echo "<script>

    		   alertify.alert('<b>LOS CAMPOS MES Y AÑO SON <BR><font color=\"red\">OBLIGATORIOS</font>');


              </script>";
	    }else{
	        $res=$con->conexion->query("select a.id,a.descripcion_servicio,a.cliente,a.zona,a.fecha,a.ans_acordado,
        a.indicador_cr,a.indicador_cl,a.indicador_general,a.cumplimiento,a.justificacion,a.plan_accion from
        indicador_operacion a,cliente b where a.cliente=b.cliente  and DATE_FORMAT(a.fecha, '%m')='$month'
        and DATE_FORMAT(a.fecha, '%Y')='$year'");

     $res1=$con->conexion->query("select a.descripcion_servicio,a.cliente,a.zona,a.fecha,a.ans_acordado,
        a.indicador_cr,a.indicador_cl,a.indicador_general,a.cumplimiento,a.justificacion,a.plan_accion from
        indicador_operacion a,cliente b where a.cliente=b.cliente  and DATE_FORMAT(a.fecha, '%m')='$month'
        and DATE_FORMAT(a.fecha, '%Y')='$year'");

     $result=$res1->fetch_assoc();

     if($result["descripcion_servicio"]==""){

         echo "<script>

    		   alertify.alert('<b>NO HAY DATOS PARA MOSTRAR');
	            document.getElementById('Guardar_cambios').style.display = 'none';


              </script>";

     }else{


	        echo "<script>

	        document.getElementById('div_table_indicadores').style.display = 'block';


	        </script>";
	        }
	    }



	}elseif($busqueda=='cliente'){
	    $cliente=$_POST['clientes'];




	    if($month==0 || $year==0 || $cliente==""){
	        echo "<script>

    		   alertify.alert('<b>TODOS LOS CAMPOS SON <BR><font color=\"red\">OBLIGATORIOS</font>');


                  </script>";
	    }else{

	        $res=$con->conexion->query("select a.id, a.descripcion_servicio,a.cliente,a.zona,a.fecha,a.ans_acordado,
        a.indicador_cr,a.indicador_cl,a.indicador_general,a.cumplimiento,a.justificacion,a.plan_accion from
        indicador_operacion a,cliente b where a.cliente=b.cliente and b.id_cliente='$cliente'  and DATE_FORMAT(a.fecha, '%m')='$month'
        and DATE_FORMAT(a.fecha, '%Y')='$year'");

	        $res1=$con->conexion->query("select a.descripcion_servicio,a.cliente,a.zona,a.fecha,a.ans_acordado,
        a.indicador_cr,a.indicador_cl,a.indicador_general,a.cumplimiento,a.justificacion,a.plan_accion from
        indicador_operacion a,cliente b where a.cliente=b.cliente and b.id_cliente='$cliente'  and DATE_FORMAT(a.fecha, '%m')='$month'
        and DATE_FORMAT(a.fecha, '%Y')='$year'");

	        $result=$res1->fetch_assoc();

	        if($result["descripcion_servicio"]==""){

	            echo "<script>
	            document.getElementById('Guardar_cambios').style.display = 'none';
    		   alertify.alert('<b>NO HAY DATOS PARA MOSTRAR');


              </script>";

	        }else{


	            echo "<script>

	        document.getElementById('div_table_indicadores').style.display = 'block';

	        </script>";

	        }
	       //echo $result["descripcion_servicio"];


	     //       }
	    }



	}else{

	   echo "<script> alertify.alert('<b>TODOS LOS CAMPOS SON<BR><font color=\"red\">OBLIGATORIOS</font>'); </script>";


	}



/*	if ($busqueda=='general'){

		$res=$con->conexion->query("select descripcion_servicio,cliente,zona,fecha,ans_acordado,
       indicador_cr,indicador_cl,indicador_general,cumplimiento,justificacion,plan_accion from indicador_operacion where
       fecha BETWEEN '$fecha_inicio' and '$fecha_fin' order by fecha");

	}else{
		$cliente=$_POST['clientes'];

		$res=$con->conexion->query("select a.descripcion_servicio,a.cliente,a.zona,a.fecha,a.ans_acordado,
        a.indicador_cr,a.indicador_cl,a.indicador_general,a.cumplimiento,a.justificacion,a.plan_accion from
        indicador_operacion a,cliente b where a.cliente=b.cliente and b.id_cliente=$cliente and
        a.fecha BETWEEN '$fecha_inicio' and '$fecha_fin'");
	}
	*/

}
?>



 <body>

 <div id="div_table_indicadores"  style="display:none; width: 101.5%; height:280px; overflow-y: scroll;">


<table id="indicadores_operacion"  class="demotbl">
        <thead>
          <tr id="tbl_titulo">

           <th><b>DESCRIPCIÓN NIVEL SERVICIO</b></th>
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
            <th style="visibility: hidden"><b>ID INDICADOR</b></th>

          </tr>
        </thead>
        <?php

        $fecha=$con->conexion->query("select editar,f_inicio,f_fin,mes_de_permiso,ano_permiso from permiso_indicador where cedula='$cedula'");

        $fecha_permiso=$fecha->fetch_assoc();

        $f_inicio=$fecha_permiso["f_inicio"];
        $f_fin=$fecha_permiso["f_fin"];
        $hoy1 =date("Y-m-d");

        if($hoy1 > $f_fin){


            $con->cambia_estado_editar_indicador($cedula);

            $estado_editar=$con->conexion->query("select editar from permiso_indicador where cedula='$cedula'");
            $est_edit=$estado_editar->fetch_assoc();
            $estado_edit= $est_edit["editar"];
        }else{

            $estado_editar=$con->conexion->query("select editar from permiso_indicador where cedula='$cedula'");
            $est_edit=$estado_editar->fetch_assoc();
            $estado_edit= $est_edit["editar"];
        }

        $edit=$fecha_permiso["editar"];

      /*  if($hoy < $f_inicio && $hoy > $f_fin){


        }*/

        $mes_permiso=$fecha_permiso["mes_de_permiso"];

        if($mes_permiso>0 && $mes_permiso<10){
            $mes_permiso="0".$mes_permiso;
        }

        $ano_permiso=$fecha_permiso["ano_permiso"];



        $hoy =date("Y-m-d");


        $i=0; while($indi=$res->fetch_assoc()){






        	$nombre_mes = $indi['fecha'];
$mes = explode ('-',$nombre_mes);



//echo $mes[0];  //este valor sera "año"
//echo $mes[1];  //este valor sera "mes"
//echo $mes[2];  //este valor sera "dia"



$m=convertir_num($mes[0]);


//realizamos consulta para tomar el nombre del mes segun el id
$mes_nom=$con->conexion->query("select descripcion from mes where id_mes='$m'");

$nom_mes=$mes_nom->fetch_assoc();



?>

               <tbody>
        	<tr id="fila<?php echo $i+1?>"  >

        <?php



        if($hoy>=$f_inicio && $hoy<= $f_fin){

            if($mon[0]==$mes_permiso && $year==$ano_permiso && $estado_edit != '0'){


            //$ind_cr = str_replace(".", ",", $indi['indicador_cr']);
            //$ind_cl = str_replace(".", ",", $indi['indicador_cl']);
            $ind_gral = str_replace(".", ",", $indi['indicador_general']);
            $cumplimiento = str_replace(".", ",", $indi['cumplimiento']);

            ?>

        	   <td><label title="<?php echo $indi["id"]?>" id="nombre_servicio<?php echo $i;?>"><?php echo $indi['descripcion_servicio']?></label></td>
        	   <td><label id="cliente<?php echo $i;?>"><?php echo $indi['cliente']?></label></td>
        	   <td><label id="zona<?php echo $i;?>"><?php echo $indi['zona']?></label></td>
        	   <td><label id="mes<?php echo $i;?>"><?php echo $mon[1]." ".$mes[0]?></label></td>
        	   <td><input id="ans<?php echo $i;?>" name="ans<?php echo $indi['ans_acordado']?>" class="w3-input war"
        	    type="text" value="<?php echo $indi['ans_acordado']?>" style="width:75px" readonly></td>
        	   <td><input id="indi_cr<?php echo $i?>" onkeydown="EnterToTab(<?php echo $i+1?>)" style="width:75px" class="w3-input war"  type="number" value="<?php echo $indi['indicador_cr']?>"></td>
        	   <td><input id="indi_cl<?php echo $i?>" onkeydown="EnterToTab(<?php echo $i+1?>)" style="width:75px" class="w3-input war" type="number" value="<?php echo $indi['indicador_cl']?>"></td>
               <td><input id="ind_gral<?php echo $i;?>" name="ind_gral"
               value="<?php echo $ind_gral?>" class="w3-input war" type="text" style="width:75px"  readonly></td>
               <td><input id="cumplimiento<?php echo $i;?>" name="cumplimiento"  class="w3-input war"
               value="<?php echo $cumplimiento?>" type="text" style="width:75px" readonly></td>
        	   <td><textarea id="justificacion<?php echo $i?>"  class="w3-input war" ><?php echo $indi['justificacion']?></textarea></td>
        	   <td><textarea id="plan_accion<?php echo $i?>"  class="w3-input war" ><?php echo $indi['plan_accion']?></textarea></td>
               <td><label style="display:none;" id="id_indicador<?php echo $i?>" ><?php echo $indi["id"]?></label></td>



          <?php $i=$i+1;
             echo("<script> $('#btnExport').hide();</script>");
            }else{
                echo("<script> $('#Guardar_cambios').attr('disabled', true);</script>");

                $ind_cr = str_replace(".", ",", $indi['indicador_cr']);
                $ind_cl = str_replace(".", ",", $indi['indicador_cl']);
                $ind_gral = str_replace(".", ",", $indi['indicador_general']);
                $cumplimiento = str_replace(".", ",", $indi['cumplimiento']);
                ?>

               <td><?php echo $indi['descripcion_servicio']?></td>
        	   <td><?php echo $indi['cliente']?></td>
        	   <td><?php echo $indi['zona']?></td>
        	   <td><?php echo $mon[1]." ".$mes[0]?></td>
        	   <td><?php echo $indi['ans_acordado']?></td>
        	   <td><?php echo $ind_cr."%"?></td>
        	   <td><?php echo $ind_cl."%"?></td>
        	   <td><?php echo $ind_gral."%"?></td>
        	   <td><?php echo $cumplimiento."%"?></td>
        	   <td><?php echo $indi['justificacion']?></td>
        	   <td><?php echo $indi['plan_accion']?></td>

           <?php  }




            }else { echo("<script> $('#Guardar_cambios').attr('disabled', true);</script>");

            $ind_cr = str_replace(".", ",", $indi['indicador_cr']);
            $ind_cl = str_replace(".", ",", $indi['indicador_cl']);
            $ind_gral = str_replace(".", ",", $indi['indicador_general']);
            $cumplimiento = str_replace(".", ",", $indi['cumplimiento']);

            ?>


        	   <td><?php echo $indi['descripcion_servicio']?></td>
        	   <td><?php echo $indi['cliente']?></td>
        	   <td><?php echo $indi['zona']?></td>
        	   <td><?php echo $mon[1]." ".$mes[0]?></td>
        	   <td><?php echo $indi['ans_acordado']?></td>
        	   <td><?php echo $ind_cr."%"?></td>
        	   <td><?php echo $ind_cl."%"?></td>
        	   <td><?php echo $ind_gral."%"?></td>
        	   <td><?php echo $cumplimiento."%"?></td>
        	   <td><?php echo $indi['justificacion']?></td>
        	   <td><?php echo $indi['plan_accion']?></td>

          <?php }
          ?>

        	</tr>


        <?php }?>



      </tbody>




             	<div class="excel">
        <div class="search">

<input type="text" id="txt_buscar" class="form-control input-sm" maxlength="64" placeholder="Buscar..." />
 <button type="submit" id="btn_search" class="btn btn-primary btn-sm">Buscar</button>

</div>
       <button id="btnExport" class="btn btn-primary pull-left" img	><img src="dist/img/excel.png" /></button>

	</div>
        <br>
      <br>
      <br>





        </table>


        <br>


   </div>
    <br><br><button id="Guardar_cambios" class="btn btn-primary" onclick="actualiza_datos()">Guardar cambios</button>
   </body>

<script>


$("#btnExport").click(function(){
	  $("#indicadores_operacion").table2excel({
	    filename: "Indicadores de Operación"
	  });
	});



    /*function exportexcel() {
        $("#indicadores_operacion").table2excel({
            name: "Table2Excel",
            filename: "myFileName",
            fileext: ".xls"
        });
    } */

</script>

<?php
function convertir_num($num){



    $cadena = $num;

    //$nueva_cadena = ereg_replace("[0]", "", $cadena);
    $resultado = str_replace("0", "", $cadena);


    //return $nueva_cadena;
    return $resultado;
}
?>



<script>
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


 function calculo(valor){
 	num=valor;

    var auxiliar=num-1;

 	var x = document.getElementById('indi_cr'+auxiliar).value;
 	var y = document.getElementById('indi_cl'+auxiliar).value;
 	var z= document.getElementById('ans'+auxiliar).value;

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


       $('#ind_gral'+auxiliar).val(gen);
       $('#cumplimiento'+auxiliar).val(cum);

 	//$('#ind_gral'+num).val(res*100);
 	//$('#cumplimiento'+num).val(div_n*100);
 	//$('#ind_gral'+num).val(res/100+"%"); //pone el resultado en el input
 	//$('#cumplimiento'+num).val(div*100); //pone el resultado en el input


 }


 function actualiza_datos(){

	 var num_rows=document.getElementById("indicadores_operacion").rows.length;
	 num_rows=num_rows-1;
		//alert(num_rows);
		//var num_cols=11;
	 // document.write(num_rows);

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



	for(i=0;i<num_rows;i++){

		var x = document.getElementById("indi_cr"+(i)).type;

		if(x == "number"){
         aux=aux+1;  // numero de filas editables en la tabla

		}

}





	for(i=0;i<num_rows;i++){
		var x = document.getElementById("indi_cr"+(i)).type;

		if(x == "number"){


		var servicio = document.getElementById('nombre_servicio'+i).innerHTML;
	  	var cliente = document.getElementById('cliente'+i).innerHTML;
	  	var zona = document.getElementById('zona'+i).innerHTML;
	  	var mes = document.getElementById('mes'+i).innerHTML;
	  	var ans = document.getElementById('ans'+i).innerHTML;
	  	var ind_cr = document.getElementById('indi_cr'+i).value;
	    var ind_cl = document.getElementById('indi_cl'+i).value;
	  	var ind_gral = document.getElementById('ind_gral'+i).value;
	  	var cumplimiento = document.getElementById('cumplimiento'+i).value;
	  	var justificacion = document.getElementById('justificacion'+i).value;
	  	var plan_acc = document.getElementById('plan_accion'+i).value;



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

   }


	  var tamano=mal_diligenciados.length;

		if(no_diligenciados.length==aux){
			alertify.alert('<b>No hay datos diliegenciados<br>Inténtalo de nuevo</b>');
	        return;
		       }




		if(mal_diligenciados.length != 0){
			alertify.alert('<b>Hay datos <font color="red">mal diligenciados</font> o <font color="red">incompletos</font>,por favor verifica e intentalo de nuevo</b>');


			mal_diligenciados.forEach(function(entry) {
				var fila = document.getElementById('fila'+(entry+1));
				fila.setAttribute("style","box-shadow: 0 0 20px rgba(255,0,0,1);border:3px solid rgba(255,0,0,0.8);width:75px;");

				});

			aux2=0;
			return;
		       }







		  if(aux2 != 0){
			diligenciados.forEach(function(entry) {

		    var servicio = document.getElementById('nombre_servicio'+entry).innerHTML;
			var cliente = document.getElementById('cliente'+entry).innerHTML;
			var zona = document.getElementById('zona'+entry).innerHTML;
			var mes = document.getElementById('mes'+entry).innerHTML;
			var ans = document.getElementById('ans'+entry).value;
			var ind_cr = document.getElementById('indi_cr'+entry).value;
			var ind_cl = document.getElementById('indi_cl'+entry).value;
			var ind_gral = document.getElementById('ind_gral'+entry).value;
			var cumplimiento = document.getElementById('cumplimiento'+entry).value;
			var justificacion = document.getElementById('justificacion'+entry).value;
			var plan_acc = document.getElementById('plan_accion'+entry).value;

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

					    	actualiza_indicadores();

					    } else {
					    	alertify.error('Cancelado');
					    }
					});




				}
		  }


















/*

	for(i=0;i<num_rows;i++){
		 //document.write(num_rows);
   	var servicio = document.getElementById('nombre_servicio'+(i)).innerHTML;
   	//alert(servicio);
   	var cliente = document.getElementById('cliente'+i).innerHTML;
   	var zona = document.getElementById('zona'+i).innerHTML;
   	var mes = document.getElementById('mes'+i).innerHTML;
   	var ans = document.getElementById('ans'+i).value;
   	var ind_cr = document.getElementById('indi_cr'+i).value;
   	var ind_cl = document.getElementById('indi_cl'+i).value;
   	var ind_gral = document.getElementById('ind_gral'+i).value;
   	var cumplimiento = document.getElementById('cumplimiento'+i).value;
	var justificacion = document.getElementById('justificacion'+i).value;
   	var plan_acc = document.getElementById('plan_accion'+i).value;

  // 	alert(cumplimiento +" cumplimiento");
  //  alert(ans + "ans");
  //  alert(justificacion + "just");

    patron = "%";
    nuevoValor    = "";
    nuevaCadena = ans.replace(patron, nuevoValor);
    //alert(nuevaCadena);

   	if((cumplimiento < nuevaCadena) && (justificacion=='')){
       //alert(servicio);
        aux=1;

       servicios=servicios+"<font color='red'><b>*"+cliente+"</b></font> --->"+servicio+".<br>";



   	   	}


}

if(aux==1){
alertify.alert('<P align=left>Los siguientes clientes <font color="red"><b>no cumplieron</b></font> con los indicadores mensuales en los sevicios establecidos, y es necesario dar una justificación adecuada:<br><br>'+servicios);
}else{


	alertify.confirm( 'Desea gardar los datos actuales en los indicadores de operación?', function (e) {
	    if (e) {

	    	actualiza_indicadores();

	    } else {
	    	alertify.error('Cancelado');
	    }
	});




}*/

//muestra_modal(servicios);



}




 function actualiza_indicadores() {

	 var num_rows=document.getElementById("indicadores_operacion").rows.length;
	 num_rows=num_rows-1;
		//alert(num_rows);
		//var num_cols=11;
	 // document.write(num_rows);

    aux=0;
	for(i=0;i<num_rows;i++){
		 //document.write(num_rows);
	var id = document.getElementById('id_indicador'+(i)).innerHTML;

   	var ind_cr = document.getElementById('indi_cr'+i).value;
   	var ind_cl = document.getElementById('indi_cl'+i).value;
   	var ind_gral = document.getElementById('ind_gral'+i).value;
   	var cumplimiento = document.getElementById('cumplimiento'+i).value;
	var justificacion = document.getElementById('justificacion'+i).value;
   	var plan_acc = document.getElementById('plan_accion'+i).value;


   /* patron = ".";
    nuevoValor    = ",";
    nuevaCadena_indi_cr = ind_cr.replace(patron, nuevoValor);

    patron1 = ".";
    nuevoValor1    = ",";
    nuevaCadena1_indi_cl = ind_cl.replace(patron1, nuevoValor1);


    patron2 = ".";
    nuevoValor2    = ",";
    nuevaCadena2_indi_gral = ind_gral.replace(patron2, nuevoValor2);

    patron3 = ".";
    nuevoValor3    = ",";
    nuevaCadena3_cumpli = cumplimiento.replace(patron3, nuevoValor3);*/




	          var parametros = {
	                "id": id,
	                "ind_cr": ind_cr,
	                "ind_cl": ind_cl,
	                "ind_gral" : ind_gral,
	                "cumplimiento": cumplimiento,
	                "justificacion": justificacion,
	                "plan_acc": plan_acc

	            };
	            $.ajax({
	                data: parametros,
	                url: 'pages/backend/actualiza_indicadores.php',
	                type: 'post',

	                success: function (response) {
	                    //$("#resultado").html(response);


	                    }
	            });


}

	  alertify.alert('<b>Registros actualizados correctamente');
	  setTimeout('document.location.reload()',5000);


}






 function EnterToTab(i){
 	 if (event.keyCode==13 || event.keyCode==9){

	 var num_fila=(i);
     var fila = document.getElementById('fila'+i);
	 var auxiliar=i-1;
	    //event.keyCode=9;


     var ind_cr=document.getElementById("indi_cr"+auxiliar).value;
     var ind_cl=document.getElementById("indi_cl"+auxiliar).value;


     var ind_cr1 = document.getElementById('indi_cr'+auxiliar);
     var ind_cl1 = document.getElementById('indi_cl'+auxiliar);


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

	  }


	  }


</script>



<div class="modal fade" id="mostrarmodal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h3>Cabecera de la ventana</h3>
     </div>
         <div class="modal-body">
            <h4>Texto de la ventana</h4>
            Mas texto en la ventana.
     </div>
         <div class="modal-footer">
        <a href="#" data-dismiss="modal" class="btn btn-danger">Cerrar</a>
     </div>
      </div>
   </div>
</div>
