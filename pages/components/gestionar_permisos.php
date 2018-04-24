 <link rel="stylesheet" href="plugins/alertify.default.css">
<link rel="stylesheet" href="plugins/alertify.core.css">
<script src="plugins/alertify.min.js"></script>

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
 <?php

 $conexion=new conexion();

 $usuarios=$conexion->conexion->query("select cedula,nombre from new_personas where cedula <> $userinfo->user_id");
 $meses = $conexion->conexion->query("select * from mes");




 $permiso_administrador=$conexion->conexion->query("select administrar from permiso_indicador
 where cedula='$userinfo->user_id'");



 $permiso=$permiso_administrador->fetch_assoc();

 $permisos=$permiso["administrar"];

 if ($permisos != 0){

 ?>

  <link rel="stylesheet" href="plugins/select2/select2.min.css"/>
  <script src="plugins/select2/select2.full.min.js"></script>

    <script>
	     $(function () {
	    $("select").select2();
	     });
    </script>


   <style>

.select2-container--default .select2-selection--single
{
	border-radius: 0;
    border-color: #d2d6de;
    width: 100%;
    height: 34px;
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





       <div class="col-md-6">
       <div class="form-group">



    <!-- SELECCIONA EL CLIENTE -->
        <label>Usuario</label>

         <select  required id="usuario"  name="usuario"  class="form-control" style=" width: 100%;">
                 <option value="0"></option>
              <?php while($usuario=$usuarios->fetch_assoc()){?>

                   <option value="<?php echo $usuario["cedula"] ?>"><?php echo $usuario["nombre"]?></option>

                <?php }?>

        </select>


        <br><ul class="buttons">
							<li><label>Permisos a asignar:</label> <input required id="crear" class="radiobtn"  name="rbtnBusqueda" type="checkbox" value="crear" tabindex="1" onclick="cerrar()"> <span></span>
							<label for="crear" id="r1">Crear</label>
							<input required id="editar" class="radiobtn" name="rbtnBusqueda" type="checkbox" value="editar" tabindex="2" onclick="cerrar()" > <span></span> <label for="editar" id="r2">Editar</label><br>


						</ul>

                    <label>FECHA DE PERMISO:   <font color="red">CREAR INDICADORES</font></label><br><br>

           <label>Fecha de inicio </label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input id="fecha_inicio_crear" name="fecha_inicio"  class="form-control" type="date" required disabled="disabled">
                    </div>


                       <label>Fecha de finalización </label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input id="fecha_fin_crear" name="fecha_inicio"  class="form-control"  type="date"  required disabled="disabled">
                    </div>



		      <br><label>FECHA DE PERMISO:  <font color="red">MODIFICAR INDICADORES</font></label><br><br>

           <label>Fecha de inicio </label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input id="fecha_inicio_modificar" name="fecha_inicio_modificar"  class="form-control" type="date" required disabled="disabled">
                    </div>


                       <label>Fecha de finalización </label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input id="fecha_fin_modificar" name="fecha_fin_modificar"  class="form-control"  type="date"  required disabled="disabled">
                    </div>


		<br><label id="ayuda_crear" style="display: none">Los campos de fecha para cada uno de los permisos apreciados <font color="red">Crear y Editar</font>, representan el lapso de tiempo que se le da al usuario para que pueda ejecutar tales tareas en los indicadores de operación.<br><br></label>

        </div><button id="ver" type="submit" class="btn btn-success pull-left" onclick="generar_permiso()">Asignar permiso</button> </div>

        <div class="col-md-6">
        <div class="form-group">



          <!-- SELECCIONA A�O-->
              <br><label>AÑO Y MES A EDITAR EN INDICADORES</label><br><br>
                <label>AÑO</label>

         <select required  id="year"  name="years"  class="form-control" style=" width: 100%;" disabled>
         <option value="0"></option>

<?php
for ($i = 2017; $i <= 2040; $i ++) {
    echo "<option value='$i'>$i</option>";
}
?>


        </select>




          <!-- SELECCIONA MES-->


           <label>MES</label>

         <select required  id="month"  name="months"  class="form-control" style=" width: 100%;" disabled>
         							<option value="0"></option>

                     <?php while($mes=$meses->fetch_assoc()){?>

                             <option value="<?php echo $mes["id_mes"]?>"><?php echo $mes["descripcion"]?></option>

                    <?php }?>
        </select>

			  <br><br><label id='ayuda_editar' style="display: none">Los indicadores correspondientes al año y mes elegidos en estos campos, podrán ser modificados
                por el usuario al cual se le asignó el permiso de edición en el tiempo dado.</label>
        <!-- ENVIAMOS LA CEDULA OCULTA DEL USUARIO -->

        <?php $cedula_admin=$userinfo->user_id;?>

        <input type="hidden" value="<?php echo $cedula_admin?>" id="id_admin">

        </div>

        </div>




        </div>

        </div>

        <?php }else{?>

            <script>

            alertify.alert("<b>No estás autorizado para ingresar a ésta página", function () {
                location.href="index.php";
            });


                </script>


       <?php  }?>





       <script>

      function generar_permiso(){

    	 aux1=0;
    	 aux2=0;

    	   if( $('#crear').prop('checked') ) {

     		  aux1=1;
    		      }
    	   if( $('#editar').prop('checked') ) {

      		  aux2=1;
     		      }


    	   var usuario=document.getElementById("usuario").value;
    	   var fecha_inicio_crear=document.getElementById("fecha_inicio_crear").value;
	 	      var fecha_fin_crear=document.getElementById("fecha_fin_crear").value;
	 	      var fecha_inicio_modificar=document.getElementById("fecha_inicio_modificar").value;
	 	      var fecha_fin_modificar=document.getElementById("fecha_fin_modificar").value;
	 	     var mes=document.getElementById("month").value;
		 	  var ano=document.getElementById("year").value;


		      if(aux1=='0' && aux2=='0'){

	            	alertify.alert('<b>Debes elegir el permiso a asignar</b>');
	               return;
			      }

		      if(usuario=='0'){
			    	  alertify.alert('<b>Debes elegir el usuario al que se le asignará el permiso</b>');
			    	  return;
				      }

		       if(aux1 != 0){
					      if(fecha_inicio_crear=="" || fecha_fin_crear==""){
				    	  alertify.alert('<b>Debes de asinar un lapso de tiempo al usuario para <font color="red">crear</font> los indicadores de operación</b>');
                           return;
					      }
			          }

			      if(aux2 != 0){
                                if(fecha_inicio_modificar=="" || fecha_fin_modificar=="" || mes=='0' || ano=='0'){
					    	  alertify.alert('<b>Para dar permisos de edición es necesario asignar un lapso de tiempo y especificar el año y el mes a <font color="red">editar</font></b>');
                               return;
                              }
					      }


                              if(fecha_fin_crear < fecha_inicio_crear){

        				    	  alertify.alert('<b> Las fechas dadas para <font color="red">crear</font> los indicadores de operación , están mal establecidas, por favor inténtalo de nuevo.</b>');
                                   return;

                              }

                              if(fecha_fin_modificar < fecha_inicio_modificar){
            				    	  alertify.alert('<b> Las fechas dadas para <font color="red">modificar</font> los indicadores de operación , están mal establecidas, por favor inténtalo de nuevo.</b>');
                                 return;
                               }


                                	      var cedula_user=usuario;
                				    	  var crear=aux1;
                					      var consultar=1;
                				 	      var editar=aux2;
                				 	      var administrar=0;





                					 	    var parametros = {
                					 	           "cedula_user": cedula_user,
                					 	           "crear": crear,
                					 	           "consultar": consultar,
                					 	           "editar" : editar,
                					 	           "administrar": administrar,
                					 	           "fecha_inicio_crear": fecha_inicio_crear,
                					 	           "fecha_fin_crear": fecha_fin_crear,
                					 	           "fecha_inicio_modificar":fecha_inicio_modificar,
                					 	           "fecha_fin_modificar": fecha_fin_modificar,
                					 	           "mes": mes,
                					 	           "ano":ano

                					 	       };
                					 	       $.ajax({
                					 	           data: parametros,
                					 	           url: 'pages/backend/gestionar_permisos.php',
                					 	           type: 'post',

                					 	           success: function (response) {
                					 	               $("#resultado").html(response);
                					    	    		alertify.alert('<b>Permisos asignados correctamente</b>', function(){ alertify.success('Ok') });

                				                        setTimeout('document.location.reload()',5000);
                					 	           }
                					 	       });




					       }











      $("#crear").on("click", function(){
          //var x = document.getElementById("responsable");
        if( $('#crear').prop('checked') ) {
   // alert('Seleccionado');
      $('#fecha_inicio_crear').removeAttr('disabled');
	  $('#fecha_fin_crear').removeAttr('disabled');
	  $('#ayuda_crear').show();
      }else{

        $('#fecha_inicio_crear').attr('disabled','disabled');
  	  $('#fecha_fin_crear').attr('disabled','disabled');
  	 $('#ayuda_crear').hide();
      }
      	  //$('#month').attr('selected','selected');

        });




      $("#editar").on("click", function(){
          //var x = document.getElementById("responsable");
        if( $('#editar').prop('checked') ) {
   // alert('Seleccionado');
      $('#fecha_inicio_modificar').removeAttr('disabled');
	  $('#fecha_fin_modificar').removeAttr('disabled');
	  $('#month').removeAttr('disabled');
	  $('#year').removeAttr('disabled');

	  $('#ayuda_editar').show();


      }else{

      $('#fecha_inicio_modificar').attr('disabled','disabled');
  	  $('#fecha_fin_modificar').attr('disabled','disabled');
  	  $('#month').attr('disabled','disabled');
      $('#year').attr('disabled','disabled');
      $('#ayuda_editar').hide();
      }
      	  //$('#month').attr('selected','selected');

        });


       </script>
