<?php 

if(isset($_POST["email"]) && isset($_POST["password"]))
{
	$res = array(
		"success" => true		
	);
}
else
{
	// $array1 = array(1, 2, 3, "Hola", "manzana", array());
	// echo $array(4); // manzana

	$res = array(
		"success" => false, 
		"error" => "Faltan datos"
	);

	// echo $res["error"];

}

print_r($res);

?>