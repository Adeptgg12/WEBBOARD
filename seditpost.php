<!doctype html>
<html>
    <head>
    <title> รับค่าการแก้ไขข้อมูล</title>
    <meta http-equiv="refresh" content="1; URL = test.php">
    </head>
    <body>
        <?php
        $servername="localhost";
        $username ="root";
        $password="";
        $dbname="mydatabase1";
        $conn=mysqli_connect($servername,$username,$password,$dbname); 
    
        $sql = "UPDATE discussion SET postID='".trim($_POST['postID'])."',
        student ='".trim($_POST['student'])."', post='".trim($_POST['post'])."' WHERE postID='".trim($_POST["postID"])."'";

        $query=mysqli_query($conn, $sql);

        echo "แก้ไขชอมูลเรียบร้อย";
        mysqli_close($conn);
        ?>
    </body> 
</html>