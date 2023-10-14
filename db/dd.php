<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydatabase1";
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check the database connection
if (!$conn){
    die("Connection failed: " . mysqli_connect_error());
}

// SQL query to drop the "discussion" table if it exists
$sql = "DROP TABLE IF EXISTS discussion";

if (mysqli_query($conn, $sql)){
    echo "ลบตารางข้อมูลสำเร็จ";
}
else{
    echo "ลบตารางไม่สำเร็จ: " . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>
