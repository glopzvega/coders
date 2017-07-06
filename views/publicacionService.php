<?php 
session_start();
if(isset($_POST["contenido"]))
{
	// echo "<pre>";
	// var_dump($_FILES);
	// echo "</pre>";
	// exit();	

	

	require_once "conexion.php";

	$contenido = $_POST["contenido"];
	$fecha = date("Y-m-d");
	$usuario = $_SESSION["usuario"];
	// var_dump($_SESSION);
	$sql = "INSERT INTO publicacion(usuario, fecha, contenido) VALUES ('$usuario', '$fecha', '$contenido')";
	// echo $sql;
	$result = mysqli_query($conn, $sql);

	if($result)
	{		
		$last_id = mysqli_insert_id($conn);

		if(count($_FILES) > 0 && isset($_FILES["foto_publicacion"]))
		{
			$tipo_archivo = $_FILES["foto_publicacion"]["type"];

			if($tipo_archivo == "image/jpeg")
			{
				$nombre_archivo = $last_id . ".jpg";			
			}
			else if($tipo_archivo == "image/png")
			{
				$nombre_archivo = $last_id . ".png";			
			}
			else if($tipo_archivo == "image/gif")
			{
				$nombre_archivo = $last_id . ".gif";			
			}
			else
			{
				echo json_encode(array("success" => false, "error" => "Formato de imagen no aceptado"));
			}

			$uploadfile = "../publicaciones/" . $nombre_archivo; 

			if(move_uploaded_file($_FILES['foto_publicacion']['tmp_name'], $uploadfile))
				{
					$sql = "UPDATE publicacion SET imagen='$nombre_archivo' WHERE id='$last_id'";
					mysqli_query($conn, $sql);
				}
		}

		$res = array("success" => true, "mensaje" => "Se ha registrado correctamente");
		echo json_encode($res);		
	}
	else
	{
		$res = array("success" => false, "mensaje" => "Ocurrio un error al registrar la publicacion");
		echo json_encode($res);			
	}
}
else if(isset($_GET["obtener"]))
{
	require_once "conexion.php";
	
	// Se le agrega el prefijo al inicio de cada campo para poder diferenciarlos unos de otros ya que puede suceder que tengan el mismo nombre y cause un error por ambiguedad.
	$sql = "SELECT p.id, u.nombre, u.apellido, p.fecha, p.contenido, p.usuario, p.likes, p.imagen"; 

	// Se consulta de 2 tablas y se define una variable para hacer referencia a cada 1 de ellas p = publicacion y u = usuarios
	$sql .= " FROM publicacion as p, usuarios as u";

	// Cuando se consultan 2 o más tablas es necesario agregar en el WHERE una condicion que indique la relacion de las columnas en este caso la tabla publicacion->usuario relaciona a la tabla usuario->id  
	$sql .= " WHERE p.usuario = u.id";

	$result = mysqli_query($conn, $sql);
	$data = array();
	if (mysqli_num_rows($result) > 0) {
    // output data of each row
	    while($row = mysqli_fetch_assoc($result)) {			
			$data[] = $row;
	    }
	}
	$res = array("success" => true, "data" => $data);
	echo json_encode($res);
}
else
{
	$res = array("success" => false, "mensaje" => "Todos los datos son necesarios");
	echo json_encode($res);
}

?>