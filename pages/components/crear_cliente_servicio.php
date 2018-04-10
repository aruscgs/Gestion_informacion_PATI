  <link rel="stylesheet" href="plugins/alertify.default.css">
<link rel="stylesheet" href="plugins/alertify.core.css">
<script src="plugins/alertify.min.js"></script>
 <?php 
 
 $con=new conexion();
 
 $zonas=$con->conexion->query("select distinct zona from cliente");
 
 $permiso_administrador=$conexion->conexion->query("select administrar from permiso_indicador
 where cedula='$userinfo->user_id'");
 
 $permiso=$permiso_administrador->fetch_assoc();
 
 $permisos=$permiso["administrar"];
 

 
 
 ?>
 
 <style>
 

 
<!-- style radio buttons -->
 
.input__row {
	margin-top: 10px;
}
/* Radio button */
.radiobtn {
	display: none;
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
 
 </style>
 
 <?php   if($permisos != 0){   ?>
 
 <div class="box box-default">
          <div class="box-header with-border">
            <h3 class="box-title">Crear cliente o servicio para indicadores de operación</h3>
              <!-- Barra de progreso -->
              <div class="progress progress-sm active">
                <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 40%">                  
                </div>
              </div>              
               
                  <div class="box-body">       
       
                    <div class="row">
   
   			           <ul class="buttons">
			   				<li>
							<input id="crea_cliente" class="radiobtn" name="crear" type="radio" value="cliente" tabindex="1"> <span></span> <label
								for="crea_cliente"  id="r1">Crear cliente</label>
							
							
								<input id="crea_servicio" onclick="indivi('masivo',<?php echo $userinfo->user_id?>);" class="radiobtn" name="crear" type="radio" value="servicio" tabindex="2"> <span></span> <label
								for="crea_servicio" id="r2">Crear servicio</label></li>
						</ul>
					</div>
   
     
     
       <div class="col-md-6">
     
       <div class="form-group">
       
      
      <form  name="formulario" id="formulario" action="" onSubmit=" comprobar_cliente(); return false">

        <label>Nombre del Cliente</label>
        <input type="text" id="nom_cliente" required name="nombre_cliente" class="form-control" style=" width: 100%;" disabled></input>

        <label>Zona</label> 
        <select id="nom_zona" required name="zona" class="form-control"  style=" width: 100%;" disabled>
        <option value="0"></option>
        <?php while($zon=$zonas->fetch_assoc()){?>
        <option><?php echo $zon["zona"]?></option>
         <?php }?>
        </select>
       
        <label>Asignar nueva zona</label>
        <input type="radio" id="nueva_zona" name="zonas">       

 
        <label>Elegir zona</label>
        <input type="radio" id="zona" name="zonas">    

        <input type="text" id="nuev_zona" required name="nueva_zona" class="form-control" style=" width: 100%;" disabled></input>
	    <br>
	    
	    
	    
	    
	     <button id="guardar_cliente" type="submit"  class="btn btn-success" style="width: 150px;"  disabled>Guardar</button>

	     <a href="index.php"><button id="cancelar_cliente" type="button" class="btn btn-danger" style="width: 150px;" disabled>Cancelar</button></a>         
		
       </form>
		
        </div>
        
        
        </div>
     
        
        <div class="col-md-6">
        
        
        
        <div class="form-group">
        
        
        
        <div class="input__row">
					 
	     <form  name="formulario2" id="formulario2" action="" onSubmit=" comprobar_servicio(); return false">
	
        
        
        <label>Nombre del servicio</label>
        <input id="nom_servicio" required name="servicio" class="form-control"  style="width: 100%;" disabled>
        
         <br>
         
        <button id="guarda_servicio" type="submit" class="btn btn-success" style="width: 150px;" disabled>Guardar</button>

	     <a href="index.php"><button id="cancela_servicio" type="button" class="btn btn-danger" style="width: 150px;" disabled>Cancelar</button></a>         
        </form>
        
        
        
        
        
      <div id="tabla"></div>
      
      
    
        
        </div>           
        </div>
          
       
        
       
        
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
            
       <?php }?>
        
        <!--SCRIPT PARA HABILITAR Y DESHABLITAR-->
<script>



function comprobar_cliente() {
	alertify.confirm( 'Desea guardar el cliente creado?', function (e) {
	    if (e) {
	    	alertify.success('Cliente creado exitosamente');
	    	inserta_datos_cliente();

	    	setTimeout(function(){
	    		   window.location.reload(1);
	    		}, 4000);
	    
	    } else {
	    	alertify.error('Cancelado');
	    }
	});  
}

function comprobar_servicio() {
	alertify.confirm( 'Desea guardar el servicio creado?', function (e) {
	    if (e) {

	    	alertify.success('Servicio creado exitosamente');
	    	inserta_datos_servicio();

	    	setTimeout(function(){
	    		   window.location.reload(1);
	    		}, 4000);
	    	  
	    } else {
	    	alertify.error('Cancelado');
	    }
	});  
}


function inserta_datos_cliente() {
   var nombre=document.getElementById("nom_cliente").value;
   var zona=document.getElementById("nom_zona").value;
   var zona_nueva=document.getElementById("nuev_zona").value;
   var opcion=document.getElementById("crea_cliente").value;
   var nombre_ser="";

   var nombre_cliente = nombre;
   var nombre_mayus = nombre_cliente.toUpperCase();


    	$.ajax({
            
    		type:  'POST',
    		
    		url:   'pages/backend/crear_cliente_servicio.php',
    		
          data: {
              nombre:nombre_mayus,
              zona:zona,
              zona_nueva:zona_nueva,
              opcion:opcion,
              nombre_ser:nombre_ser,

              },

      	success: function (response) {
              $("#tabla").html(response);
          }
    });
    	
    
  
}



function inserta_datos_servicio() {

	var nombre_ser=document.getElementById("nom_servicio").value;
	nombre="";
    zona="";
    zona_nueva="";
    opcion="";

    var nombre_servicio = nombre_ser;
    var nombre_servicio_mayus = nombre_servicio.toUpperCase();

	
 	$.ajax({
        
		type:  'POST',
		
		url:   'pages/backend/crear_cliente_servicio.php',
		
      data: {
          nombre_ser:nombre_servicio_mayus,
          nombre:nombre,
          zona:zona,
          zona_nueva:zona_nueva,
          opcion:opcion,
          

          },

  	success: function (response) {
          $("#tabla").html(response);
      }
});
	
}


$("#crea_cliente").on("click", function(){
//  var x = document.getElementById("rfc");
  document.getElementById('guardar_cliente').disabled=false;
  document.getElementById('cancelar_cliente').disabled=false;
  document.getElementById('guarda_servicio').disabled=true;
  document.getElementById('cancela_servicio').disabled=true;
  document.getElementById("nom_servicio").value="";
 
  $('#nom_cliente').removeAttr("disabled");
  $('#nom_zona').removeAttr("disabled");
  $('#nom_servicio').attr('disabled','disabled');
  

});  

$("#crea_servicio").on("click", function(){
 // var x = document.getElementById("rfc");

  document.getElementById("nom_cliente").value="";
  document.getElementById("nom_zona").value="";
  document.getElementById("nuev_zona").value="";
  document.getElementById('guardar_cliente').disabled=true;
  document.getElementById('cancelar_cliente').disabled=true;
  document.getElementById('guarda_servicio').disabled=false;
  document.getElementById('cancela_servicio').disabled=false;
 
 
  $('#nom_cliente').attr('disabled','disabled');
  $('#nom_zona').attr('disabled','disabled');
  $('#nom_servicio').removeAttr("disabled");
  $('#nom_zona').attr('checked', false);
  $('#nuev_zona').attr('disabled','disabled');
 

  

}); 

$("#nueva_zona").on("click", function(){
	 // var x = document.getElementById("rfc");

	  document.getElementById("nom_zona").value="";
	 
	  //$('#nom_cliente').attr('disabled','disabled');
	  $('#nuev_zona').removeAttr("disabled");
	  $('#nom_zona').attr('disabled','disabled');
	 
	});


$("#zona").on("click", function(){
	 // var x = document.getElementById("rfc");

	  document.getElementById("nuev_zona").value="";
	 
	  //$('#nom_cliente').attr('disabled','disabled');
	  $('#nom_zona').removeAttr("disabled");
	  $('#nuev_zona').attr('disabled','disabled');
	  



	}); 
</script>