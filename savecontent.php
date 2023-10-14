<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // ถ้าไม่มี session หรือไม่ตรงกับค่าที่ต้องการ ให้ redirect ผู้ใช้ไปยังหน้า login หรือหน้าที่เหมาะสม
    header('Location: index.html'); // แก้ไปยังหน้า login ของคุณ
    exit;
  }
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "mydatabase1";
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    // กำหนดโซนเวลาให้เป็น "Asia/Bangkok" (ประเทศไทย)
    date_default_timezone_set('Asia/Bangkok');

    // รับข้อมูลจากฟอร์ม
    $student = $_SESSION['username'];
    $post = mysqli_real_escape_string($conn, $_POST["txtMsg"]);
    // เพิ่มวันที่และเวลาปัจจุบัน
    $date = date('Y-m-d H:i:s');

    $sql = "INSERT INTO discussion (student, post, date) VALUES ('$student', '$post', '$date')";

    if ($conn->query($sql) === TRUE) {
        header("location: test.php");
        echo "User registered successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
