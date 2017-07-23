<?php 
session_start();
require_once "conexion.php";

function call($conn, $sql, $insert="0")
{
	$result = mysqli_query($conn, $sql);
	if($result)
	{
		if($insert == 1)
		{	
			$last_id = mysqli_insert_id($conn);
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

function obtener_datos_usuario($conn, $idusuario)
{
	$sql = "SELECT id, nombre, apellido, username FROM usuarios WHERE id = '$idusuario'";
	$res = call($conn, $sql);

	if(count($res) > 0)
	{
		$nombre = $res[0]["nombre"];
		$apellido = $res[0]["apellido"];

		$res[0]["nombre"] = utf8_encode($nombre);
		$res[0]["apellido"] = utf8_encode($apellido);	

		return array("success" => true, "data" => $res);
	}
	else
	{
		return array("success" => false, "error" => "No se pudieron obtener datos del usuario.");
	}
}

function obtener_solicitudes($conn)
{
	$idusuario = $_SESSION["usuario"];
	$sql = "SELECT * FROM solicitudes WHERE idcontacto = '$idusuario' AND estatus = 0";

	$res = call($conn, $sql);

	if(count($res) > 0)
	{
		foreach ($res as $key => $row) {

			$row_idusuario = $row["idusuario"];

			$info_usuario = obtener_datos_usuario($conn, $row_idusuario);
			if($info_usuario["success"])
			{
				$res[$key]["idusuario"] = $info_usuario["data"];
			}			
		}

		return array("success" => true, "data" => $res);
	}
	else
	{
		return array("success" => false, "error" => "No se encontraron solicitudes pendientes");
	}
}

function obtener_contactos($conn)
{
	$idusuario = $_SESSION["usuario"];
	$sql = "SELECT * FROM contactos WHERE idusuario = '$idusuario'";
	$res = call($conn, $sql);

	if(count($res) > 0)
	{
		return array("success" => true, "data" => $res);
	}
	else
	{
		return array("success" => false, "error" => "No hay contactos registrados.");
	}
}

function crear_solicitud($conn, $res)
{
	$idusuario = $_SESSION["usuario"];
	$idcontacto = $res[0]["id"];

	$sql = "SELECT * FROM solicitudes WHERE idusuario = '$idusuario' AND idcontacto = '$idcontacto'";
	$res = call($conn, $sql);

	if(count($res) == 0)
	{
		$sql = "INSERT INTO solicitudes(idusuario, idcontacto, fecha) VALUES ('$idusuario', '$idcontacto', '".date("Y-m-d")."')";
		$idsolicitud = call($conn, $sql, 1);
		return $idsolicitud;
	}

	return $res[0]["idsolicitud"];
}

function invitar_usuario($conn, $data)
{
	$email = $data["email"];
	$idusuario = $_SESSION["usuario"];
	$sql = "SELECT * FROM usuarios WHERE username = '$email' AND id != '$idusuario'";
	$res = call($conn, $sql);
	if(count($res) > 0)
	{
		$idsolicitud = crear_solicitud($conn, $res);

		if($idsolicitud)
		{
			return array("success" => true, "id" => $idsolicitud);
		}

		return array("success" => false);
	}
	else
	{
		return array("success" => false, "error" => "El usuario no existe");
	}
}

function obtener_datos_solicitud($conn, $idsolicitud)
{
	$sql = "SELECT * FROM solicitudes WHERE idsolicitud = '$idsolicitud'";
	$res = call($conn, $sql);

	if(count($res) > 0)
	{
		return array("success" => true, "data" => $res);
	}
	else
	{
		return array("success" => false);
	}
}

function aceptar_solicitud($conn, $idsolicitud)
{
	$sql = "UPDATE solicitudes SET estatus='1' WHERE idsolicitud='$idsolicitud'";
	call($conn, $sql);
	// echo $sql;
	return array("success" => true);
}

$res = array();

if(isset($_GET["obtener"]))
{
	$res = obtener_contactos($conn);
}
else if(isset($_GET["invitar"]) && isset($_GET["email"]))
{
	$res = invitar_usuario($conn, $_GET);
}
else if(isset($_GET["solicitudes"]))
{
	$res = obtener_solicitudes($conn);
}
else if(isset($_GET["aceptar"]) && isset($_GET["id"]))
{
	$res = aceptar_solicitud($conn, $_GET["id"]);
}

// var_dump($res);

echo json_encode($res);


?>