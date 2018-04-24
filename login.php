<!DOCTYPE html>
<?php
session_start ();
if (isset ( $_SESSION ['authenticated'] )) {
	if ($_SESSION ['authenticated'] == 1) {
		header ( "Location: index.php" );
	}
}
?>
<html lang="en">

<head>
<title>SISTEMA DE INFORMACIÓN GTI</title>
<!-- Meta tag Keywords -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!--  <script type="application/x-javascript">
        addEventListener("load", function() {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>-->
<!-- Meta tag Keywords -->
<!-- css files -->
<link href="https://fonts.googleapis.com/css?family=Allan" rel="stylesheet">
<link type="text/css" rel="stylesheet"
	href="dist/css/pages/cronometro.css">
<!-- Style-CSS -->
<link rel="stylesheet" href="dist/css/font-awesome.css">
<!-- Font-Awesome-Icons-CSS -->
<link
	href="//fonts.googleapis.com/css?family=Muli:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;subset=latin-ext,vietnamese"
	rel="stylesheet">
<!-- Favicon -->
<link rel="shortcut icon" href="dist/img/favicon.ico">
<link rel="stylesheet" href="plugins/alertify.default.css">
<link rel="stylesheet" href="plugins/alertify.core.css">
<script src="plugins/alertify.min.js"></script>


<style type="text/css">
.stroke {
-webkit-text-fill-color: yellowgreen;
-webkit-text-stroke: 1px black;
}
img#sac {
    position: absolute;
    left: 0px;
    top: 120px;
}
.header-main:after {
    content: '';
    position: absolute;
    top: 0;
    right: 0;
    width: 0;
    height: 0;
    border-top: 182px solid #636362;
    border-right: 0px solid transparent;
    border-left: 209px solid transparent;
}


.header-left-bottom input[type="button"] {
    background: #4267B2;
    color: #FFF;
        font-size: 2vh;
        background: -webkit-gradient( linear, left top, left bottom, color-stop(0.05, #006699), color-stop(1, #008FD6) );
        margin-top: 20px;
    text-transform: uppercase;
    padding: .5em 2em;
    letter-spacing: 0px;
    transition: 0.5s all;
    -webkit-transition: 0.5s all;
    -moz-transition: 0.5s all;
    -o-transition: 0.5s all;
    display: inline-block;
    cursor: pointer;
    outline: none;
    border: none;
        border-radius: 10px;
    font-family: initial;
}

img {
    max-width: 100%;
}

.header-left-bottom p a {
    font-size: 17px;
    color: #636362;
}
.header-main:before {
    content: '';
    position: absolute;
    top: 0px;
    left: 0px;
    max-width: 0%;
    height: 0;
    border-top: 170px solid #002857;
    border-right: 230px solid transparent;
    border-left: 0px solid transparent;
    z-index: 1;
}
.header-left-bottom input[type="email"] {
    outline: none;
    font-size: 19px;
    color: #000;
    border: none;
    width: 90%;
    display: inline-block;
    background: transparent;
    font-family: initial;
    text-align: center;
    letter-spacing: 2px;
    font-size: 3rem;
    margin-top: 40px;
      font-size: 3vh;
}




.header-main {
    width: 23%;
    border-radius: 50px;
		box-shadow: 2px 1px 12px 4px rgba(119, 119, 119, 0.76);
		-moz-box-shadow: 2px 1px 12px 4px rgba(119, 119, 119, 0.76);
		-webkit-box-shadow: 2px 1px 12px 4px rgba(119, 119, 119, 0.76);
    background: -webkit-gradient( linear, left top, left bottom, color-stop(0.5, #ffffff), color-stop(1, #bec4c6) );
    text-align: center;
    position: relative;
    z-index: 999;
    padding: 12em 4em 2.5em;
    max-width: 100%;
     margin: -48px auto;
	}



#title_login{
	    text-shadow: 0 0 0.2em #1000ff, 0 0 0.2em #3e00ff, 0 0 0.2em #0008ff;
			font-family: 'Allan', cursive;
			text-align: center;
			text-transform: uppercase;
			font-weight: 500;
			font-size: 50px;
			letter-spacing: 15px;
}


#logo_arus{
 margin-bottom: -32px;
    margin-top: -50px;
    width: 258px;}

#img_cab {
    max-width: 100%;
    width: 100%;
    height: auto;
}

.header-left-bottom input[type="password"] {
    outline: none;
    font-size: 19px;
    color: #000;
    border: none;
    width: 90%;
    margin-top: 15px;
    display: inline-block;
    font-size: 25px;
    background: transparent;
    font-family: initial;
    text-align: center;
        font-size: 3vh;
    letter-spacing: 2px;
   font-size: 3vh;
}
.header-left-bottom p a {
    /* font-size: 22px; */
    color: #636362;
       font-size: 3vh;
}
</style>

<!-- //css files -->
</head>

<body>
	<!-- main -->
	<div class="w3ls-header">
	<div style="background: white;

    height: 250px;" class="form-control">
    <img id="img_cab" src="dist\img\cabezotelogin.png" class="form-control">
    </div>

		<div class="header-main">
						<img id="logo_arus" src="dist/img/unnamed.png">

			<div class="header-bottom">
				<div class="header-right w3agile">
					<div class="header-left-bottom agileinfo">
						<form class="form" style="max-width: 400px;"
							action="seguridad/login.php" method="POST">
							<div class="icon1">

								<input type="email" id="correo" value="@arus.com.co"
									name="correo" required>
							</div>
							<div class="icon1">

								<input type="password" id="password" name="password"
									placeholder="Contraseña" required>
							</div>


							<div class="bottom">
								<input id='envia' type="button" value="Ingresar" />
							</div>
							<p id="mensaje" style="color: red;"></p>
							<p>
								<a href="recuperar.php"><i class="fa fa-key" aria-hidden="true"></i>
									Olvidaste la contraseña ?

							</p>
							</a>

						</form>
					</div>
				</div>
			</div>

		</div>
	</div>


	<!-- jQuery 2.2.3 -->
	<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
	<!-- Bootstrap 3.3.6 -->
	<script src="bootstrap/js/bootstrap.min.js"></script>







	<!--  <script src="dist/js/pages/operaciones.js"></script>-->

	<script>
            $( document ).ready(function() {




                $('#envia').click(function(){
                    var correo = $('#correo').val();
                    var password = $('#password').val();
                    console.log(correo);
                    console.log(password);
                    if(correo != '' && password != ''){


                        $.ajax({
                            url: 'seguridad/login.php',
                            method: 'POST',
                            data: {correo: correo, password: password},
                            success: function(data){

                                $('#mensaje').html(data);

                                  if(msg=='1'){

                                   // $("#envia").click(function (){
                                        $('#mensaje').html('DATOS INCORRECTOS');
                                   // });
                                }else{


                                    window.location = msg;
                                }
                            }
                        });

                    }else if(correo=='' || password ==''){

                    	alertify.error("Campos vacios!");

                      // $('#mensaje').html('INGRESE LOS DATOS');
                    }
                });

                $("input").keypress(function(event) {
                    if (event.which == 13) {
                        event.preventDefault();
                        $('#envia').click();
                    }
                });

            });


        </script>

</body>

</html>
