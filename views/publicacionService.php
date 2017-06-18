<?php 
session_start();
if(isset($_POST["contenido"]))
{
	require_once "conexion.php";

	$contenido = $_POST["contenido"];
	$fecha = date("Y-m-d");
	$usuario = $_SESSION["usuario"];
	// var_dump($_SESSION);
	$sql = "INSERT INTO publicacion(usuario, fecha, contenido) VALUES ('$usuario', '$fecha', '$contenido')";
	// echo $sql;
	$result = mysqli_query($conn, $sql);

	if($result)
	{
		$res = array("success" => true, "mensaje" => "Se ha registrado correctamente");
		echo json_encode($res);		
	}
	else
	{
		$res = array("success" => false, "mensaje" => "Ocurrio un error al registrar la publicacion");
		echo json_encode($res);			
	}
}
else if(isset($_GET["obtener"]))
{
	require_once "conexion.php";
	
	$sql = "SELECT p.id, u.nombre, u.apellido, p.fecha, p.contenido, p.usuario FROM publicacion as p, usuarios as u WHERE p.usuario = u.id";

	$result = mysqli_query($conn, $sql);
	$data = array();
	if (mysqli_num_rows($result) > 0) {
    // output data of each row
	    while($row = mysqli_fetch_assoc($result)) {			
			$data[] = $row;
	    }
	}
	$res = array("success" => true, "data" => $data);
	echo json_encode($res);
}
else
{
	$res = array("success" => false, "mensaje" => "Todos los datos son necesarios");
	echo json_encode($res);
}

?>