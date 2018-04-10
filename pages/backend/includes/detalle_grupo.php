
<?php
session_start ();
if ($_SESSION ['authenticated'] == 1) {

	include("../../../modelo/conexion.php");
	$con = new conexion;
	$oe=$_POST['id_escala'];
	$contrato=$_POST["contrato"];
	//echo $contrato;
	//$id_host=$_POST['id_host'];
	//$ip=$_POST['ips'];

		
/*$query = $con->conexion->query("SELECT a.nombre, a.correo, a.celular, b.area,  c.contacto, c.contrato, a.cedula FROM new_personas a,
								areas b, sub_grupo c, new_usuario d, escalamiento e WHERE c.cedula=a.cedula and a.cedula=d.cedula 
								and b.id=d.area and e.id_persona=a.cedula and e.id_detalle=$oe;");
	*/
	
$query = $con->conexion->query("SELECT a.nombre, a.correo, a.celular, b.area, e.nivel_escala,
 a.cedula FROM new_personas a, areas b, new_usuario d, escalamiento e WHERE e.id_persona=a.cedula
 and a.cedula=d.cedula and b.id=d.area and e.id_detalle=$oe;");


		

	echo"	
	<form method='post' action='index.php?page=027'>
<input type=''hidden value='$oe' name='id_detalle'>
<input type=''hidden value='' name='ip'>
<input type=''hidden value='$contrato' name='contrato'>
<div style=' width: 101.5%; height:320px; overflow: scroll;'>
	<table class='table table-bordered table-striped table-hover'>
		<tr>
			<th style='width:30%;'>Reportar</th>
			<th style='width:30%;'>Nombre</th>
			<th style='width:10%;'>Contacto</th>
			<th style='width:30%;'>Número</th>
			<th style='width:30%;'>Correo</th>
			<th style='width:15%;'>Grupo</th>
	
		</tr>";

	while ($row2 = $query->fetch_row())
	{
	    if($row2[4]=="0"){
	        
	        $row2[4]="<b><font color='red'>No diligenciado.</font></b>";
	    }
	    
		echo"
			 <tr>
				<td><input required type='radio' value='".$row2[5]."' name='otro'></td>
			    <td>".ucwords(strtolower($row2[0]))."</td>
			    <td>$row2[4]</td>
			    <td>$row2[2]</td>
			    <td>$row2[1]</td>
			    <td>$row2[3]</td>
		
			</tr>";
	}	
			echo "<tr><td><button value='$oe' name='id_detalle' class='btn btn-default'>Registrar</button></td></tr>";
	echo "
			
			</form></table></div>";

}