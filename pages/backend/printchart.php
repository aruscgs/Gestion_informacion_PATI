<?php

include("../../modelo/conexion.php");
$wish = new conexion;
$query = file_get_contents('php://input');
$stmt = $wish->pdo_conn->prepare ( $query );
$stmt->execute ();
$resultArray = array ();
while ( $obj = $stmt->fetchAll ( PDO::FETCH_OBJ ) ) {
foreach ( $obj as $row ) {
$row->columna = utf8_encode ( $row->columna );
}
$resultArray = $obj;
}
echo json_encode ( $resultArray );

?>



