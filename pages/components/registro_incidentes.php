<link rel="stylesheet" href="plugins/select2/select2.min.css"/>
<link rel="stylesheet" href="plugins/multiselect/multipleSelect.css">

<link rel="stylesheet" href="plugins/alertify.default.css">
<link rel="stylesheet" href="plugins/alertify.core.css">
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="plugins/alertify.min.js"></script>


<?php

if(!isset($_POST['id_detalle']))
{
	echo "<script> alert('no hay valores') </script>";
}

setlocale (LC_TIME, 'es_ES.utf8','esp');
date_default_timezone_set ('America/Bogota');
$fecha=strftime("%Y-%m-%d %H:%M:%S");


$oe = new conexion();
$usuario = new UserInfo();
$id_detalle = $_POST['id_detalle'];
$cont = $_POST['contrato'];
$id_persona=$_POST['otro'];


//echo $cont;

// Aprovechar el ID DETALLE para sacar el HOST y la IP Para el envío del correo







$conn = $oe->conexion->query("select a.id_detalle, b.nombre, b.ip, b.id as id_host, c.tipo, c.id as id_tipo from detalle_servicio a, hosts b, tipo_servicios c where
a.id_host=b.id and a.id_tipo_servicio=c.id and id_detalle='$id_detalle'");

$num_evento = $oe->conexion->query("SELECT (max(id)+1) as Numero_de_evento FROM incidentecop");
$query=$oe->conexion->query("select nombre, correo from new_personas where cedula=$id_persona");



$evento = $num_evento->fetch_assoc();
$row = $conn->fetch_assoc();
$info=$query->fetch_assoc();


$nombre_respon=$info["nombre"];
$aux=0;

$cadena_de_texto = $nombre_respon;
$cadena_buscada   = 'Disponible';
$posicion_coincidencia = strpos($cadena_de_texto, $cadena_buscada);

//se puede hacer la comparacion con 'false' o 'true' y los comparadores '===' o '!=='
if ($posicion_coincidencia === false) {
$aux=0;
} else {

$aux=1;
}

?>

<style>
.btn-success{
background: -webkit-gradient( linear, left top, left bottom, color-stop(0.05, #25a068), color-stop(1, #00cc0b) );
}

.btn-success:hover{
	background: -webkit-gradient( linear, left top, left bottom, color-stop(0.05, #408163), color-stop(1, #18a11f) );
}

.btn-danger{
			background: -webkit-gradient( linear, left top, left bottom, color-stop(0.05, #b70e0e), color-stop(1, #d26060) );
	    border-color: #d73925;
}
.btn-danger:hover{
	background: -webkit-gradient( linear, left top, left bottom, color-stop(0.05, #8f0b0b), color-stop(1, #8f5151) );
	border-color: #861709;
}
.btn-primary{
	background: -webkit-gradient( linear, left top, left bottom, color-stop(0.05, #006699), color-stop(1, #008FD6) );
}
.btn-primary:hover{
	background: -webkit-gradient( linear, left top, left bottom, color-stop(0.05, #07496a), color-stop(1, #397999) );
}

.select2-container--default .select2-selection--single {
	border-radius: 0;
	border-color: #d2d6de;
	width: 100%;
	height: 34px;
}


.input__row{
 margin-top: 10px;
}
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
.buttons li label{
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
.radiobtn:checked + span::before{
 content: '';
 border: 2px solid #fff;
 position: absolute;
 width: 14px;
 height: 14px;
 background-color: #c3e3fc;
}

	#event
{
	font-size: 20px;
	padding: 1px 15px;
	color: blue;
	text-align: right;
	font-family: calibri;
}
</style>

<div class="box box-info">
    <div class="box-body">
        <h3 class="box-title">Registro</h3>
        <!-- Barra de progreso -->
        <div class="progress progress-sm active">
            <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 95%">
            </div>
        </div>

        <p id="event"><strong>Evento: </strong><?php echo $evento['Numero_de_evento'];?></p>


        <form method="post" action="pages/backend/nuevo_incidente.php">
            <div class="col-md-23">

				    <!--ENVIAMOS EL NOMBRE DEL CONTRATO OCULTO -->
                <input name="aux" type="hidden"  id="aux" value="<?php echo $aux;?>">

                <input name="contrato" type="hidden"  value="<?php echo $cont;?>">
				<input name="nombre_host" type="hidden"  value="<?php echo $row['nombre'];?>" class="form-control" required>
				<input name="ip" type="hidden"  value="<?php echo $row['ip'];?>" class="form-control" required>
				<input name="id_evento" type=hidden  value="<?php echo $evento['Numero_de_evento'];?>" class="form-control" required>
				<input name="id_host" type="hidden"  value="<?php echo $row['id_host'];?>" class="form-control" required>
               <input name="reporta" type="hidden" id="txtEstado" value="<?php echo $userinfo->user_name = $_SESSION['user_id'];?>" class="form-control" required>

                <div class="col-md-6">
                    <div class="form-group">

					<label >Servicio afectado</label>
					<input class="form-control" value="<?php echo $row['tipo'];?>" readonly required>
        			<input type="hidden" name="servicio" class="form-control" value="<?php echo $row['id_tipo'];?>" readonly required>


		 <input type="hidden" name="nomservicio" class="form-control" value="<?php echo $row['tipo'];?>" readonly required>

				<label>Tipo de evento</label>
                        <select id="evento" required name="evento" class="form-control"  style="width: 100%;">
                    	<option disabled selected ></option>
                            <option>Warning</option>
                            <option>Critical</option>
                        </select>

                        <label>Causa del evento</label>
                        <select id="causa_evento" required name="causa_evento" class="form-control"  style="width: 100%;" >
                    	<option disabled selected ></option>
                            <option>Disponibilidad</option>
                            <option>Capacidad</option>
                        </select>

                        <label>Minutos de actividad</label>
                        <input type="number" name="hrs_actividad" id="txtHoraActividad" class="form-control" value="0" required readonly>

                        <label>Tipo de actividad</label>
                        <div class="input__row">
                       <ul class="buttons">
						   <li>
						     <input id="radiobtn_1" class="radiobtn" name="tipo_actividad" type="radio" value="Programada" tabindex="1" required>
						     <span></span>
						     <label for="radiobtn_1" id="r1" >Programada</label>
						     </li>
						     <li>
						     <input id="radiobtn_2" class="radiobtn" name="tipo_actividad" type="radio" value="No programada" tabindex="2" required>
						     <span></span>
						     <label for="radiobtn_2" id="r2">No programada</label>
						   </li>
						 </ul>
						</div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">


                    <label>Mesa</label>
                    <select name="mesa"  class="form-control" required  style="width: 100%;">
                    	<option disabled selected ></option>
                    	<option value="marco@arus.com.co">Marco</option>
                    	<option value="servicios@gco.com.co">Servicio GCO</option>
                        <option value="mas@celsia.com">Mas - Celsia</option>
                        <option value="helpdesk@ultraserfinco.com">Help desk - Serfinco</option>
                        <option value="cielo.figueroa@arus.com.co">Cielo figueroa - GDO</option>
                        <option value="CA_CSM_PROCAPS@mail-prod3.serviceaide.com">CSM Procaps - Requerimientos</option>
                        <option value="CA_CSM_PROCAPS-INC@mail-prod3.serviceaide.com">CSM Procaps - Incidentes</option>
                        <option value="soportecnicoempresarial@tigoune.com">Soporte técnico - Confiar</option>
                        <option value="sos@grupoargos.com">SOS - Argos</option>
                        <option value="soporteit@continentalgold.com">Soporte IT - Continental</option>
                        <option value="maya@acuacar.com">CSM - Acuacar</option>
                        <option value="N/A">Otro</option>
                   </select>


                    <label>Responsable</label>
                    <input  name="corresponsable" value="<?php echo $info['nombre'];?>" id="txtResponsable" class="form-control" readonly>

                  <!-- correo del grupo -->
		        	<input  name="correo" type="hidden" value="<?php echo $info['correo'];?>" id="txtResponsable_correo" class="form-control" readonly>

                   <!-- correo del responsable -->
		        	<input type="hidden" name="correo_reponsable_diponible"  id="txtResponsable_correo_responsable" value="temporal" class="form-control" readonly>



                    <input type="hidden" name="idresponsable" value="<?php echo $id_persona;?>" id="txtResponsable" class="form-control" readonly>

                    <label>Persona que reporta</label><br>
                    <input name="nombre_reporta" value="<?php echo $userinfo->user_name = ucwords(strtolower($_SESSION['user_name']));?>" class="form-control" required readonly>


                    <label>Fecha y hora de inicio </label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input id="fecha_inicio" name="fecha_inicio"  class="form-control" value="<?php echo $fecha;?>" required>
                    </div>
                            <label> Observaciones </label>
                         <textarea class="form-control" name="observaciones"></textarea>

                </div>
            </div>
            <button type="submit" class="btn btn-success ">Registrar evento</button>
            <a href="index.php"><button type="button" class="btn btn-danger pull-right">Cancelar</button></a>
        </form>
    </div>
</div>









<div class="modal fade" id="mostrarmodal" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h3 style="text-align: center;">Elige el disponible actual del grupo seleccionado.</h3>

     </div>
         <div class="modal-body">

<?php

$responsables=$oe->conexion->query("select cedula,nombre,correo,celular
from new_personas where nombre not like '%disponible%' order by nombre asc");

?>

<label>Responsables:</label>


<input type="hidden" value="<?php echo $id_detalle?>" id="id_detalle">

      <select class="form-control" id="respo_disponible"  style="width: 100%;">

      <option disabled selected></option>
      <?php

      while($resultado=$responsables->fetch_assoc()){ ?>

         <option value="<?php echo $resultado["cedula"]."-".$resultado["correo"]?>"><?php echo $resultado["nombre"]?></option>


     <?php } ?>

      </select><br><br>

      <div>

           <button id="validar" onclick="valida()" class="btn btn-success pull-left">Asignar evento</button>
          <button  style="margin-left: 1%;" class="btn btn-danger" onclick="redireccionar();">Cerrar</button>


      </div>
           </div>
         <div class="modal-footer">


     </div>
      </div>
   </div>
</div>



<script>
//Script para Habilitar y Deshabilitar
$("#radiobtn_1").on("click", function(){
  var x = document.getElementById("txtHoraActividad");

  $('#txtHoraActividad').removeAttr("readOnly");
});

$("#radiobtn_2").on("click", function(){
  var x = document.getElementById("txtHoraActividad");

  $('#txtHoraActividad').attr('readOnly','readOnly ');
  $('#txtHoraActividad').val('0');
});




function redireccionar() {

	location.href='index.php?page=013';
}



function valida() {


	//cedula del responsable
	var responsable=document.getElementById("respo_disponible").value;
    //id detalle
	var id_detalle=document.getElementById("id_detalle").value;

	//correod el grupo
	var responsable_correo=document.getElementById("txtResponsable_correo").value;

	if(responsable == ""){
		alertify.alert('<b>Debes elegir un reponsable<br><font color="red">Inténtalo de nuevo</font></b>');
           return;
		}

 	$('#txtResponsable_correo_responsable').val(responsable);
 	//cierra modal
    $("#mostrarmodal").modal("hide");



}


$(document).ready(function()
	      {

              var aux=document.getElementById("aux").value;

             if(aux == '1'){
	        $("#mostrarmodal").modal("show");
             }

		      });




</script>


<script src="plugins/select2/select2.full.min.js"></script>
<script>

    $(function (){
    	$("select").select2();
     });



    </script>
