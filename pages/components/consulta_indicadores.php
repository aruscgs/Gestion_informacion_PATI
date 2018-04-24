<link rel="stylesheet" href="plugins/alertify.default.css">
<link rel="stylesheet" href="plugins/alertify.core.css">
<script src="plugins/alertify.min.js"></script>

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
.select2-container--default .select2-selection--single
{
	border-radius: 0;
    border-color: #d2d6de;
    width: 100%;
    height: 34px;
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

.button{
width: 40px;
}

</style>

<?php


$conexion=new conexion();


$clientes=$conexion->conexion->query("select * from cliente");
$mes=$conexion->conexion->query("select * from mes");

//$perm=$conexion->conexion->query("select area from new_usuario where cedula='$userinfo->user_id'");
$meses = $conexion->conexion->query("select * from mes");

$per=$conexion->conexion->query("select count(id) as cantidad,consultar,editar,administrar from permiso_indicador where cedula='$userinfo->user_id'");

$log=$per->fetch_assoc();


//$permiso=$perm->fetch_assoc();



if($log['cantidad'] != '0'){

?>

 <div class="box box-default">

          <div class="box-header with-border">
            <h3 class="box-title">Indicadores de operación</h3>
              <!-- Barra de progreso -->
              <div class="progress progress-sm active">
                <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 40%">

                </div>
              </div>


   <form name="formulario" id="formulario" action="" onSubmit=" mostrar_indicadores(); return false" >

						<ul class="buttons">
							<li><input required id="general" class="radiobtn"  name="rbtnBusqueda" type="radio" value="general" tabindex="1" onclick="cerrar()"> <span></span>
							<label for="general" id="r1">General</label>
							<input required id="cliente" class="radiobtn" name="rbtnBusqueda" type="radio" value="cliente" tabindex="2" onclick="cerrar()" > <span></span> <label for="cliente" id="r2">Cliente</label><br>


						</ul>


       <div class="col-md-6">
       <div class="form-group">



    <!-- SELECCIONA EL CLIENTE -->
        <label>Cliente</label>

         <select  disabled id="clientes"  name="clientes"  class="form-control" style=" width: 100%;">
                 <option value="0"></option>

              <?php while($cli=$clientes->fetch_assoc()){?>

              	 <option value="<?php echo $cli['id_cliente'] ?>"><?php echo $cli['cliente'] ?></option>


             <?php }?>


        </select>

        </div><button id="ver" type="submit" class="btn btn-success pull-right" onclick="mostrar()">Consultar Indicadores</button> </div>

        <div class="col-md-6">
        <div class="form-group">



          <!-- SELECCIONA A�O-->

                <label>AÑO</label>

         <select required disabled id="year"  name="years"  class="form-control" style=" width: 100%;">
         <option value="0"></option>

<?php
for ($i = 2017; $i <= 2040; $i ++) {
    echo "<option value='$i'>$i</option>";
}
?>


        </select>




          <!-- SELECCIONA MES-->


           <label>MES</label>

         <select required disabled id="month"  name="months"  class="form-control" style=" width: 100%;">
         							<option value="0"></option>

       <?php while($mes=$meses->fetch_assoc()){?>

            <option
								value="<?php echo $mes["id_mes"]?>.'-'.<?php echo $mes["descripcion"]?>"><?php echo $mes["descripcion"]?></option>

            <?php }?>

        </select>


        <!-- ENVIAMOS LA CEDULA OCULTA DEL USUARIO -->
	    <input type="hidden" name="cedula" value="<?php echo $userinfo->user_id?>">

        </div>

        </div>

        </form>



        </div>

        </div>
       <!-- TABLA DE REGISTROS PARA LOS INDICADORES -->
        <div id=tabla>
        </div>




        </div>



        </div>




        <?php }else{?>


                    <script>

//alert("nada");
    alertify.alert("<b>No estás autorizado para ingresar a ésta página", function () {
	 location.href="index.php";
    });


 </script>

        <?php }?>


        <script>



          function mostrar_indicadores()
          {
              var cliente=document.getElementById("clientes").value;
              var  activoFijo = $('input[name="rbtnBusqueda"]:checked').val();

         if(activoFijo=='cliente'){
            if(cliente != ""){

          	$.ajax({

          		type:  'POST',

          		url:   'pages/backend/consultar_indicadores.php',

                data: $("#formulario").serialize(),

            	success: function (response) {
                    $("#tabla").html(response);
                }
          });
            }else{

            	alertify.alert('<b>TODOS LOS CAMPOS SON<BR><font color=\"red\">OBLIGATORIOS</font>');
                }

          }else{
          	$.ajax({

          		type:  'POST',

          		url:   'pages/backend/consultar_indicadores.php',

                data: $("#formulario").serialize(),

            	success: function (response) {
                    $("#tabla").html(response);
                }
          });
              }
          }
        	</script>


     <script src="plugins/select2/select2.full.min.js"></script>
    <script>
	     $(function () {
	    $("select").select2();
	     });
    </script>




          <!--SCRIPT PARA HABILITAR Y DESHABLITAR-->
          <script>
          $("#general").on("click", function(){
            //var x = document.getElementById("responsable");
               document.getElementById('tabla').innerHTML='';

        	  $('#month').removeAttr('disabled');
        	  $('#year').removeAttr('disabled');
        	  $('#clientes').val('');
        	  $('#clientes').attr('disabled','disabled');
        	  //$('#clientes').attr('selected','selected');
        	  //$('#clientes').val("");
               //$('#clientes').val($('#clientes > option:first').val());        	 // document.getElementById("clientes").value="fmnfrfnn";
          });

          $("#cliente").on("click", function(){
              //var x = document.getElementById("responsable");
               document.getElementById('tabla').innerHTML='';
              $('#clientes').val('');
        	  $('#clientes').removeAttr('disabled');

          	  $('#year').removeAttr('disabled');

          	  $('#month').removeAttr('disabled');
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
