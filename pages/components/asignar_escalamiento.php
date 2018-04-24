<link rel="stylesheet" href="plugins/select2/select2.min.css"/>
<link rel="stylesheet" href="plugins/alertify.core.css">
<script src="plugins/alertify.min.js"></script>


<?php
$oe = new conexion();

//<!-- OBTENEMOS EL ID DE ADMIN EVENTO PARA VALIDAR SI EL USUARIO , TIENE PERMISOS PARA
//PODER MODIFICAR LOS UMBRALES Y LOS DEMAS COMPONENTES -->



$res=$oe->conexion->query("select admin_usuario from new_usuario
		where cedula='$userinfo->user_id'");

$log=$res->fetch_assoc();


if($log['admin_usuario']=='1'){

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
    	 $.get("pages/backend/includes/nombre.php", { param_id: id}, function(data){
	     $("#nombre").html(data);


      });
   })

      $("#nombre").change(function () {

    	  var id = $(this).val();

         $.get("pages/backend/includes/correo.php", { info_id: id}, function(data){
         $("#correo").val(data);
       });
     })

     $("#nombre").change(function () {

    	  var id = $(this).val();
         $.get("pages/backend/includes/cargo.php", { info_id: id}, function(data){
         $("#cargo").val(data);
       });
     })

     $("#nombre").change(function () {

    	  var id = $(this).val();
         $.get("pages/backend/includes/lider.php", { info_id: id}, function(data){
         $("#lider").val(data);
       });
     })

     $("#nombre").change(function () {

    	  var id = $(this).val();
         $.get("pages/backend/includes/celular.php", { info_id: id}, function(data){
         $("#celular").val(data);
       });
     })

     $("#nombre").change(function () {

    	  var id = $(this).val();
         $.get("pages/backend/includes/rol.php", { info_id: id}, function(data){
         $("#rol").val(data);
       });
     })

   });

</script>


 <div class="box box-default">
          <div class="box-header with-border">
            <h3 class="box-title">Asignar Escalamiento</h3>
              <!-- Barra de progreso -->
              <div class="progress progress-sm active">
                <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                </div>
              </div>

       <div class="box-body">
       <div class="row">


       <form method="post">
       <div class="col-md-6">
       <div class="form-group">

        <label>Contrato</label>
        <select id="contra" required name="contrato" class="form-control" style=" width: 100%;"></select>

        <label>Persona </label>
        <select id="nombre" name="cedula" class="form-control"  style=" width: 100%;"></select>

				<label>Correo </label>
        <input id="correo" class="form-control"  style="width: 100%;" disabled>



        </div></div>

        <div class="col-md-6">
        <div class="form-group">

				<label>Cargo </label><br>
				<input type="text" id="cargo" name="cargos" class="form-control"  style="width: 100%;" disabled>

        <label>Jefe Inmediato </label>
        <input id="lider" class="form-control"  style="width: 100%;" disabled>

        <label>Celular </label>
       	<input  id="celular"class="form-control " name="telefono" readonly required>

       	<label>Rol </label><br>
        <input type="text" id="rol" name="roles" class="form-control"  style="width: 100%;" disabled>

        </div>
        </div>

				<button type="button" class="btn btn-success" onclick="valida()">Asignar escalamiento</button>
        </form>


        </div>

        </div>

        </div>
        </div>

    <script src="plugins/select2/select2.full.min.js"></script>
    <script>

    $(function (){
    	$("select").select2();
     });
    </script>

	<?php }else{

	?>

	<script>

	//alert("nada");
	 alertify.alert("<b>No estas autorizado para ingresar a esta página", function () {
		 location.href="index.php";
			});


	 </script>

	<?php }?>

<script>

function valida(){

	 alertify.confirm( 'Desea Asignar a esta persona?', function (e) {
			 if (e) {

				 captura_valores();

			 } else {
				 alertify.error('Cancelado');
			 }
	 });
 }

 function captura_valores() {

 var nombre=document.getElementById('nombre').value;


		if(contra==0 || nombre==0){

			alertify.alert('<b>Los campos que están marcados con </b><font color="red">*</font><b> son de caracter <font color="red">OBLIGATORIO</font></b>', function(){ alertify.error('Datos Imcompletos') });

				}else{

		    asignar_escalamiento(nombre);

				}
}

function asignar_escalamiento(nombre) {
		//SE PASAN LOS PARAMETROS AL AJAX PARA HACER EL INSERT


			var parametros = {
							"nombre": nombre

					};
					$.ajax({
							data: parametros,
							url: 'pages/backend/asignar_escalamiento.php',
							type: 'post',
							success: function (response) {
										$("#tabla").html(response);
										alertify.alert("Añadido Con Exito!");

								//window.setTimeout('location.reload()');
									 // location.reload();

										setTimeout('document.location.reload()',5000);


							}
					});
	}
</script>
