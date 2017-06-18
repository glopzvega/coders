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
?>
