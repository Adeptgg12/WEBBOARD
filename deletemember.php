<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydatabase1";
$conn = mysqli_connect($servername, $username, $password, $dbname);
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // ถ้าไม่มี session หรือไม่ตรงกับค่าที่ต้องการ ให้ redirect ผู้ใช้ไปยังหน้า login หรือหน้าที่เหมาะสม
    header('Location: index.php'); // แก้ไปยังหน้า login ของคุณ
    exit;
}
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET['UserID'])) {
    $postID = $_GET['UserID'];

    $sql = "DELETE FROM member WHERE UserID = ?";
    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "i", $postID);

    if (mysqli_stmt_execute($stmt)) {
        header("location: listmember.php");
        exit;
    } else {
        echo "Error deleting post";
    }

    mysqli_stmt_close($stmt);
} else {
    echo "No postID specified";
}

mysqli_close($conn);
?>
