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
<link rel="stylesheet" href="dist/css/login.css" type="text/css"media="all" />
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
<link rel="stylesheet" href="login.css">
<script src="plugins/alertify.min.js"></script>

<!-- //css files -->
</head>

<body>
	<!-- main -->
	<div class="w3ls-header">
		<h1 id="title_login">PLATAFORMA ADMINISTRACION DE T.I</h1>
		<div class="header-main">
			<img id="logoPati" src="dist\img\PATI - SOLUCIONES-07.png" alt="Smiley face" height="100" width="100";
			style="margin-left: -117px; margin-left: 0px; width: 224px; height: 202px; margin-top: -103px; margin-bottom: -20px;">


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
									olvidaste la contraseña ?

							</p>
							</a>

						</form>
						<img src="dist/img/unnamed.png" style="margin-bottom: -32px; width: 107px;">
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
