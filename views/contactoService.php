<?php 
session_start();
require_once "conexion.php";

function call($conn, $sql)
{
	$result = mysqli_query($conn, $sql);
	$data = array();
	if (mysqli_num_rows($result) > 0) {
    // output data of each row
	    while($row = mysqli_fetch_assoc($result)) {			
			$data[] = $row;
	    }	    
	}
	return $data;
}

function obtener_contactos($conn)
{
	$idusuario = $_SESSION["usuario"];
	$sql = "SELECT * FROM contactos WHERE idusuario = '$idusuario'";
	$res = call($conn, $sql);

	if(count($res) > 0)
	{
		return array("success" => true, "data" => $res);
	}
	else
	{
		return array("success" => false);
	}
}

$res = array();

if(isset($_GET["obtener"]))
{
	$res = obtener_contactos($conn);
}

echo json_encode($res);


?>