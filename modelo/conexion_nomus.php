<?php
// Conectar al servicio XE (es deicr, la base de datos) en la m�quina "localhost"
class NomusIntegracion {
	
	public function getUsuariosNomus() {
		$conn = oci_connect ( "GTI_User", "4ghVKOcCBTOtdr8OuHzX", "10.0.0.11:1521/NOMUS" );
		if (! $conn) {
			$e = oci_error ();
			trigger_error ( htmlentities ( $e ['message'], ENT_QUOTES ), E_USER_ERROR );
		}
		$stid = oci_parse ( $conn, 'select * from MAESTRA_GTI' );
		oci_execute ( $stid );
		$registros = array ();
		while ( $row = oci_fetch_array ( $stid, OCI_ASSOC + OCI_RETURN_NULLS ) ) {
			array_push ( $registros, $row );
		}
		return $registros;
	}
}

