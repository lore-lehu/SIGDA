<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sigda";
 
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
$conn->set_charset('utf8');
// Check connection
if ($conn->connect_error) {
die("Error de conexi&oacute;n: " . $conn->connect_error);
}

//echo $conn;
?>