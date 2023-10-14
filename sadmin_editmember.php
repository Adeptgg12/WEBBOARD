<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydatabase1";

// Create a connection to the database
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check if the connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the values from the form and validate them
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $UserID = mysqli_real_escape_string($conn, $_POST['UserID']);

    // Check if UserID is a valid integer
    if (!is_numeric($UserID)) {
        die("UserID must be a valid integer.");
    }

    // Update the record
    $sql = "UPDATE member SET username='$username', Password='$password', name='$name' WHERE UserID=$UserID";

    if (mysqli_query($conn, $sql)) {
        echo "แก้ไขข้อมูลเรียบร้อย";
        // Uncomment the following line to redirect to listmember.php
        // header("Location: listmember.php");
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}
?>
