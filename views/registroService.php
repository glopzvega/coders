<?php 

if(isset($_GET["first_name"]) && isset($_GET["last_name"]) && isset($_GET["email"]) && isset($_GET["password"]))
{
	echo "<pre>";
	var_dump($_GET);
	echo "</pre>";
}
else
{
	echo "Todos los datos son necesarios";
}


?>