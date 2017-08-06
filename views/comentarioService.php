<?php 
session_start();
require_once("conexion.php");

class Comentario extends Basica
{
	function __construct($conn)
	{
		parent::__construct($conn);
	}

	function obtener($data)
	{
		$id = $data["idpublicacion"];
		$sql = "SELECT * FROM comentarios as c, usuarios as u WHERE idpublicacion = $id AND c.idusuario = u.id";
		$res = $this->call($sql);

		if($res && count($res)>0)
		{
			return array("success" => true, "data" => $res);
		}

		return array("success" => false);
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
else if(isset($_GET["obtener"]))
{
	$res = $obj->obtener($_GET);
}

echo json_encode($res);

?>