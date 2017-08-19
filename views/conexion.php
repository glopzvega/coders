<?php 


// Database Heroku Coders
// Username:	b0e06265a53624
// Password:	56bb98e5 (Reset)
// Host: us-cdbr-iron-east-05.cleardb.net
// Database: heroku_d9c5270f8dacfa8



$servername = "us-cdbr-iron-east-05.cleardb.net";
$username = "b0e06265a53624";
$password = "56bb98e5";
$dbname = "heroku_d9c5270f8dacfa8";
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
		$this->usuario = $_SESSION["usuario"];
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
