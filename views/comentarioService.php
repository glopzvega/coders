<?php 
session_start();
require_once("conexion.php");

class Comentario extends Basica
{
	function __construct($conn)
	{
		parent::__construct($conn);
	}

	function agregar($data)
	{
		$usuario = $this->usuario;
		$publicacion = $data["idpublicacion"];
		$comentario = $data["comentario"];
		$fecha = date("Y-m-d");

		$sql = "INSERT INTO comentarios(idusuario, idpublicacion, comentario, fecha) VALUES('$usuario','$publicacion','$comentario','$fecha')";
		$res = $this->call($sql, 1);

		if($res)
		{
			return array("success" => true, "id" => $res);
		}

		return array("success" => false);

	}
}

$obj = new Comentario($conn);

if(isset($_GET["agregar"]))
{
	$res = $obj->agregar($_GET);
}

echo json_encode($res);

?>