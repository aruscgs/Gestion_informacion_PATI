<style>
.skin-blue .main-header .logo {
  /* background-color: #367fa9;*/
  background: -webkit-gradient( linear, left top, left bottom, color-stop(0.05, #006699), color-stop(1, #008FD6) );
  color: #fff;
  border-bottom: 0 solid transparent;
}
#logoarusheader{
width: 100px;

}

.main-header .navbar {
  -webkit-transition: margin-left .3s ease-in-out;
  -o-transition: margin-left .3s ease-in-out;
  transition: margin-left .3s ease-in-out;
  margin-bottom: 0;
  margin-left: 230px;
  border: none;
  min-height: 50px;
  white-space: nowrap;
  background: -webkit-gradient( linear, left top, left bottom, color-stop(0.05, #006699), color-stop(1, #008FD6) );
  /* background: -webkit-linear-gradient(top, #1652cc 0%,#0492e4 100%); */
  background: -o-linear-gradient(top, #333333 0%,#0B0B0B 100%);
  background: -ms-linear-gradient(top, #333333 0%,#0B0B0B 100%);
  border-radius: 0;
}
.navbar-nav>.user-menu>.dropdown-menu>.user-footer .btn-default {
    /* color: #666666; */
    background: -webkit-gradient( linear, left top, left bottom, color-stop(0.05, #af0000), color-stop(1, #ff1010) );
    color: white;
}

.navbar-nav>.user-menu>.dropdown-menu>li.user-header {
    height: 175px;
    padding: 10px;
    text-align: center;
    background: -webkit-gradient( linear, left top, left bottom, color-stop(0.05, #006699), color-stop(1, #008FD6) );
}
.navbar-nav>.user-menu>.dropdown-menu>.user-footer {
    /* background-color: #f9f9f9; */
    padding: 10px;
    background: linear-gradient(to right, #FFF8F8 0%, #d1d0e6b8 0%, #FFFFFF 100%);
    border-color: black;
    box-shadow: inset rgba(255,254,255,0.6) 0 0.3em .3em, inset rgba(0,0,0,0.15) 0 -0.1em .3em, /* inner shadow */ hsl(0, 0%, 60%) 0 .1em 3px, hsl(0, 0%, 45%) 0 .3em 1px, /* color border */ rgba(0,0,0,0.2) 0 .5em 5px;
    border: 26px1;
}
</style>


  <header class="main-header">
    <!-- Logo -->
    <a href="index.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>GTI</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class=><img id="logoarusheader" src="dist/img/aruslogo-footer.png" alt=""> <small>GTI</small></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="dist/img/avatar5.png" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $userinfo->user_name;?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="dist/img/avatar5.png" class="img-circle" alt="User Image">

                <p >
                  <?php echo $userinfo->cargo;?>
                </p>

              </li>
              <!-- Menu Footer-->
              <li class="user-footer">

                <div class="pull-right">
                  <a href="seguridad/salida.php" class="btn btn-default btn-flat">Cerrar sesión</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
