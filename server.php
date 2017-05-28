<?php 
session_start();


$password_correcta = "012345";

if(isset($_POST["email"]) && isset($_POST["password"]))
{
	if($_POST["password"] == $password_correcta)
	{
		// echo "PASS CORRECTA";
		$_SESSION["login"] = true;
		$res = array(
			"correcta" => true, 
			"mensaje" => "PASS CORRECTA"
		);
	}
	else
	{
		// echo "EL PASS NO COINCIDE";
		$res = array(
			"correcta" => false, 
			"mensaje" => "EL PASS NO COINCIDE"
		);	
	}
}
else
{	
	// echo "Faltan datos";
	$res = array(
		"correcta" => false, 
		"mensaje" => "FALTAN DATOS"
	);
}

echo json_encode($res);

?>