<link rel="stylesheet" href="plugins/alertify.default.css">
<link rel="stylesheet" href="plugins/alertify.core.css">
<script src="plugins/alertify.min.js"></script>

<?php
$conexion=new conexion();


$clientes=$conexion->conexion->query("select * from cliente");
$mes=$conexion->conexion->query("select * from mes");


//$perm=$conexion->conexion->query("select area from new_usuario where cedula='$userinfo->user_id'");

$user=$conexion->conexion->query("select count(id) as cantidad from permiso_indicador where cedula='$userinfo->user_id'");
$user_indi=$user->fetch_assoc();

$user_num=$user_indi["cantidad"];

$per=$conexion->conexion->query("select count(id) as cantidad,crear,consultar,editar,administrar,f_inicio_crear,f_fin_crear from permiso_indicador where cedula='$userinfo->user_id'");

$log=$per->fetch_assoc();

$fecha_ini_crear=$log["f_inicio_crear"];
$fecha_fin_crear=$log["f_fin_crear"];
$hoy =date("Y-m-d");
//echo $hoy;
//echo $fecha_ini_crear." fecha inicio";
//echo $fecha_fin_crear." fecha fin";

//$permiso=$perm->fetch_assoc();

//echo $log["cantidad"];


if($user_num == '0'){

    ?>

                <script>

    alertify.alert("<b>No estás autorizado para ingresar a ésta página", function () {
	 location.href="index.php";
    });



 </script>
    <?php


}else{

    if($hoy>$fecha_fin_crear){

        $conexion->cambia_estado_crear_indicador($userinfo->user_id);

        $estado_crear=$conexion->conexion->query("select crear from permiso_indicador where cedula='$userinfo->user_id'");
        $est_crea=$estado_crear->fetch_assoc();
        //echo $est_crea["crear"];

    }else{
        $estado_crear=$conexion->conexion->query("select crear from permiso_indicador where cedula='$userinfo->user_id'");
        $est_crea=$estado_crear->fetch_assoc();
        //echo $est_crea["crear"];
    }




    if($user_num != '0'){



?>

<link rel="stylesheet" href="plugins/select2/select2.min.css"/>

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

.input__row {
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
	padding: 15px;
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

</style>


<style>
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

#ver{

left: 0px;
margin-left: 10px;


}

a{

	color:white;
	text-decoration: none;
	color: white;
	padding: 8px;

}

</style>



 <div class="box box-default">

          <div class="box-header with-border">
            <h3 class="box-title">Indicadores de operación</h3>
              <!-- Barra de progreso -->
              <div class="progress progress-sm active">
                <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 40%">

                </div>
              </div>


   <form name="formulario" id="formulario" action="" onSubmit=" mostrar_indicadores(); return false" >

 			<div class="input__row">
						<ul class="buttons">
							<li><input required id="general" class="radiobtn"  name="rbtnBusqueda" type="radio" value="general" tabindex="1" onclick="cerrar()" > <span></span>
							<label for="general" id="r1">General</label>
							<input required id="cliente" class="radiobtn" name="rbtnBusqueda" type="radio" value="cliente" tabindex="2" onclick="cerrar()" "> <span></span> <label for="cliente" id="r2">Cliente</label><br>


						</ul>


       <div class="col-md-6">
       <div class="form-group">



    <!-- SELECCIONA EL CLIENTE -->
        <label>Cliente</label>

         <select required disabled id="clientes"  name="clientes"  class="form-control" style=" width: 100%;">
               <option id="first" value="">Selección:</option>
              <?php while($cli=$clientes->fetch_assoc()){?>

              	 <option value="<?php echo $cli['id_cliente'] ?>"><?php echo $cli['cliente'] ?></option>


             <?php }?>


        </select>
		<br><br>


        </div>

        </div>

        <div class="col-md-6">


        <div class="form-group">



        <!-- SELECCIONA EL MES -->
        <label>Mes</label>

        <select required id="mes"  name="mes" class="form-control" style=" width: 100%;" disabled>
               <option value="">Selección:</option>
              <?php while($meses=$mes->fetch_assoc()){?>

              	 <option value="<?php echo $meses['id_mes'] ?>"><?php echo $meses['descripcion'] ?></option>


             <?php }?>


        </select>
           <br><br>

         <button id="ver" type="submit" class="btn btn-success pull-right" onclick="mostrar()">Registrar Indicadores</button>
        <button id="consultar" type="submit" class="btn btn-primary pull-right"><a href="index.php?page=051">Consultar Indicadores</a></button>

        </div>

        </div>

        </form>



        </div>

        </div>
       <!-- TABLA DE REISTROS PARA LOS INDICADORES -->
        <div id=tabla>
        </div>




        </div>



        </div>



        <?php
        if($est_crea["crear"] != '1'){

            echo ("<script> $('#ver').attr('disabled', true);</script>");
            echo ("<script> $('#cliente').attr('disabled', true);</script>");
            echo ("<script> $('#mes').attr('disabled', true);</script>");
            echo ("<script> $('#general').attr('disabled', true);</script>");



        }
}else{
            ?>


            <script>

    alertify.alert("<b>No estás autorizado para ingresar a ésta página", function () {
	 location.href="index.php";
    });



 </script>


       <?php
             }?>


        <script>


          function mostrar_indicadores()
          {

          	$.ajax({

          		type:  'POST',

          		url:   'pages/backend/crear_indicadores.php',

                data: $("#formulario").serialize(),

            	success: function (response) {
                    $("#tabla").html(response);
                }
          });


          }

        	</script>


     <script src="plugins/select2/select2.full.min.js"></script>
    <script>
	     $(function () {
	    $("select").select2();
	     });
    </script>


<?php }?>

          <!--SCRIPT PARA HABILITAR Y DESHABLITAR-->
          <script>
          $("#general").on("click", function(){
            //var x = document.getElementById("responsable");

        	  $('#mes').removeAttr('disabled');
        	  $('#clientes').attr('disabled','disabled');
        	  $('#first').attr('selected','selected');

          });

          $("#cliente").on("click", function(){
              //var x = document.getElementById("responsable");
              document.getElementById('tabla').innerHTML='';
          	  $('#mes').removeAttr('disabled');
          	  $('#clientes').removeAttr('disabled');

            });




          function mostrar() {
              div = document.getElementById('tabla');
              div.style.display = '';
          }

          function cerrar() {
              div = document.getElementById('tabla');
              div.style.display = 'none';
          }

          </script>
