<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "mydatabase1";
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $replyID = mysqli_real_escape_string($conn, $_POST['replyID']);
    $student = mysqli_real_escape_string($conn, $_POST['student']);
    $replyMsg = mysqli_real_escape_string($conn, $_POST['replyMsg']);

    $sql = "UPDATE replytest SET student = '$student', replyMsg = '$replyMsg' WHERE replyID = '$replyID'";

    if (mysqli_query($conn, $sql)) {
        $sql = "SELECT postID FROM replytest WHERE replyID = ?";
        $stmt = mysqli_prepare($conn, $sql);
    
        mysqli_stmt_bind_param($stmt, "i", $replyID);
        mysqli_stmt_execute($stmt);
    
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);
        $postID = $row["postID"];
        header("Location: reply.php?postID=$postID");
    } else {
        echo "Error updating data: " . mysqli_error($conn);
    }

    mysqli_close($conn);
    ?>
