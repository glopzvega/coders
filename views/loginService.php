<?php 

if(isset($_POST["email"]) && isset($_POST["password"]))
{
	
	require_once "conexion.php";

	$email = $_POST["email"];
	$pass = $_POST["password"];
	$sql = "SELECT * FROM usuarios WHERE username = '$email'";
	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0) {
    // output data of each row
	    while($row = mysqli_fetch_assoc($result)) {
			if($row["password"] == $pass)
			{
				echo "LOGIN EXITOSO";
			}
			else
			{
				echo "LOS DATOS DE ACCESO SON INCORRECTOS";
			}
	    }
	}
	else
	{
		echo "El usuario no existe";
	}
}
else
{
	echo "Todos los datos son necesarios";
}


?>