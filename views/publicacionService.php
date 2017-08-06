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
		// var_dump($_FILES);
		// exit();
		if(count($_FILES) > 0 && isset($_FILES["foto_publicacion"]) && $_FILES["foto_publicacion"]!= "")
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
				exit();
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

else if(isset($_GET["like"]))
{
	if(isset($_GET["id"]) && $_GET["id"] != "")
	{
		require_once "conexion.php";
		$id = $_GET["id"];

		$sql = "SELECT likes FROM publicacion WHERE id = '$id'";

		$result = mysqli_query($conn, $sql);
		$data = array();
		if (mysqli_num_rows($result) > 0) {
	    // output data of each row
		    while($row = mysqli_fetch_assoc($result)) {			
				$data[] = $row;
		    }
		}

		$numlikes = $data[0]["likes"];
		$numlikes = (int) $numlikes + 1;

		$sql = "UPDATE publicacion SET likes = '$numlikes' WHERE id = '$id'";

		mysqli_query($conn, $sql);

		$usuario_id = $_SESSION["usuario"];
		$sql = "SELECT * FROM usuario_likes WHERE idusuario = '$usuario_id' AND idpublicacion = '$id'";

		$data = array();
		$result = mysqli_query($conn, $sql);
		if (mysqli_num_rows($result) == 0) 
		{
	    	$sql = "INSERT INTO usuario_likes (idusuario, idpublicacion) VALUES ('$usuario_id', '$id')";
	    	mysqli_query($conn, $sql);
		}



		$res = array("success" => true);
		echo json_encode($res);
	}
}

else if(isset($_GET["dislike"]))
{
	if(isset($_GET["id"]) && $_GET["id"] != "")
	{
		require_once "conexion.php";
		$id = $_GET["id"];

		$sql = "SELECT likes FROM publicacion WHERE id = '$id'";

		$result = mysqli_query($conn, $sql);
		$data = array();
		if (mysqli_num_rows($result) > 0) {
	    // output data of each row
		    while($row = mysqli_fetch_assoc($result)) {			
				$data[] = $row;
		    }
		}

		$numlikes = $data[0]["likes"];
		$numlikes = (int) $numlikes - 1;

		$sql = "UPDATE publicacion SET likes = '$numlikes' WHERE id = '$id'";

		mysqli_query($conn, $sql);

		$usuario_id = $_SESSION["usuario"];
		$sql = "SELECT * FROM usuario_likes WHERE idusuario = '$usuario_id' AND idpublicacion = '$id'";

		$data = array();
		$result = mysqli_query($conn, $sql);
		if (mysqli_num_rows($result) > 0) 
		{
			$sql = "DELETE FROM usuario_likes WHERE idusuario = '$usuario_id' AND idpublicacion = '$id'";	    	
	    	mysqli_query($conn, $sql);
		}

		$res = array("success" => true);
		echo json_encode($res);
	}
}

else if(isset($_GET["obtener"]))
{
	require_once "conexion.php";
	$usuario_id = $_SESSION["usuario"];
	
	// Se le agrega el prefijo al inicio de cada campo para poder diferenciarlos unos de otros ya que puede suceder que tengan el mismo nombre y cause un error por ambiguedad.
	$sql = "SELECT p.id, u.nombre, u.apellido, u.imagen as avatar, p.fecha, p.contenido, p.usuario, p.likes, p.imagen"; 

	// Se consulta de 2 tablas y se define una variable para hacer referencia a cada 1 de ellas p = publicacion y u = usuarios
	$sql .= " FROM publicacion as p, usuarios as u";

	// Cuando se consultan 2 o más tablas es necesario agregar en el WHERE una condicion que indique la relacion de las columnas en este caso la tabla publicacion->usuario relaciona a la tabla usuario->id  
	$sql .= " WHERE p.usuario = u.id AND p.usuario = '$usuario_id'";
	// echo $sql;

	$result = mysqli_query($conn, $sql);
	$data = array();
	if (mysqli_num_rows($result) > 0) {
    // output data of each row
	    while($row = mysqli_fetch_assoc($result)) {			
			$data[] = $row;
	    }
	}

	$publicaciones = $data;

	$sql = "SELECT idpublicacion FROM usuario_likes WHERE idusuario = '$usuario_id'";

	$result = mysqli_query($conn, $sql);
	$likes = array();
	if (mysqli_num_rows($result) > 0) {
    // output data of each row
	    while($row = mysqli_fetch_assoc($result)) {			
			// $likes[] = array_values($row);
			$likes[] = $row["idpublicacion"];
	    }
	}

	// $likes = array_values($likes);
	// echo "<pre>";
	// var_dump($likes);
	// print_r($likes);
	// echo "</pre>";
	// exit();

	foreach ($publicaciones as $key => $publicacion) {
		
		// var_dump($publicacion["id"]);

		if(in_array($publicacion["id"], $likes))
		{
			$publicaciones[$key]["conlike"] = 1;
		}
		else
		{
			$publicaciones[$key]["conlike"] = 0;			
		}
	}

	$res = array("success" => true, "data" => $publicaciones);
	echo json_encode($res);
}
else
{
	$res = array("success" => false, "mensaje" => "Todos los datos son necesarios");
	echo json_encode($res);
}

?>