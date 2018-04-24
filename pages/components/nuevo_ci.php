<link rel="stylesheet" href="plugins/alertify.default.css">
<link rel="stylesheet" href="plugins/alertify.core.css">
<script src="plugins/alertify.min.js"></script>

<?php
$oe = new conexion();

//<!-- OBTENEMOS EL ID DE ADMIN EVENTO PARA VALIDAR SI EL USUARIO , TIENE PERMISOS PARA
//PODER MODIFICAR LOS UMBRALES Y LOS DEMAS COMPONENTES -->



$res=$oe->conexion->query("select b.admin_evento from new_usuario a, sub_grupo b
		where a.cedula=b.cedula and a.cedula='$userinfo->user_id'");

$log=$res->fetch_assoc();


if($log['admin_evento']=='1'){

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



                           <!-- CEDULA DEL USUARIO -->
                             <input type="hidden" id="cedula" name="cedula_usuario" value="<?php echo $userinfo->user_id?>">

                            <label>IP<font color='red'> *</font></label>
                            <input id="ip" name="ip" class="form-control" style="width: 100%;"  required>

                            <label>Nombre CI <font color='red'> *</font></label>
                            <input id="host" name="host" class="form-control"  style="width: 100%;"  required>

                            <label>Contrato <font color='red'> *</font></label>
                            <select id="contrato" name="contrato" class="form-control " style="width: 100%;" required>

                                 <option value="0"></option>
                                <?php
                                $conn1 = $oe->conexion->query("SELECT codigo, nombre FROM new_proyectos where estado='Abrir'");

                                while ($row = $conn1->fetch_assoc()) {
                                    echo '<option value="' . $row['codigo'] . '">' . $row['nombre'] . '</option>';
                                }

                                ?>
                            </select>


                              <label>Servicio Negocio </label><br>
        <input type="text" id="sn" name="sn" class="form-control"  style="width: 100%;" >

                        </div>

                          <button type="button" class="btn btn-success" onclick="valida()">Crear CI</button>
                        <a href="index.php"><button type="button" class="btn btn-danger">Cancelar</button></a>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group" >


                              <label>Plataforma <font color='red'> *</font></label>
        <select id="plataforma" class="form-control"  style="width: 100%;" name="plataforma" required>

        <option value="0"></option>
        <option value="Linux">Linux</option>
        <option value="Microsoft">Microsoft</option>
        <option value="APP">APP</option>
        <option value="BD">BD</option>
        <option value="Redes">Redes</option>



        </select>

                            <label>Horario Notificación <font color='red'> *</font></label>
                            <select id="horario_operacion" required name="horario_operacion" class="form-control" style="width:100%;">
         <option value="0"></option>

                                <?php
                                $conn2 = $oe->conexion->query("SELECT id, nombre FROM horarios_operativos ");

                                while ($row = $conn2->fetch_assoc()) {
                                    echo '<option value="' . $row['nombre'] . '">' . $row['nombre'] . '</option>';
                                }

                                ?>
                            </select>




                            <label>Ambiente <font color='red'> *</font></label>
                            <select id="ambiente" name="ambiente"  class="form-control" style="width:100%;">
        <option value="0"></option>
                                <option value="Desarrollo">Desarrollo</option>
                                <option value="Pruebas">Pruebas</option>
                                <option value="Producción">Producción</option>
                            </select>

                            <label>Tipo de Dispositivo <font color='red'> *</font></label>
                            <select id="tipo_dispo" name="tipo_dispositivo" required class="form-control" style="width:100%;">
                              <option value="0"></option>

                                <?php
                                $conn3 = $oe->conexion->query("SELECT id, tipo FROM tipo_dispositivo ");

                                while ($row = $conn3->fetch_assoc()) {
                                    echo '<option value="' . $row['id'] . '">' . $row['tipo'] . '</option>';
                                }

                                $oe->cerrar();
                                ?>
                            </select>




                            <label>Servicio Administrado </label><br>
        <input type="text" id="sa" name="sa" class="form-control"  style="width: 100%;" >

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





<script src="plugins/select2/select2.full.min.js"></script>
    <script>
	     $(function () {
	    $("select").select2();
	     });




	     function valida(){

	    		alertify.confirm( 'Desea guardar el dispositivo con los datos diligenciados?', function (e) {
	    		    if (e) {

	    		    	captura_valores();

	    		    } else {
	    		    	alertify.error('Cancelado');
	    		    }
	    		});
	    	}




	       function captura_valores() {

	    	 var ip=document.getElementById('ip').value;
	    	 var ci=document.getElementById('host').value;
	    	 var contrato=document.getElementById('contrato').value;
	    	 var servicio_nego=document.getElementById('sn').value;
	    	 var plataforma=document.getElementById('plataforma').value;
	    	 var horario_op=document.getElementById('horario_operacion').value;
	    	 var ambiente=document.getElementById('ambiente').value;
	    	 var tipo_ci=document.getElementById('tipo_dispo').value;
	    	 var servicio_admin=document.getElementById('sa').value;

                 var cedula=document.getElementById("cedula").value;



	    	    if(ip=="" || ci=="" || contrato==0 || plataforma==0 || horario_op==0 || ambiente==0 ||horario_op==0 || tipo_ci==0){


	    	    		alertify.alert('<b>Los campos que están marcados con </b><font color="red">*</font><b> son de caracter <font color="red">OBLIGATORIO</font></b>', function(){ alertify.success('Ok') });

	    	        }else{

	    	    ingresa_ci(ip,ci,contrato,servicio_nego,plataforma,horario_op,ambiente,tipo_ci,servicio_admin,cedula);
	    	        }
	    	}



	    function ingresa_ci(ip,ci,contrato,servicio_nego,plataforma,horario_op,ambiente,tipo_ci,servicio_admin,cedula) {
	    		//SE PASAN LOS PARAMETROS AL AJAX PARA HACER EL UPDATE


	    	    var parametros = {

	    	    		"ip": ip,
	    	    		"host": ci,
	    	            "contrato": contrato,
	    	            "sn" : servicio_nego,
	    	            "plataforma":plataforma,
	    	            "horario_operacion": horario_op,
	    	            "ambiente": ambiente,
	    	            "tipo_dispositivo": tipo_ci,
	    	            "sa":servicio_admin,
                            "cedula_usuario":cedula,
	    	        };
	    	        $.ajax({
	    	            data: parametros,
	    	            url: 'pages/backend/nuevo_ci.php',
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
