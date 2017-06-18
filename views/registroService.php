<?php 

if(isset($_GET["first_name"]) && isset($_GET["last_name"]) && isset($_GET["email"]) && isset($_GET["password"]))
{
	// echo "<pre>";
	// var_dump($_GET);
	// echo "</pre>";

	$servername = "localhost";
	$username = "root";
	$password = "root";
	$dbname = "coders";
	$puerto = "3636";
	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $dbname);

	if (!$conn) {
	    die("No se pudo conectar: ".mysqli_connect_error());
	}

	$nombre = $_GET["first_name"];
	$apellido = $_GET["last_name"];
	$email = $_GET["email"];
	$pass = $_GET["password"];
	$fecha = date("Y-m-d");

	$sql = "SELECT * FROM usuarios WHERE username='$email'";
	$result = mysqli_query($conn, $sql);
	
	// echo "<pre>";
	var_dump($result);
	// echo "</pre>";

	if (mysqli_num_rows($result) > 0) {
    // output data of each row
	    while($row = mysqli_fetch_assoc($result)) {
			echo "<pre>";
			var_dump($row);
			echo "</pre>";
	    }
	}

	// $sql = "INSERT INTO usuarios(nombre, apellido, username, password, fecha) VALUES ('$nombre', '$apellido', '$email', '$pass', '$fecha')";

	// $res = mysqli_query($conn, $sql);

	// var_dump($res);


}
else
{
	echo "Todos los datos son necesarios";
}


?>