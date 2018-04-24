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
<div class="row">
	<!-- Left col -->
	<section class="col-lg-12 connectedSortable">

		<!-- Custom tabs (Charts with tabs)-->
		<div class="nav-tabs-custom">
			<input type="hidden" id="user_id" value="<?php echo $user_id ?>">
			<!-- Tabs within a box -->
			<ul class="nav nav-tabs pull-right">

				<li class="pull-left header"><i class="fa fa-clock-o"></i>
					Actualización de usuarios desde Nomus</li>
			</ul>
			<br>

			<br>
			<div class="col-md-offset-5">
			<?php
			if (isset ( $_GET ["actualizar"] )) {
				if ($_GET ["actualizar"] == 1) {
					$wish->actualizarPersonasNomus();
					?>
					<div class="col-md-offset-0">
						<h3>Actualización Exitosa!</h3>
						<br>
					</div>
					<?php
				}
			}

			?>


				<a href="index.php?page=018&actualizar=1" class="btn btn-app"> <i
					class="fa fa-user-plus"></i> Actualizar Usuarios
				</a>
			</div>
		</div>

	</section>

</div>
