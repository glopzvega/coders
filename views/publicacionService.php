<?php 
session_start();
if(isset($_POST["contenido"]))
{
	require_once "conexion.php";

	$contenido = $_POST["contenido"];
	$fecha = date("Y-m-d");
	$usario = $_SESSION["usuario"];

	$sql = "INSERT INTO publicacion(usuario, fecha, contenido) VALUES ('$usuario', '$fecha', '$contenido')";

	$result = mysqli_query($conn, $sql);

	if($result)
	{
		$res = array("success" => true, "mensaje" => "Se ha registrado correctamente");
		echo json_encode($res);		
	}
	else
	{
		$res = array("success" => true, "mensaje" => "Ocurrio un error al registrar la publicacion");
		echo json_encode($res);			
	}
}
else
{
	$res = array("success" => false, "mensaje" => "Todos los datos son necesarios");
	echo json_encode($res);
}

?>