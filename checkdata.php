<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydatabase1";
$conn = mysqli_connect($servername, $username, $password, $dbname);

$errorslog = array();
// Check if the form was submitted
if(isset($_POST['txtUsername']) && isset($_POST['txtPassword'])) {
    $username = mysqli_real_escape_string($conn, $_POST['txtUsername']);
    $password = mysqli_real_escape_string($conn, $_POST['txtPassword']);

    $sql = "SELECT * FROM member WHERE username='$username' AND password='$password'";
    $query = mysqli_query($conn, $sql);
    $result = mysqli_fetch_array($query, MYSQLI_ASSOC);

    if ($result) {
        // User is authenticated
        $_SESSION["UserID"] = $result["UserID"];
        $_SESSION["Status"] = $result["Status"];
        $_SESSION['username'] = $result["username"];
        if ($result["Status"] == "ADMIN") {
            $_SESSION['loggedin'] = true;
            
            header("location: test.php");
            
            exit(); // Make sure to exit to prevent further execution
        } else {
            $_SESSION['loggedin'] = true;
            
            header("location: test.php");
           
            exit(); // Make sure to exit to prevent further execution
        }
    } else {
        array_push($errorslog, "Username หรือ Password ไม่ถูกต้อง");
        $_SESSION['errorlog'] = "Username หรือ Password ไม่ถูกต้อง";
        header("location: index.php");
    }
}

mysqli_close($conn);
