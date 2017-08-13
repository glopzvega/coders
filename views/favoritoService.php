<?php 
session_start();
require_once("conexion.php");

class Publicacion extends Basica
{
	function __construct($conn)
	{
		parent::__construct($conn);
	}

	function obtener_datos_publicacion($idpublicacion)
	{
		$sql = "SELECT * FROM publicacion as p, usuarios as u WHERE p.id = '$idpublicacion' AND p.usuario = u.id";
		// echo $sql;
		// exit();
		$res = $this->call($sql);

		return $res;
	}

	function obtener_favoritos($data)
	{
		$id = $this->usuario;
		$sql = "SELECT idpublicacion FROM usuario_likes WHERE idusuario = '$id'";

		$res = $this->call($sql);

		if($res && count($res)>0)
		{
			$data = array();
			foreach ($res as $key => $row) {
				$info = $this->obtener_datos_publicacion($row["idpublicacion"]);

				if($info && count($info) > 0)
				{
					$data[] = $info[0];
				}
			}
			return array("success" => true, "data" => $data);
		}

		return array("success" => false);
	}	
}

$obj = new Publicacion($conn);

if(isset($_GET["obtener"]))
{
	$res = $obj->obtener_favoritos($_GET);
}

echo json_encode($res);

?>