<style type="text/css">
.skin-blue .sidebar-menu>li.header {
		white-space: nowrap;
		overflow: hidden;
		background: -webkit-linear-gradient(top, #333333 0%,#0B0B0B 100%);
		background: -o-linear-gradient(top, #333333 0%,#0B0B0B 100%);
		background: -ms-linear-gradient(top, #333333 0%,#0B0B0B 100%);
		/* color: #4b646f; */
		/* background: -webkit-linear-gradient(top, #333333 0%,#0B0B0B 100%); */
		background: -o-linear-gradient(top, #333333 0%,#0B0B0B 100%);
		background: -ms-linear-gradient(top, #333333 0%,#0B0B0B 100%);
		color: white;
		/* background: #1a2226; */
}



.skin-blue .wrapper, .skin-blue .main-sidebar, .skin-blue .left-side {
		background-color: #202021;
		font-style: italic;
}

.bg-light-blue, .label-primary, .modal-primary .modal-body {
		background-color: #184ca7 !important;
}

.sidebar-menu .treeview-menu>li>a {
		padding: 5px 5px 5px 15px;
		display: block;
		font-size: 14px;
		background-color: black;
}

.sidebar-menu .treeview-menu>li>a {
		padding: 5px 5px 5px 15px;
		display: block;
		font-size: 14px;
		background-color: #363c42;
		color: snow;
}

.user-panel {
		position: relative;
		width: 100%;
		padding: 10px;
		overflow: hidden;
		white-space: nowrap;
		overflow: hidden;
		background: -webkit-linear-gradient(top, rgba(0, 0, 0, 0) 0%,#4589cd 100%);
		background: -o-linear-gradient(top, #333333 0%,#0B0B0B 100%);
		background: -ms-linear-gradient(top, #333333 0%,#0B0B0B 100%);
}

.user-panel>.image>img {
		width: 100%;
		max-width: 172px;
		height: auto;
}




.skin-blue .sidebar-menu>li:hover>a, .skin-blue .sidebar-menu>li.active>a {
		color: #fff;
		font-style: italic;
		font-size: 14px;
		font-style: italic;
		font-size: 14px;
		/* font-family: -webkit-pictograph; */
		background: #000000;
		border-left-color: #ffffff;
		white-space: nowrap;
		overflow: hidden;
		/* background: -webkit-linear-gradient(top, #332cd8 0%,#191727 100%); */
		background: -webkit-linear-gradient(top, #333333 0%,#0B0B0B 100%);
		background: -o-linear-gradient(top, #333333 0%,#0B0B0B 100%);
		background: -ms-linear-gradient(top, #333333 0%,#0B0B0B 100%);
}


.skin-blue .sidebar a {
		color: #ffffff;
}
</style>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
	<!-- sidebar: style can be found in sidebar.less -->
	<section class="sidebar">
		<!-- Sidebar user panel -->
		<div class="user-panel">
			<div class="pull-left image">
				<img src="dist/img/PATI-05.png" class="img-circle" alt="User Image">
			</div>
			<div class="pull-left info">
				<br>

			</div>
		</div>
		<!-- sidebar menu: : style can be found in sidebar.less -->
		<ul class="sidebar-menu">
			<li class="header">MENU PRINCIPAL</li>

			<?php
			foreach ($vista->_PAGE_CONFIG as $page => $params){
				$show = true;
				if(array_key_exists($rol,$vista->_PAGE_PERMISSIONS)){
					$pages_perm = $vista->_PAGE_PERMISSIONS[$rol];
					$show = !array_key_exists($page,$pages_perm);
				}
				if($params["show"] && $show){
						if(!$params["isSubmenu"]){
						$menutxt = $params["menu"];
						$menucss = $params["menu_css_class"];
						if(!array_key_exists("submenu",$params)){
						?>
							<li class="<?php if($vista->page == $page){ echo " active "; } ?>">
								<a href="index.php?page=<?php echo $page; ?>"  > <i class="fa <?php echo $menucss; ?>"></i>
									<span><?php echo $menutxt; ?></span>
								</a>
							</li>
						<?php
						}else{
							$submenu = $params["submenu"];
							$submenucss = $params["menu_css_class"];
							?>
								<li class="treeview <?php if($vista->page == $page){ echo " active "; } ?>">
								<a href="#"  > <i class="fa  <?php echo $submenucss;?>"></i>
									<span><?php echo $menutxt; ?></span>
									<span class="pull-right-container">
										<span class="label label-primary pull-right "><i class="fa fa-sort-down"></i></span>
									</span>
								</a>
								<ul class="treeview-menu">
									<?php
									foreach ($submenu as $sub_page){
										$subshow = !array_key_exists($sub_page,$pages_perm);
										if($subshow){
											$sub_menutxt = $vista->_PAGE_CONFIG[$sub_page]["menu"];
											$sub_menucss = $vista->_PAGE_CONFIG[$sub_page]["menu_css_class"];
											?>
												<li class="<?php if($vista->page == $sub_page){ echo " active "; } ?>">
												<a href="index.php?page=<?php echo $sub_page; ?>" ><i class="fa <?php echo $sub_menucss; ?>"></i>
													<?php echo $sub_menutxt; ?>
												</a></li>
											<?php
										}
									}
									?>
								</ul>
								</li>
							<?php
						}
					}
				}
			}
			?>




<!-- <li class="treeview"><a href="#"> <i class="fa fa-history"></i> <span>Reporte
						Historico</span> <span class="pull-right-container"> <i
						class="fa fa-angle-left pull-right"></i>
				</span>
			</a>
				<ul class="treeview-menu">
					<li><a href="download.php?file=Enero2017.xlsx"><i
							class="fa fa-file-excel-o"></i> Enero</a></li>
					<li><a href="download.php?file=Febrero2017.xlsx"><i
							class="fa fa-file-excel-o"></i>Febrero</a></li>
					<li><a href="download.php?file=Marzo2017.xlsx"><i
							class="fa fa-file-excel-o"></i> Marzo</a></li>
					<li><a href="download.php?file=Abril2017.xlsx"><i
							class="fa fa-file-excel-o"></i> Abril</a></li>
					<li><a href="download.php?file=Mayo2017.xlsx"><i
							class="fa fa-file-excel-o"></i> Mayo</a></li>
					<li><a href="download.php?file=Junio2017.xlsx"><i
							class="fa fa-file-excel-o"></i> Junio</a></li>
					<li><a href="download.php?file=Julio2017.xlsx"><i
							class="fa fa-file-excel-o"></i> Julio</a></li>
					<li><a href="download.php?file=Agosto2017.xlsx"><i
							class="fa fa-file-excel-o"></i> Agosto</a></li>
					<li><a href="download.php?file=Septiembre2017.xlsx"><i
							class="fa fa-file-excel-o"></i> Septiembre</a></li>
					<li><a href="download.php?file=Octubre2017.xlsx"><i
							class="fa fa-file-excel-o"></i> Octubre</a></li>


				</ul></li> -->












			<li><a href="https://gticonocimiento.arus.com.co/"   target="_blank"  ><i class="fa fa-globe" aria-hidden="true"></i> <span>Gestión del Conocimiento</span></a></li>


 <li><a href="http://gticursos.arus.com.co/wp-login.php?loggedout=true"   target="_blank"  ><i class="fa fa-globe" aria-hidden="true"></i> <span>GTI Cursos</span></a></li>



		</ul>

	</section>
	<!-- /.sidebar -->

</aside>
