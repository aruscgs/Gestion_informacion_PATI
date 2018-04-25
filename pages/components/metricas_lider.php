<style type="text/css">

.bg-blue {
    /* background-color: #2196F3 !important; */
    background: -webkit-gradient( linear, left top, left bottom, color-stop(0.05, #006699), color-stop(1, #008FD6) );
    color: #fff;
}
.bg-green {
    background: -webkit-gradient( linear, left top, left bottom, color-stop(0.05, #0b860a), color-stop(1, #26d600) );
}
.bg-yellow{
background: -webkit-gradient( linear, left top, left bottom, color-stop(0.05, #c5a70a), color-stop(1, #ffda01) );
}
.bg-red{
    background: -webkit-gradient( linear, left top, left bottom, color-stop(0.05, #af0000), color-stop(1, #ff1010) );
    }
    .bg-aqua, .callout.callout-info, .alert-info, .label-info, .modal-info .modal-body {
    /* background-color: #00c0ef !important; */
    background: -webkit-gradient( linear, left top, left bottom, color-stop(0.05, #16b1c0), color-stop(1, #10c8ff) );
}
.info-box {
   box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
   height: 80px;
   display: flex;
   background: -webkit-linear-gradient(left, #677e86 -100%,#ffffff 70%);
   border-radius: 50px;
}

.info-box .content {
    display: inline-block;
    padding: 0px 10px;
}

.info-box .content .text {
    font-size: 15px;
    font-family: -webkit-pictograph;
    margin-top: 8px;
    color: rgba(84, 83, 83, 0.95);
    font-weight: bold;
}
.info-box .content .number {
    font-weight: normal;
    font-size: 26px;
    font-family: -webkit-pictograph;
    margin-top: -4px;
    color: #555;
}
</style>

<?php

$numanalista = $wish->getColaboradoresFromLider($userinfo->user_id);
$numeroactividades = $wish->getProductividadColaboradores($userinfo->user_id);
$contratos = $wish->getContratosByLider($userinfo->user_id);
$pendientes = $wish->getPendientesByLider($userinfo->user_id);


?>
 <div class="row">
	<div class="col-md-3 col-sm-6 col-xs-12">
		<div class="info-box hover-zoom-effect">
			<div class="icon bg-aqua">
				<i class="fa fa-users" aria-hidden="true"></i>
			</div>
			<div class="content">
				<div class="text">N° Colaboradores</div><br>
				<div class="number">
                    <?php
						while ( $row = $numanalista->fetch_array ( MYSQLI_NUM ) ) {
						echo $row [0] . "<br/>\n";
						}
							?></div>
			</div>
		</div>
	</div>


	<div class="col-md-3 col-sm-6 col-xs-12">
		<div class="info-box hover-zoom-effect">
			<div class="icon bg-red">
				<i class="fa fa-line-chart" aria-hidden="true"></i>
			</div>
			<div class="content">
				<div class="text">Productividad</div><br>
				<div class="number">
                    <?php
										while ( $row = $numeroactividades->fetch_array ( MYSQLI_NUM ) )
										{
										echo round ( $row [0] ) . "<br/>\n";
										}
								?></div>
			</div>
		</div>
	</div>

	<div class="col-md-3 col-sm-6 col-xs-12">
		<div class="info-box hover-zoom-effect">
			<div class="icon bg-green">
				<i class="fa fa-file" aria-hidden="true"></i>
			</div>

			<div class="content">
				<div class="text">N° Contratos</div><br>
				<div class="number">
				<a href="index.php?page=011">
                    <?php
									while ( $row = $contratos->fetch_array ( MYSQLI_NUM ) ) {
									echo $row [0] . "<br/>\n";
									}
								 ?></a></div>

			</div>
		</div>
	</div>

	<div class="col-md-3 col-sm-6 col-xs-12">
		<div class="info-box hover-zoom-effect">
			<div class="icon bg-yellow">
				<i class="fa fa-envelope-o" aria-hidden="true"></i>
			</div>

			<div class="content">
				<div class="text">N° Pendientes</div><br>
				<div class="number">
				<a href="index.php?page=010">
                    <?php
									while ( $row = $pendientes->fetch_array ( MYSQLI_NUM ) ) {
									echo $row [0] . "<br/>\n";
									}
								?></a></div>
			</div>
		</div>
	</div>


      </div>
      <!-- /.row -->
