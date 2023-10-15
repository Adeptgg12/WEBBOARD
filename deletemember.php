<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydatabase1";
$conn = mysqli_connect($servername, $username, $password, $dbname);

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