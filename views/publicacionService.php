<?php 
session_start();
if(isset($_POST["contenido"]))
{
	require_once "conexion.php";

	$contenido = $_POST["contenido"];
	$fecha = date("Y-m-d");
	$usario = $_SESSION["usuario"];
	
	$sql = "INSERT INTO publicacion()"
}
else
{
	$res = array("success" => false, "mensaje" => "Todos los datos son necesarios");
	echo json_encode($res);
}

?>