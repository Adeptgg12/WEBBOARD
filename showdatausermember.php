<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>show data</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/bootstrap-theme.css" type="text/css">
    <script src="js/jquery-1.11.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</head>
<body>
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "mydatabase1";
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if(!$conn){
        die("connection failed " .mysqli_connect_error());
    }
    $sql="select * from member";
    $query=mysqli_query($conn,$sql);
    ?>
    <div class="container">
        <table class="table table-hover table-bordered">
            <tr>
                <th width="90">รหัสลูกค้า</th>
                <th width="90">ชื่อผู้ใช้</th>
                <th width="90">รหัสผ่าน</th>
                <th width="90">ชื่อ-นามสกุล</th>
                <th width="90">แก้ไขข้อมูล</th>
                <th width="90">ลบข้อมูล</th>
            </tr>
        <?php
            while($result=mysqli_fetch_array($query,MYSQLI_ASSOC))
            {
                ?>
                <tr>
                    <td><?php echo $result["UserID"];?></td>
                    <td><?php echo $result["username"];?></td>
                    <td><?php echo $result["password"];?></td>
                    <td><?php echo $result["name"];?></td>
                    <td><a href="editusermember.php?UserID=<?php echo $result ["UserID"];?>"><button type="botton" class="btn btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                    </svg>
                    edit</button></a></td>
                    <td><a href="delete.php?UserID=<?php echo $result ["UserID"];?>"><button type="botton" class="btn btn-danger">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
                    <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
                    </svg>
                    delete</button></a></td>
                    
                </tr>
                <?php
                    }
                ?>
        </table>
    </div>
    <?php
        mysqli_close($conn);
    ?>
</body>
</html>