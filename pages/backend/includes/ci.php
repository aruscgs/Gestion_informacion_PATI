<?php  

include ('../../../modelo/conexion.php');
$oe= new conexion();
$id = $_GET['param_id'];


$conn = $oe->conexion->query("SELECT id, nombre, ip,plataforma FROM hosts WHERE id_contrato = '$id' and estado='A'");
  
echo '<option value="0"></option>';

$plataforma;

while($row = $conn->fetch_assoc())
	{
	    
	    if($row['plataforma'] == "NULL"){
	        
	        $plataforma="<font color='red'><b>No diligenciado</b></font>";
	        
	    }else{
	        
	        $plataforma=$row['plataforma'];
	    }
	    
		echo '<option value="'.$row['id']. '">'.$row['nombre']. " ----- ".  $row['ip']." ----- ".$plataforma.'</option>';
	}
	
$oe->cerrar();
?>

