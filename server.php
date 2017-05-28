<?php 

$password_correcta = "012345";

if(isset($_POST["email"]) && isset($_POST["password"]))
{
	if($_POST["password"] == $password_correcta)
	{
		echo "PASS CORRECTA";
	}
	else
	{
		echo "EL PASS NO COINCIDE";
	}
}
else
{	
	echo "Faltan datos";
}

?>