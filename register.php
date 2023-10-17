<?php
session_start();
$errorsup = array();
array_push($errorsup, "Username มีคนใช้ไปแล้ว");
$_SESSION['errorup'] = "Username มีคนใช้ไปแล้ว";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // เชื่อมต่อกับฐานข้อมูล (แทนค่าด้วยข้อมูลของคุณ)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "mydatabase1";
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    $errorsup = array();
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // รับข้อมูลจากฟอร์ม
    $username = $_POST["txtUsername"];
    $password = $_POST["txtPassword"];
    $name = $_POST["txtName"];

    // ตรวจสอบว่า username ซ้ำหรือไม่
    $check_query = "SELECT * FROM member WHERE username = '$username'";
    $check_result = $conn->query($check_query);

    if ($check_result->num_rows > 0) {
        header("location: signup.php");
    } else {
        // ถ้า username ไม่ซ้ำกัน
        // นำข้อมูลไปเพิ่มลงในฐานข้อมูล (เช่นตาราง member)
        $sql = "INSERT INTO member (name, username, password) VALUES ('$name', '$username', '$password')";

        if ($conn->query($sql) === TRUE) {
            header("location: index.php");
            echo "User registered successfully";
        } else {
            header("location: signup.php");
        }
    }

    $conn->close();
}
