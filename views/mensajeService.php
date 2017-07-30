<?php 
session_start();
require_once "conexion.php";

class Mensaje extends Basica
{	
	//Metodo Constructor
	function __construct($conn)
	{		
		// parent llama a la clase padre
		parent::__construct($conn);
	}	

	function obtener_mensajes()
	{
		$idsesion = $this->usuario;
		$sql = "SELECT * FROM notificaciones WHERE idcontacto = '$idsesion'";
		$res = $this->call($sql);
		if($res && count($res) > 0)
		{
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

echo json_encode($res);

?>