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
				$res = array("success" => true, "mensaje" => "LOGIN EXITOSO");
				echo json_encode($res);
			}
			else
			{
				$res = array("success" => false, "mensaje" => "LOS DATOS DE ACCESO SON INCORRECTOS");
				echo json_encode($res);	
			}
	    }
	}
	else
	{
		$res = array("success" => false, "mensaje" => "El usuario no existe");
		echo json_encode($res);			
	}
}
else
{
	$res = array("success" => false, "mensaje" => "Todos los datos son necesarios");
	echo json_encode($res);
}


?>