<?php 

if(isset($_GET["first_name"]) && isset($_GET["last_name"]) && isset($_GET["email"]) && isset($_GET["password"]))
{
	// echo "<pre>";
	// var_dump($_GET);
	// echo "</pre>";

	require_once "conexion.php";

	$nombre = $_GET["first_name"];
	$apellido = $_GET["last_name"];
	$email = $_GET["email"];
	$pass = $_GET["password"];
	$fecha = date("Y-m-d");

	$sql = "SELECT * FROM usuarios WHERE username='$email'";
	$result = mysqli_query($conn, $sql);
	
	// echo "<pre>";
	// var_dump($result);
	// echo "</pre>";

	if (mysqli_num_rows($result) > 0) {
    // output data of each row
	  //   while($row = mysqli_fetch_assoc($result)) {
			// echo "<pre>";
			// var_dump($row);
			// echo "</pre>";
	  //   }
		echo "Ese email $email ya está registrado";
	}
	else
	{		
		$sql = "INSERT INTO usuarios(nombre, apellido, username, password, fecha) VALUES ('$nombre', '$apellido', '$email', '$pass', '$fecha')";

		$res = mysqli_query($conn, $sql);
		var_dump($res);
	}
}
else
{
	echo "Todos los datos son necesarios";
}


?>