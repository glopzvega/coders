<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "coders";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} 
echo "Connected successfully";

$sql = "INSERT INTO usuarios (username, password, fecha) VALUES ('mcgalv@gmail.com', '123456', '". date('Y-m-d')."')";

$res = mysqli_query($conn, $sql);
if ($res) {
    echo "New record created successfully" . $res;
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>