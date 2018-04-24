<link rel="stylesheet" href="plugins/alertify.default.css">
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
</style>






<div class="box box-success">
    <div class="box-header with-border">
   <!-- Barra de progreso -->
              <div class="progress progress-sm active">
                <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                </div>
              </div>
                    <div class="col-md-6">
                        <div class="form-group">



                            <label>Nombre Completo<font color='red'> *</font></label>
                            <input id="nom_comp" name="nombre_completo" class="form-control" style="width: 100%;" maxlength="50" onkeypress="return soloLetras(event);" required>

                            <label>Cedula <font color='red'> *</font></label>
                            <input id="cedula" name="cedula" class="form-control"  style="width: 100%;" maxlength="12" onkeypress="return justNumbers(event);"  required>

                            <label>Correo Corporativo <font color='red'> *</font></label>
                            <input type="text" id="correo_corp" name="correo_corporativo" class="form-control"  style="width: 100%;" required>

                            <label>Correo Personal </label><br>
        										<input type="text" id="correo_per" name="correo_personal" class="form-control"  style="width: 100%;" >

														<label>Cargo <font color='red'> *</font></label><br>
														<select id="cargo" name="cargos" class="form-control" style="width:100%;" required>
         										<option value="0"></option>

                                <?php
                                $conn5 = $oe->conexion->query("SELECT distinct cargo FROM new_personas order by cargo asc");

                                while ($row = $conn5->fetch_assoc()) {
                                    echo '<option value="'.$row['cargo'].'">'.$row['cargo'].'</option>';
                                }

                                ?>
                            </select>


                        </div>

                          <button type="button" class="btn btn-success" onclick="valida()">Crear usuario</button>
                        <a href="index.php"><button type="button" class="btn btn-danger">Cancelar</button></a>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group" >


                            <label>Celular </label>
        										<input type="text" id="celular" name="celular" class="form-control" style="width: 100%;" maxlength="20" onkeypress="return justNumbers(event);">

                            <label>Rol <font color='red'> *</font></label>
                            <select id="rol" name="rol" class="form-control" style="width:100%;" required>
         										<option value="0"></option>

                                <?php
                                $conn2 = $oe->conexion->query("SELECT id, descripcion FROM cargo");

                                while ($row = $conn2->fetch_assoc()) {
                                    echo '<option value="' . $row['id'] . '">' . $row['descripcion'] . '</option>';
                                }

                                ?>
                            </select>




                            <label>Nombre Proyecto <font color='red'> *</font></label>
                            <select id="nom_proyecto" name="nombre_proyecto"  class="form-control" style="width:100%;">
        										<option value="0"></option>

																	<?php
																	$conn4 = $oe->conexion->query("SELECT codigo, nombre  FROM new_proyectos where estado='Abrir' order by nombre asc");

																	while ($row = $conn4->fetch_assoc()) {
																			echo '<option value="' . $row['codigo'] . '">' . $row['nombre'] . '</option>';
																	}

																	?>
                            </select>


                            <label>Nombre Lider <font color='red'> *</font></label>
                            <select id="nom_lider" name="nombre_lider" required class="form-control" style="width:100%;">
                              <option value="0"></option>

                                <?php
                                $conn3 = $oe->conexion->query("SELECT a.cedula, b.nombre FROM new_usuario a, new_personas b where a.cedula = b.cedula and a.rol='1' order by b.nombre asc");

                                while ($row = $conn3->fetch_assoc()) {
                                    echo '<option value="' . $row['cedula'] . '">' . $row['nombre'] . '</option>';
                                }


                                ?>
                            </select>



	                            <label>Nombre Area <font color='red'> *</font></label>
	                            <select id="nomarea" name="nombre_area" required class="form-control" style="width:100%;">
	                              <option value="0"></option>

	                                <?php
	                                $conn6 = $oe->conexion->query("SELECT id, area FROM  areas");

	                                while ($row = $conn6->fetch_assoc()) {
	                                    echo '<option value="' . $row['id'] . '">' . $row['area'] . '</option>';
	                                }

	                                $oe->cerrar();
	                                ?>
	                            </select>

                        </div>

            </div>



</div>

</div>
<div id="tabla"></div>
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
function justNumbers(e)
        {
        var keynum = window.event ? window.event.keyCode : e.which;
        if ((keynum == 8) || (keynum == 46))
        return true;

        return /\d/.test(String.fromCharCode(keynum));
        }

				function soloLetras(e){
       key = e.keyCode || e.which;
       tecla = String.fromCharCode(key).toLowerCase();
       letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
       especiales = "8-37-39-46";

       tecla_especial = false
       for(var i in especiales){
            if(key == especiales[i]){
                tecla_especial = true;
                break;
            }
        }

        if(letras.indexOf(tecla)==-1 && !tecla_especial){
            return false;
        }
    }
return true;

}
</script>


<script src="plugins/select2/select2.full.min.js"></script>
    <script>
	     $(function () {
	    $("select").select2();
	     });




	     function valida(){

	    		alertify.confirm( 'Desea crear el usuario con los datos diligenciados?', function (e) {
	    		    if (e) {

	    		    	captura_valores();

	    		    } else {
	    		    	alertify.error('Cancelado');
	    		    }
	    		});
	    	}




	       function captura_valores() {

	    	 var nombre=document.getElementById('nom_comp').value;
	    	 var cedula=document.getElementById('cedula').value;
	    	 var correocop=document.getElementById('correo_corp').value;
	    	 var correoper=document.getElementById('correo_per').value;
				 var cargo=document.getElementById('cargo').value;
				 var celular=document.getElementById('celular').value;
				 var rol=document.getElementById('rol').value;
				 var nomproyecto=document.getElementById('nom_proyecto').value;
				 var nom_lider=document.getElementById('nom_lider').value;
				 var nomarea=document.getElementById('nomarea').value;


	    	    if(nombre=="" || cedula=="" || correocop==0 || cargo==0 || rol==0 || nomproyecto==0 || nom_lider==0 || nomarea==0){

							alertify.alert('<b>Los campos que están marcados con </b><font color="red">*</font><b> son de caracter <font color="red">OBLIGATORIO</font></b>', function(){ alertify.error('Datos Imcompletos') });

	    	        }else{

	    	    crea_usuario(nombre,cedula,correocop,correoper,celular,cargo,rol,nomproyecto,nom_lider,nomarea);

	    	        }
	    	}



	    function crea_usuario(nombre,cedula,correocop,correoper,celular,cargo,rol,nomproyecto,nom_lider,nomarea) {
	    		//SE PASAN LOS PARAMETROS AL AJAX PARA HACER EL UPDATE


	    	    var parametros = {

	    	    		    "nombre": nombre,
	    	    		    "cedula": cedula,
	    	            "correo": correocop,
	    	            "correo_personal" : correoper,
	    	            "celular":celular,
	    	            "cargo": cargo,
										"rol": rol,
	    	            "proyecto": nomproyecto,
	    	            "jefe": nom_lider,
										"area": nomarea,
	    	        };
	    	        $.ajax({
	    	            data: parametros,
	    	            url: 'pages/backend/nuevo_usuario.php',
	    	            type: 'post',
	    	            success: function (response) {
	                        $("#tabla").html(response);

	    	            	//window.setTimeout('location.reload()');
	                       // location.reload();

	                        setTimeout('document.location.reload()',5000);


	    	            }
	    	        });
	    	}


    </script>
