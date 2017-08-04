<?php 
session_start();
require_once "conexion.php";

class Usuario extends Basica
{	
	//Metodo Constructor
	function __construct($conn)
	{		
		// parent llama a la clase padre
		parent::__construct($conn);
	}

	function guardarImagen($idusuario, $imagen)
	{
		$sql = "UPDATE usuarios SET imagen = '$imagen' WHERE id='$idusuario'";
		// echo $sql;
		$this->call($sql);

		$sql = "SELECT imagen FROM usuarios WHERE id = '$idusuario'";
		$res = $this->call($sql);

		if($res && count($res)>0)		
		{
			if($res[0]["imagen"] == $imagen)
			{
				return array("success" => true);
			}
		}

		return array("success" => false);
	}
}


function actualizar_foto($conn)
{
	$uploaddir = $_SERVER["DOCUMENT_ROOT"] . "/coders/img/perfiles/";
	
	$archivo = basename($_FILES['logo']['name']);
	$tipo = explode(".", $archivo)[1];
	$archivo = $_SESSION["usuario"] . "." . $tipo;

	$uploadfile = $uploaddir . $archivo;
	
	$idusuario = $_SESSION["usuario"];

	if (move_uploaded_file($_FILES['logo']['tmp_name'], $uploadfile)) {			
		// $uploadfile = explode($uploaddir, $uploadfile);

		$obj = new Usuario($conn);
		$res = $obj->guardarImagen($idusuario, $archivo);

		if($res["success"])
		{
			$_SESSION["imagen"] = $archivo;
			return array("success" => true, "file" => $archivo);
		}

	}
	return array("success" => false);
}


if(isset($_GET["action"]) == "foto" && count($_FILES) > 0)
{	
	$res = actualizar_foto($conn);
	
}

echo json_encode($res);


?>