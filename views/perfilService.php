<?php 
session_start();

function actualizar_foto()
{
	$uploaddir = $_SERVER["DOCUMENT_ROOT"] . "/coders/img/perfiles/";
	
	$archivo = basename($_FILES['logo']['name']);
	$tipo = explode(".", $archivo)[1];
	$archivo = $_SESSION["usuario"] . "." . $tipo;

	$uploadfile = $uploaddir . $archivo;
	
	$idusuario = $_SESSION["usuario"];

	if (move_uploaded_file($_FILES['logo']['tmp_name'], $uploadfile)) {			
		$uploadfile = explode($uploaddir, $uploadfile);
		return array("success" => true, "file" => $uploadfile[1]);
	}
	return array("success" => false);
}


if(isset($_GET["action"]) == "foto" && count($_FILES) > 0)
{	
	$res = actualizar_foto();
	
}

echo json_encode($res);


?>