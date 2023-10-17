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

if (isset($_GET['replyID'])) {
    $replyID = $_GET['replyID'];

    // Retrieve the postID associated with the replyID from the database
    $sql = "SELECT postID FROM replytest WHERE replyID = ?";
    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "i", $replyID);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);

    if ($row) {
        $postID = $row["postID"];

        // Delete the reply from the database
        $sql = "DELETE FROM replytest WHERE replyID = ?";
        $stmt = mysqli_prepare($conn, $sql);

        mysqli_stmt_bind_param($stmt, "i", $replyID);

        if (mysqli_stmt_execute($stmt)) {
            header("Location: reply.php?postID=$postID");
            exit;
        } else {
            echo "Error deleting reply";
        }
    } else {
        echo "Reply not found";
    }

    mysqli_stmt_close($stmt);
} else {
    echo "No replyID specified";
}

mysqli_close($conn);
?>
