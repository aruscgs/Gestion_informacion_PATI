<?php
include ("../../modelo/conexion.php");

$wish = new conexion ();

$correo = $_POST ['correo'];

$consulta = "SELECT password FROM new_usuario where correo='" . $correo . "'";

if ($consulta = $wish->conexion->query ( $consulta ))
	while ( $obj = $consulta->fetch_object () ) {
		$pass = $obj->password;
		
		$asunto = "Recordatorio de contraseña";
		$cuerpo = '
<head>
<base target="_blank">
</head>
<body bgcolor="ffffff" topmargin=0 leftmargin=0 marginheight=0 marginwidth=0>
<table width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="000033">
<tr>
<td align="center"> <b><font face="verdana,arial,helvetica" size="4" color=ffffff>Recuperar contraseÃ±a de BITÃ�CORA DE OPERACIONES</font></b></td>
</tr>
<tr>
</table>
<table width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="cccc66">
<tr>
<td bgcolor="black" align="center">
<a href="http://bitacora.compuredes.com.co:8082/vista/login2.php"></a>
<br>
</td>
</tr>
</table>
<br>
<table width="100%" cellspacing="0" cellpadding="2" border="0">
<tr>
<td valign="top">
<font face="verdana,arial,helvetica" size="3">
<h3>Tu contraseÃ±a actual es:' . $pass . '</h3>
<br>
<br>
<br>
<br>
<b><a href="http://bitacora.compuredes.com.co:8082/vista/login2.php">BITÃ�CORA DE OPERACIONES</a></b>
<br>
ESTO ES UNA NOTIFICACIÓN AUTOMATICA, POR FAVOR NO RESPONDER.
</td></tr></table>
</body>
</html>
';
		
		// para el envÃ­o en formato HTML
		$headers = "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
		
		// direcciÃ³n del remitente
		$headers .= "From: BitÃ¡cora de Operaciones <bitacora@compuredes.com.co>\r\n";
		
		$this_mail = mail ( $correo, $asunto, $cuerpo, $headers );
	}
$consulta->close ();

header ( "Location: ../../login.php" );

?>






