<!DOCTYPE HTML>

<style type="text/css">

.header-main:after {
    content: '';
    position: absolute;
    top: 0;
    right: 0;
    width: 0;
    height: 0;
    border-top: 170px solid #636362;
    border-right: 0px solid transparent;
    border-left: 340px solid transparent;

}

.header-main {
    padding: 11em 4em 2.5em;
    width: 23%;
    border-radius: 50px;
		box-shadow: 2px 1px 12px 4px rgba(119, 119, 119, 0.76);
		-moz-box-shadow: 2px 1px 12px 4px rgba(119, 119, 119, 0.76);
		-webkit-box-shadow: 2px 1px 12px 4px rgba(119, 119, 119, 0.76);
    margin: 0 auto;
    background: -webkit-gradient( linear, left top, left bottom, color-stop(0.5, #ffffff), color-stop(1, #bec4c6) );
    text-align: center;
    position: relative;
    z-index: 999;
	}
.header-main:after {
    content: '';
    position: absolute;
    top: 0;
    right: 0;
    width: 0;
    height: 0;
    border-top: 170px solid #636362;
    border-right: 0px solid transparent;
    border-left: 209px solid transparent;
}


.header-left-bottom input[type="button"] {
    /* background: #40ad49; */
    background: -webkit-gradient( linear, left top, left bottom, color-stop(0.05, #006699), color-stop(1, #008FD6) );
    color: #FFF;
    font-size: 20px;
    border-radius: 15px;
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
    font-family: unset;
    margin-top: -20px;
        box-shadow: 0px 0px 11px 1px rgba(119, 119, 119, 0.76);
}

#logo_arus{
 margin-bottom: -32px;
    margin-top: -50px;
    width: 258px;}


.header-left-bottom input[type="email"] {
    outline: none;
    font-size: 19px;
    margin-top: 30px;
    margin-bottom: 13px;
    color: #000;
    border: none;
    width: 90%;
    display: inline-block;
    background: transparent;
    font-family: inherit;
    text-align: center;
    letter-spacing: 1px;
}

#guardar {
    /* background: #4267B2; */
    border-radius: 15px;
    color: #FFF;
    font-size: 17px;
    text-transform: uppercase;
    padding: .5em 3em;
    box-shadow: 0px 0px 11px 1px rgba(119, 119, 119, 0.76);
    letter-spacing: 0px;
    transition: 0.5s all;
    -webkit-transition: 0.5s all;
    -moz-transition: 0.5s all;
    -o-transition: 0.5s all;
    display: inline-block;
    cursor: pointer;
    outline: none;
    border: none;
    font-family: initial;
        background: -webkit-gradient( linear, left top, left bottom, color-stop(0.05, #006699), color-stop(1, #008FD6) );
}

#cancelar {
    background: rgba(66, 103, 178, 0.65);
    transition: 0.5s all;
    -webkit-transition: 0.5s all;
    -moz-transition: 0.5s all;
    -o-transition: 0.5s all;
    background: -webkit-gradient( linear, left top, left bottom, color-stop(0.05, #006699), color-stop(1, #008FD6) );
}
</style>
<html lang="en">

<head>
<title>SISTEMA DE INFORMACIÓN GTI</title>
<!-- Meta tag Keywords -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<script type="application/x-javascript">
        addEventListener("load", function() {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
<!-- Meta tag Keywords -->
<!-- css files -->
<link rel="stylesheet" href="dist/css/login.css" type="text/css"
	media="all" />
<!-- Style-CSS -->
<link rel="stylesheet" href="dist/css/font-awesome.css">
<!-- Font-Awesome-Icons-CSS -->
<link
	href="//fonts.googleapis.com/css?family=Muli:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;subset=latin-ext,vietnamese"
	rel="stylesheet">
<!-- Favicon -->


<!-- //css files -->
</head>

<body>
	<!-- main -->
	<div class="w3ls-header">
		<br>


		<div class="header-main">

			<img id="logo_arus" src="dist/img/unnamed.png"> <br> <br>
			<div class="header-bottom">
				<div class="header-right w3agile">
					<div class="header-left-bottom agileinfo">
						<form method="post" action="pages/backend/recuperar_pass.php">
							<div class="icon1">

								<input type="email" id="correo" value="@arus.com.co"
									name="correo" required>
							</div>

							<div class="bottom">


								<button id="guardar" class="btn btn-primary" type="submit">Enviar</button>





								<a href="login.php"> <input id="cancelar" type="button" value="Cancelar" /></a>
							</div>

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

</body>

</html>
