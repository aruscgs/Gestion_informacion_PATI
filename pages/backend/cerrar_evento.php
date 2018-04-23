<style>
/* Radio button */
.radiobtn {
	display: none;
}

.buttons {
	margin-left: -40px;
}

.buttons li {
	display: block;
}

.buttons li label {
	padding-left: 30px;
	position: relative;
	left: -25px;
}

.buttons li span {
	display: inline-block;
	position: relative;
	top: 5px;
	border: 2px solid #ccc;
	width: 18px;
	height: 18px;
	background: #fff;
}

.radiobtn:checked+span::before {
	content: '';
	border: 2px solid #fff;
	position: absolute;
	width: 14px;
	height: 14px;
	background-color: #c3e3fc;
}

button, input, optgroup, select, textarea {
    color: inherit;
    font: inherit;
    margin: 0;
    width: 140px;
}

button, input, optgroup, select, textarea {
    color: inherit;
    font: inherit;
    margin: 1px;
    width: 167px;
}

.btn-danger {
    background-color: #dd4b39;
    border-color: #d73925;
}

a {
    background: 0 0;
    color: white;
    text-decoration: none;
}
table {  color: #333; font-family: Helvetica, Arial, sans-serif; width: 600px; border-collapse: collapse;}

th {     font-size: 13px;     font-weight: normal;     padding: 8px;     background: #b9c9fe;
    border-top: 4px solid #aabcfe;    border-bottom: 1px solid #fff; color: #039; }

td {    padding: 8px;     background: #e8edff;     border-bottom: 1px solid #fff;
    color: #669;    border-top: 1px solid transparent; }

tr:hover td { background: #d0dafd; color: #339; }

.btn {
    display: inline-block;
    padding: 6px 12px;
    margin-bottom: 0;
    font-size: 14px;
    font-weight: 400;
    line-height: 1.42857143;
    text-align: -webkit-center;
    white-space: nowrap;
    vertical-align: middle;
    -ms-touch-action: manipulation;
    touch-action: manipulation;
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    background-image: none;
    border: 1px solid transparent;
    border-radius: 4px;
    width: 234px;
}


.callout {
    border-radius: -2px;
    margin: -46px -44px 61px 721px;
    padding: 15px 30px 15px 15px;
    border-left: 0px solid #EE9;
    margin-bottom: auto;
}

textarea {
   resize: none;
}
</style>
<?php


include ('../../modelo/conexion.php');
$con= new conexion();
$ids = $_GET['param_id'];

$algo=explode("-", $ids);


$id=$algo[0];
$mas=$algo[1];
$cedula=$algo[2];



if($mas=='ind'){


    $query=$con->conexion->query("select id,estado from incidentecop where id='$id'");
    $row=$query->fetch_assoc();

    if($row['estado']=='P'){
        ?>
         <button id='show' style="margin: 25px;" class="btn btn-success pull-left">Cerrar
					evento</button><br>


		<div class="callout">
								<h4>Importante!</h4>

									<b>Usar éste formulario únicamente para cerrar<br>eventos en estado "Pendiente" que ya se hayan
					solucionado</b>

							</div>
        <?php

        $id_evento=$row['id'];
    }

}else{
    $query=$con->conexion->query("SELECT distinct id_evento,estado FROM registro_masivo where id_evento='$id'");
    $row=$query->fetch_assoc();


    if($row['estado']=='P'){
        ?>

       <button id='show' style="margin: 25px;" class="btn btn-success pull-left">Cerrar
					evento</button><br>


		<div class="callout">
								<h4>Importante!</h4>

									<b>Usar éste formulario únicamente para cerrar<br>eventos en estado "Pendiente" que ya se hayan
					solucionado</b>

							</div>
        <?php


       $id_evento=$row['id_evento'];

    }

}

?>



<style>


td {
    text-align: left;
}

</style>

<div id="element" style="display: none;">


  <form name='formulario' id='formulario' action="" onSubmit="inserta_solucion(); return false" >

    <table id="tabla_cierre" >

    <tr>
    <td><label><B>ID DEL EVENTO:<B></label></td>
    <td><input type="text" readonly="readonly" value="<?php echo $id_evento?>" class="form-control" name="id_evento"></td>
    </tr>
     <tr>
     <td><label>NÚMERO DE TICKET:</label></td>
     <td><input type='text' class="form-control" name="ticket"></input></td>
     </tr>

         <tr>
     <td><label>TIPO:</label></td>
     <td><select required class="form-control" name="tipo">
     <option>Seleccione tipo</option>
       <option>Requerimiento</option>
       <option>incidente</option>
     </select></td>
     </tr>


        <tr>
     <td><label>HUBO CAMBIO:</label></td>
     <td>			<ul class="buttons">
					<li><input id="cambio_si" class="radiobtn"  name="rbtncambio" type="radio" value="si" tabindex="1"> <span></span>
					<label for="cambio_si" id="r1">Si</label>
					<input id="cambio_no" class="radiobtn" name="rbtncambio" type="radio" value="no" tabindex="2" > <span></span> <label for="cambio_no" id="r2">No</label><br>
						<label>NUM RFC</label> <input type="number" name="rfc" id="rfc"
						class="form-control" readonly name='rfc'></li>


				</ul></td>

     </tr>

     <?php
     setlocale (LC_TIME, 'es_ES.utf8','esp');
     date_default_timezone_set ('America/Bogota');
     $fecha=strftime("%Y-%m-%d %H:%M:%S");
     ?>




     <tr>
       <td><label>FECHA Y HORA DE CIERRE:</label></td>
       <td>     <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input id="fecha_fin" name="fecha_fin"  class="form-control" value="<?php echo $fecha;?>" required>
                    </div></td>
     </tr>

      <tr>
       <td><label>DETALLES:</label></td>
       <td><textarea name="detalles" class="form-control" required></textarea></td>
     </tr>

     <tr>

       <td> <div id="close"><button style="margin: 25px;" class="btn btn-danger pull-right" onclick="recarga()">Cancelar</button></div></td>
       <td>  <button type="submit" style="margin: 25px;" class="btn btn-success pull-right">Aceptar</button></td>
     </tr>


     </table>

   <input type="hidden" name='cedula' value="<?php echo $cedula?>">
   <input type="hidden" name='tipo_evento' value="<?php echo $mas?>">

   </form>

    </div>

    <div id='res'></div>


<script type="text/javascript">
$(document).ready(function(){
  $("#hide").click(function(){
    $("#element").hide();
  });
  $("#show").click(function(){
    $("#element").show();
  });
});
</script>


    <!--SCRIPT PARA HABILITAR Y DESHABLITAR-->
<script>
$("#cambio_si").on("click", function(){
  var x = document.getElementById("rfc");

  $('#rfc').removeAttr("readOnly");
});

$("#cambio_no").on("click", function(){
  var x = document.getElementById("rfc");

  $('#rfc').attr('readOnly','readOnly ');

});





function inserta_solucion()
{

	$.ajax({

		type:  'POST',

		url:   'pages/backend/includes/cierra_evento.php',

        data: $("#formulario").serialize(),
     	success: function (response) {
            $("#res").html(response);
            var res=document.getElementById('res').innerText;
            if(res=='false'){

               alert("El n�mero de ticket ingresado ya existe, int�ntalo nuevamente");
                }else{

                 alert('Evento cerrado correctamente');
                    }
        },
});

	window.setTimeout('location.reload()');
}


function recarga(){

	window.setTimeout('location.reload()');
}
</script>
