<?php 
session_start();
require_once "conexion.php";
require_once "contactoService.php";

class Mensaje extends Basica
{	
	//Metodo Constructor
	function __construct($conn)
	{		
		// parent llama a la clase padre
		parent::__construct($conn);
	}	

	function marcar_leido($idnotificacion)
	{
		$sql = "UPDATE notificaciones SET estatus='2' WHERE idnotificacion = '$idnotificacion'";
		$this->call($sql);

		$sql = "SELECT * FROM notificaciones WHERE idnotificacion = '$idnotificacion' AND estatus = '2'";
		$res = $this->call($sql);

		if($res && count($res)>0)
		{
			return array("success" => true);
		}

		return array("success" => false);
	}

	function obtener_mensajes()
	{
		$idsesion = $this->usuario;
		$sql = "SELECT * FROM notificaciones WHERE idcontacto = '$idsesion' AND estatus = '1'";
		$res = $this->call($sql);
		if($res && count($res) > 0)
		{
			foreach ($res as $idx => $row) {
				$idusuario = $row["idusuario"];
				$data = obtener_datos_usuario($this->conn, $idusuario);
				if($data["success"])
				{					
					$res[$idx]["idusuario"] = $data["data"][0];
				}
			}

			return array("success" => true, "data" => $res);
		}

		return array("success" => false);

	}
}

$obj = new Mensaje($conn);
$res = array();

if(isset($_GET["mensajes"]))
{
	$res = $obj->obtener_mensajes();
}
else if(isset($_GET["leido"]) && isset($_GET["idnotificacion"]))
{
	$res = $obj->marcar_leido($_GET["idnotificacion"]);
}


echo json_encode($res);

?>