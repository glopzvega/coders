<?php 
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "coders";
$puerto = "3636";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("No se pudo conectar: ".mysqli_connect_error());
}

class Basica
{
	function __construct($conn)
	{
		$this->usuario = 4; //$_SESSION["usuario"];
		$this->conn = $conn;
	}

	function call($sql, $insert="0")
	{
		$result = mysqli_query($this->conn, $sql);
		// var_dump($this->conn);
		// exit();
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
}


?>
