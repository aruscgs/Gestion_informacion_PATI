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

<?php


$query ="SELECT correo FROM new_personas where cedula='$userinfo->user_id'";
$mail = $wish->conexion->query ( $query );

?>
      <div class="row">
        <!-- /.col -->
        <div class="col-md-12 col-md-offset-0">
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Crear una sugerencia</h3>
            </div>
            <!-- /.box-header -->
            <form  method="post" action="pages/backend/enviarsugerencia.php">
            <div class="box-body">
              <div class="form-group">

                  <!--  Elementos ocualtos  -->
                <input  class="form-control" name="correo" id="correo" type="hidden" value="<?php while ( $row = $mail->fetch_array ( MYSQLI_NUM ) ) {echo $row [0];}?>" >
                <input  class="form-control" name="nombre" type="hidden" id="nombre" value="<?php echo $_SESSION['user_name']; ?>">
              </div>
              <div class="form-group">
                <input class="form-control" id="encabezado" name="encabezado" required placeholder="Encabezado:">
              </div>
              <div class="form-group">
                    <textarea id="compose-textarea" id="mensaje" name="mensaje" required class="form-control"  style="height: 300px">

                    </textarea>
              </div>
            </div>


            <!-- /.box-body -->
            <div class="box-footer">
              <div class="pull-right">

                <button type="submit" class="btn btn-success"><i class="fa fa-envelope-o"></i> Enviar</button>
              </div>
              <a href="index.php"><button type="reset" class="btn btn-danger"><i class="fa fa-times"></i> Cancelar</button></a>
            </div>
            <!-- /.box-footer -->

       </form>

       </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
      </div>

<script src="plugins/iCheck/icheck.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Page Script -->
<script>
  $(function () {
    //Add text editor
    $("#compose-textarea").wysihtml5();
  });
</script>
