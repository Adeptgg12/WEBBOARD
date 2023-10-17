<!DOCTYPE html>
<html>

<head>
    <title>ฟอร์มแก้ไขโพสต์</title>
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

    <form name="editForm" action="seditreply.php" method="post">
        <?php
        session_start(); // เริ่มเซสชันเพื่อตรวจสอบการล็อกอิน
        if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
            // ถ้าไม่มี session หรือไม่ตรงกับค่าที่ต้องการ ให้ redirect ผู้ใช้ไปยังหน้า login หรือหน้าที่เหมาะสม
            header('Location: index.php'); // แก้ไปยังหน้า login ของคุณ
            exit;
        }
        if (isset($_SESSION['UserID'])) { // ตรวจสอบว่ามีผู้ใช้ล็อกอินอยู่หรือไม่

            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "mydatabase1";
            $conn = mysqli_connect($servername, $username, $password, $dbname);
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }
            $replyID = $_GET['replyID'];
            $sql = "SELECT * FROM replytest WHERE replyID='$replyID'";
            $query = mysqli_query($conn, $sql);
            $result = mysqli_fetch_array($query);

            if (!$result) {
                echo "ไม่พบข้อมูล UserID " . $_SESSION["UserID"];
            } else {
        ?>

                <div class="container">
                    <div class="alert alert-success">
                        <h2 style="color:Tomato;">แก้ไขการตอบกลับ</h2>
                    </div>
                    <table class="table table-hover table-bordered">
                        <tr>
                            <th width="150">ลำดับการตอบกลับ</th>
                            <td width="240">
                                <input type="hidden" name="replyID" value="<?php echo $result["replyID"]; ?>">
                                <?php echo $result["replyID"]; ?>
                            </td>
                        </tr>
                        <tr>
                            <th width="150">ชื่อผู้ตอบกลับ</th>
                            <td width="240">
                                <input type="hidden" name="student" value="<?php echo $result["student"]; ?>">
                                <?php echo $result["student"]; ?>
                            </td>
                        </tr>
                        <tr>
                            <th width="150">เนื้อหาการตอบกลับ</th>
                            <td width="240"><input type="text" class="form-control" name="replyMsg" value="<?php echo $result["replyMsg"]; ?>"></td>
                        </tr>
                        <tr>
                            <th width="150">วันที่ตอบกลับ</th>
                            <td width="240">
                                <input type="hidden" name="date" value="<?php echo $result["date"]; ?>">
                                <?php echo $result["date"]; ?>
                            </td>
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