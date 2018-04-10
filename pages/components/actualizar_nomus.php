
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