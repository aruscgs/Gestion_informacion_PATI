<link rel="stylesheet" href="plugins/select2/select2.min.css"/>
<link rel="stylesheet" href="plugins/alertify.default.css">
<link rel="stylesheet" href="plugins/alertify.core.css">
<script src="plugins/alertify.min.js"></script>

<?php


$con=new conexion();

$tipo_dispo=$con->conexion->query("select * from tipo_dispositivo");

$horarios=$con->conexion->query("select * from horarios_operativos");

$res=$con->conexion->query("select b.admin_evento from new_usuario a, sub_grupo b
		where a.cedula=b.cedula and a.cedula='$userinfo->user_id'");

$cedula=$userinfo->user_id;


$log=$res->fetch_assoc();


if($log['admin_evento']=='1'){
?>

<style>
.btn-success{
background: -webkit-gradient( linear, left top, left bottom, color-stop(0.05, #25a068), color-stop(1, #00cc0b) );
margin-right:10px;
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
.scrollbar
{
	margin-left: 30px;
	float: left;
	height: 300px;
	width: 65px;
	background: #F5F5F5;
	overflow-y: scroll;
	margin-bottom: 25px;
}
.select2-container--default .select2-selection--single
{
	border-radius: 0;
    border-color: #d2d6de;
    width: 100%;
    height: 34px;
}
</style>

<script type="text/javascript">
	 $(document).ready(function(){
     $("#contra").load("pages/backend/includes/contrato.php");

     $("#contra").change(function (oe) {
    	 var id = $(this).val();

    	 //var opt = $('option[value="'+$(this).val()+'"]');
    	 //var id = opt.attr('id');
    	 $.get("pages/backend/includes/ci.php", { param_id: id}, function(data){
	     $("#ci").html(data);

	     //$("#tipo_ci").val();

      });
   })




           $("#ci").change(function () {

    	  var id = $(this).val();

         $.get("pages/backend/includes/nombre_ci.php", { info_id: id}, function(data){
         $("#nombre_ci").val(data);
       });
     })


      $("#ci").change(function () {

    	  var id = $(this).val();

         $.get("pages/backend/includes/ip.php", { info_id: id}, function(data){
         $("#ip").val(data);
       });
     })


/*
    $("#ci").change(function () {

    	  var id = $(this).val();
         $.get("pages/backend/includes/plataforma.php", { info_id: id}, function(data){
         $("#plataforma").val(data);
       });
     })

     $("#ci").change(function () {

    	  var id = $(this).val();
         $.get("pages/backend/includes/ambiente.php", { info_id: id}, function(data){
         $("#ambiente").val(data);
       });
     })

     $("#ci").change(function () {

    	  var id = $(this).val();
         $.get("pages/backend/includes/horario.php", { info_id: id}, function(data){
         $("#ho").val(data);
       });
     })*/

     $("#ci").change(function () {

    	  var id = $(this).val();
         $.get("pages/backend/includes/servicio_negocio.php", { info_id: id}, function(data){
         $("#sn").val(data);
       });
     })

     $("#ci").change(function () {

    	  var id = $(this).val();
         $.get("pages/backend/includes/servicio_administrado.php", { info_id: id}, function(data){
         $("#sa").val(data);
       });
     })

   });

</script>


 <div class="box box-default">
          <div class="box-header with-border">
              <!-- Barra de progreso -->
              <div class="progress progress-sm active">
                <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                </div>
              </div>

       <div class="box-body">
       <div class="row">



       <div class="col-md-6">
       <div class="form-group">

        <label>Contrato</label>
        <select id="contra" required name="contrato" class="form-control" style=" width: 100%;"></select>

        <label>Selecciona CI <font color="red"> *</font></label>
        <select id="ci" required name="ci" class="form-control"  style=" width: 100%;"></select>

        <label>Nombre CI <font color="RED"> *</font></label>
        <input id="nombre_ci" class="form-control" name="nom_ci" style="width: 100%;"  required>

        <label>IP <font color="RED"> *</font></label>
        <input id="ip" class="form-control" name="ip" style="width: 100%;"  required>


        <label>Servicio Negocio </label><br>
        <input type="text" id="sn" name="sn" class="form-control"  style="width: 100%;" >

        <input type="hidden" value="<?php echo $cedula?>" name="cedula" id="id_usuario">

        </div>
        <button  class="btn btn-success pull-left" onclick="valida()">Guardar cambios</button>
         <a href="index.php"><button type="button" class="btn btn-danger">Cancelar</button></a>
        </div>

        <div class="col-md-6">
        <div class="form-group">

         <label>Plataforma<font color="RED"> *</font></label>
        <select id="plataforma" class="form-control"  style="width: 100%;" name="plataforma">

        <option value="0"></option>
        <option value="Linux">Linux</option>
        <option value="Microsoft">Microsoft</option>
        <option value="APP">APP</option>
        <option value="BD">BD</option>
        <option value="Redes">Redes</option>



        </select>






                             <label>Ambiente</label>
                            <select id="ambiente" name="ambiente"  class="form-control" style="width:100%;">
                                <option value="0"></option>
                                <option value="Desarrollo">Desarrollo</option>
                                <option value="Pruebas">Pruebas</option>
                                <option value="Producción">Producción</option>
                            </select>



         <label>Horario Notificación<font color="red"> *</font></label>
        <select id="ho" class="form-control"  style="width: 100%;" name="horario_noti" >
         <option value="0"></option>
        <?php while($row1=$horarios->fetch_assoc()){?>


        <option value="<?php echo $row1['nombre']?>"><?php echo $row1['nombre']?></option>

        <?php }?>

        </select>


                 <label> Tipo de Dispositivo <font color="red"> *</font></label>
       	<select id="tipo_ci" required name="tipo_dispositivo" class="form-control"  style=" width: 100%;">

         <option value="0"></option>

       	<?php while($row=$tipo_dispo->fetch_assoc()){ ?>

       	  <option value="<?php echo $row['id']?>"><?php echo $row['tipo']?></option>

       	<?php }?>
       	</select>


       	<label>Servicio Administrado </label><br>
        <input type="text" id="sa" name="sn" class="form-control"  style="width: 100%;" >



        </div>
        </div>


<div id='resultado'></div>

        </div>

        </div>

        </div>
        </div>


<?php }else{ ?>

<script>

//alert("nada");
 alertify.alert("<b>No estás autorizado para ingresar a esta página", function () {
	 location.href="index.php";
    });


 </script>

<?php }?>




    <script src="plugins/select2/select2.full.min.js"></script>
    <script>

function valida(){

	alertify.confirm( 'Desea guardar los cambios realizados?', function (e) {
	    if (e) {

	    	captura_valores();

	    } else {
	    	alertify.error('Cancelado');
	    }
	});
}


function captura_valores() {

	var contrato=document.getElementById('contra').value;
    var ci=document.getElementById('ci').value;
    var nombre_ci=document.getElementById('nombre_ci').value
    var ip=document.getElementById('ip').value;
    var servicio_nego=document.getElementById('sn').value;
    var ambiente=document.getElementById('ambiente').value;
    var horario_op=document.getElementById('ho').value;
    var tipo_ci=document.getElementById('tipo_ci').value;
    var servicio_admin=document.getElementById('sa').value;
    var plataforma=document.getElementById('plataforma').value;
    var cedula=document.getElementById('id_usuario').value;


    if(ip=="" || ci=="" || nombre_ci=="" ||ambiente==0 || plataforma==0 || horario_op==0 || tipo_ci==0){


    		alertify.alert('<b>Los campos que están marcados con </b><font color="red">*</font><b> son de caracter <font color="red">OBLIGATORIO</font></b>', function(){ alertify.success('Ok') });

        }else{

    realiza_cambios(contrato,ci,ip,nombre_ci,servicio_nego,ambiente,horario_op,tipo_ci,servicio_admin,plataforma,cedula);
        }
}

function realiza_cambios(contrato,ci,ip,nombre_ci,servicio_nego,ambiente,horario_op,tipo_ci,servicio_admin,plataforma,cedula) {
	//SE PASAN LOS PARAMETROS AL AJAX PARA HACER EL UPDATE


    var parametros = {
            "contrato": contrato,
            "ci": ci,
            "ip": ip,
            "nombre_ci":nombre_ci,
            "servicio_nego" : servicio_nego,
            "ambiente": ambiente,
            "horario_op": horario_op,
            "tipo_ci": tipo_ci,
            "servicio_admin":servicio_admin,
            "plataforma":plataforma,
            "cedula":cedula,

        };
        $.ajax({
            data: parametros,
            url: 'pages/backend/modificar_ci.php',
            type: 'post',
            success: function (response) {
                //$("#resultado").html(response);
                    alertify.alert('<b>Cambios realizados correctamente');
          	  setTimeout('document.location.reload()',5000);

            }
        });
}

    $(function (){
    	$("select").select2();
     });
    </script>
