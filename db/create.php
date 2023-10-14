<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydatabase1";
$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn){
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "CREATE TABLE discussion (
    postID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    student VARCHAR(100) NOT NULL,
    post VARCHAR(10000) NOT NULL,
    date DATE
)";

if (mysqli_query($conn, $sql)){
    echo "สร้างตารางข้อมูลสำเร็จ";
}
else{
    echo "สร้างตารางไม่สำเร็จ: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
