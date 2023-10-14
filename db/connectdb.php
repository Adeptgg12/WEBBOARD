<?php
$servername = "localhost";
$username = "root";
$password = "";
$conn = new mysqli($servername, $username, $password);

if ($conn -> connect_error){
    die("Connection failed: " . $conn->connect_error);

}

$sql = "CREATE DATABASE mydatabase1";
if (mysqli_query($conn, $sql)){
    echo "สร้างฐานข้อมูลสำเร็จ";
}
else{
    echo "ไม่สามารถสร้างฐานข้อมูลได้ " . mysqli_error($conn);
}
mysqli_close($conn);

?>