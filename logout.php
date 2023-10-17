<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // ถ้าไม่มี session หรือไม่ตรงกับค่าที่ต้องการ ให้ redirect ผู้ใช้ไปยังหน้า login หรือหน้าที่เหมาะสม
    header('Location: index.php'); // แก้ไปยังหน้า login ของคุณ
    exit;
}
session_destroy();
header("location:index.php");
?>