<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "mydatabase1";
$conn = new mysqli($servername, $username, $password, $database);
	if($conn) {
		echo "success";
	}
	else {
		die("Error". mysqli_connect_error());
	}
?>
