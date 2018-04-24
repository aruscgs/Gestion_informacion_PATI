
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
.select2-container--default .select2-selection--single
{

	border-radius: 0;
    border-color: #d2d6de;
    width: 100%;
    height: 34px;
}

#event
{
	font-size: 20px;
	padding: 1px 15px;
	color: blue;
	text-align: right;
	font-family: calibri;
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

#buscador
{
		padding: 5px;
	    display: block;
	    border: none;
	    border-bottom: 1px solid #ccc;
	    width: 20%;
}
@media (max-width: 1150px)
	{
		.lwms-main .lwms-left, .lwms-main .lwms-right, lwms-filterhead
		{
			width: 160px;
		}
	}
</style>
<?php


$con=new conexion();


$cliente=$con->conexion->query("select * from cliente order by cliente");
$servicio=$con->conexion->query("select * from servicio_indicador");


$permiso_administrador=$conexion->conexion->query("select administrar from permiso_indicador
 where cedula='$userinfo->user_id'");

$permiso=$permiso_administrador->fetch_assoc();

$permisos=$permiso["administrar"];



?>


<style>
#buscador
{
		padding: 5px;
	    display: block;
	    border: none;
	    border-bottom: 1px solid #ccc;
        width: 46%;
}

</style>
<script src="plugins/custom_multi_select/multiselect.min.js"></script>
<link rel="stylesheet" href="plugins/custom_multi_select/style.css"/>




<link rel="stylesheet" href="plugins/alertify.default.css">
<link rel="stylesheet" href="plugins/alertify.core.css">
<script src="plugins/alertify.min.js"></script>

<script>


function validar(){
	document.getElementById("guardar_asignacion").disabled="disabled";
	document.getElementById("cancelar_asignacion").disabled="disabled";

    var valor=document.getElementById("clientes").value;

	if(valor != '0'){

		 document.getElementById('guardar_asignacion').disabled=false;
		 document.getElementById('cancelar_asignacion').disabled=false;
		 $('#servicios').show();
		 $('#buscador').show();
		 $('#titulo_busca').show();
		 $('#titulo').show();



		}

}



$(document).ready(function () {
    (function ($) {
        $('#buscador').keyup(function () {
            var rex = new RegExp($(this).val(), 'i');
            $('#servicios option').hide();
            $('#servicios option').filter(function () {
                return rex.test($(this).text());
            }).show();
        })
    }(jQuery));
});



function insertar_datos(){


	$.ajax({

		type:  'POST',

		url:   'pages/backend/asignar_servicio.php',

		       data: $("#formulario").serialize(),

		       success:  function (data)
               {

                  $("#resultado").html(data);

                  var servicios=document.getElementById("resultado").innerHTML;

               }
		});


		//window.setTimeout('location.reload()');

}
</script>

</style>



<?php if($permisos !=0){ ?>

<div class="box box-default">
          <div class="box-header with-border">


            <br>
              <!-- Barra de progreso -->


                  <div class="box-body">


       <div class="col-md-6">

       <div class="form-group">


   <form name="formulario" id="formulario" method="POST" action="#" onSubmit="insertar_datos(); return false">

        <label>Nombre del Cliente</label>

     <select class="form-control" id="clientes" onchange="validar()" name="cliente">

     <option value="0"></option>
     <?php

     while($clientes=$cliente->fetch_assoc()){
        ?>

        <option value="<?php echo $clientes["id_cliente"] ?>"><?php echo $clientes["cliente"]?></option>


    <?php }

     ?>

     </select>



	    <br>


	     <button id="guardar_asignacion"  class="btn btn-success" style="width: 150px;"  disabled type="submit">Guardar</button>

	     <a href="index.php"><button id="cancelar_asignacion" type="button" class="btn btn-danger" style="width: 150px;" disabled>Cancelar</button></a>


        </div>

        <div id="resultado" > </div>

        </div>








      <div class="col-md-6">
          <!-- INICIO COLUMNA -->
               <div class="col-md-6">


        <div class="form-group">

        <div class="input__row" style="width: 1074px;">


<div class="row" style="display: none;" id="servicios">

  <div class="col-xs-5">

 <p> Buscar: <input name="buscador" id="buscador" class="form-control" type="text"> </p>


    <select id="cis" name="cis[]" multiple class="form-control" required>
     <?php while($servicios=$servicio->fetch_assoc()){?>

           <option value="<?php echo $servicios["id_servicio"]?>"><?php echo $servicios["nombre"]?></option>


        <?php } ?>
    </select>


  </div>


</div>


        </div>
        </div>


        </div>
    <!-- FIN COLUMNA  -->

           </div>



        </div>



        </div>


        </div>


        </form>



  <?php }else {?>


                  <script>

    alertify.alert("<b>No estás autorizado para ingresar a ésta página", function () {
	 location.href="index.php";
    });


 </script>

  <?php }?>

   <script>





   $('#multiselect').multiselect();

   $('#multiselect option').tooltip();


   </script>




	<script>




	 function inserta_datos() {

		 $("#myModal").modal("show");

	}


    $(document).ready(function () {
        (function ($) {
            $('#buscador').keyup(function () {
                var rex = new RegExp($(this).val(), 'i');
                $('#lista li').hide();
                $('#lista li').filter(function () {
                    return rex.test($(this).text());
                }).show();
            })
        }(jQuery));
    });


	$('#cis').lwMultiSelect({
  	addAllText:"Seleccionar",
    removeAllText:"Removerlos",
    selectedLabel:"Servicios Seleccionados",
});

$('#cis').data('plugin_lwMultiSelect').removeAll();
$( "#cis option:checked" ).val();
        </script>
