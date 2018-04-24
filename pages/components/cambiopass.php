   <style type="text/css">
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
   </style>
<script>
            function comprobarClave(){
   	    cambiopass = document.f1.cambiopass.value
   	    clave2 = document.f1.clave2.value

    if(cambiopass != "" && clave2 != ""){
   	if (cambiopass == clave2 ){
       return true;
   	 }else{
         alert("Las claves no son iguales");


          }
    }
    return false;
}

    </script>


      <div class="row">
        <!-- right column -->
        <div class="col-md-12 col-md-offset-0">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <!-- form start -->
            <form action = "pages/backend/cambiopass.php" onsubmit="return comprobarClave()" method="post"  name="f1"  class="form-horizontal">
              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Contraseña</label>
                    <input type="hidden" id="user_id" value="<?php echo $user_id ?>">

                  <div class="col-sm-10 has-feedback">
                    <input type="password" class="form-control" id="cambiopass" name="cambiopass" required placeholder="Contraseña">
                      <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                  </div>
                </div>
                <div class="form-group ">
                  <label for="inputPassword3" class="col-sm-2 control-label">Repetir contraseña</label>


                  <div class="col-sm-10 has-feedback">
                    <input type="password" class="form-control" id="clave2" name="clave2" required placeholder="Repetir contraseña">
                      <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                  </div>
                </div>
                  <br>

              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <a href="index.php"><button type="button" class="btn btn-danger">Cancelar</button></a>
                <button type="submit" value="Comprobar si son iguales" class="btn btn-success pull-right">Guardar</button>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
          <!-- /.box -->
          <!-- general form elements disabled -->

        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
