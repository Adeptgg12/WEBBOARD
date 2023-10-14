<!DOCTYPE html>
<html>
<head>
    <title>ฟอร์มแก้ไขข้อมูล</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" charset="utf-8"> 
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="css/bootstrap-theme.css" rel="stylesheet" type="text/css">
    <script src="js/jquery-1.11.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <style>
        h2 {
            font-family: "JasmineUPC";
            text-align: center;
        }
    </style>
</head>
<body>
    <form name="editForm" action="save_editmember.php" method="post">
    <?php
    session_start(); // เริ่มเซสชันเพื่อตรวจสอบการล็อกอิน

    if(isset($_SESSION['UserID'])){ // ตรวจสอบว่ามีผู้ใช้ล็อกอินอยู่หรือไม่

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "mydatabase1";
        $conn = mysqli_connect($servername, $username, $password, $dbname);

        if(!$conn){
            die("Connection failed: " . mysqli_connect_error());
        }

        $UserID = $_GET['UserID'];

        $sql = "SELECT * FROM member WHERE UserID='$UserID'";
        $query = mysqli_query($conn, $sql);
        $result = mysqli_fetch_array($query);

        if (!$result) {
            echo "ไม่พบข้อมูล UserID " . $UserID;
        } else {
        ?>
            <div class="container">
                <div class="alert alert-success">
                    <h2 style="color:Tomato;">แก้ไขข้อมูลส่วนตัว</h2>
                </div>
                <table class="table table-hover table-bordered">
                    <tr>
                        <th width="150">ลำดับสมาชิก</th>
                        <td width="240">
                            <input type="hidden" name="UserID" value="<?php echo $result["UserID"]; ?>">
                            <?php echo $result["UserID"]; ?>
                        </td>
                    </tr>
                    <tr>
                        <th width="150">ชื่อผู้ใช้งาน</th>
                        <td width="240"><input type="text" class="form-control" name="username" value="<?php echo $result["username"]; ?>"></td>
                    </tr>
                    <tr>
                        <th width="150">รหัสผ่าน</th>
                        <td width="240"><input type="password" class="form-control" name="password" value="<?php echo $result["password"]; ?>"></td>
                    </tr>
                    <tr>
                        <th width="150">ชื่อลูกค้า</th>
                        <td width="240"><input type="text" class="form-control" name="name" value="<?php echo $result["name"]; ?>"></td>
                    </tr>
                </table>
                <center><button type="submit" class="btn btn-primary">Submit</button></center>
            </div>
        <?php
        }
        mysqli_close($conn);
    } else {
        echo "กรุณาล็อกอินก่อนเข้าถึงหน้านี้";
    }
    ?>
    </form>
</body>
</html>
