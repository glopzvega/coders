<?php 
session_start();
require_once "conexion.php";

class Mensaje
{	
	function __construct($conn)
	{
		$this->conn = $conn;
		$this->usuario = 4; //$_SESSION["usuario"];

	}	

	function call($sql, $insert="0")
	{
		$result = mysqli_query($this->conn, $sql);
		if($result)
		{
			if($insert == 1)
			{	
				$last_id = mysqli_insert_id($this->conn);
				return $last_id;
			}
			else
			{			
				$data = array();
				if (mysqli_num_rows($result) > 0) {
			    // output data of each row
				    while($row = mysqli_fetch_assoc($result)) {			
						$data[] = $row;
				    }	    
				}
				return $data;
			}
		}

		return false;
	}

	function obtener_mensajes()
	{
		$idsesion = $this->usuario;
		$sql = "SELECT * FROM notificaciones WHERE idcontacto = '$idsesion'";
		$res = $this->call($sql);
		return $res;

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