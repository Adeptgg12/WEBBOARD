<?php
session_start();
$Status = $_SESSION['Status'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>ฟอร์มแก้ไขข้อมูล</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" charset="utf-8"> 
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="css/bootstrap-theme.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="js/jquery-1.11.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/ionicons@5.1.2/dist/ionicons.js"></script>
    <style>
        h2 {
            font-family: "JasmineUPC";
            text-align: center;
        }
        body{
            background-color:rgb(240, 240, 240);
        }
        /* สไตล์ของตาราง */
.table {
    width: 100%;
    border-collapse: collapse;
    border: 2px solid black;
}

/* สไตล์สำหรับแถว (Row) */
tr {
    border-bottom: 1px solid #ddd;
    border: 1px solid #000;
}

/* สไตล์สำหรับคอลัมน์ที่เป็น Header */
th {
    background-color: #f2f2f2;
    text-align: left;
    padding: 8px;
    width: 150px;
    border: 1px solid #000;
}

/* สไตล์สำหรับคอลัมน์ที่เป็น Data */
td {
    border: 1px solid #000;
    text-align: left;
    padding: 8px;
    width: 240px;
}

/* สไตล์สำหรับ input fields */
input[type="text"],
input[type="password"] {
    width: 100%;
    padding: 5px;
    border: 1px solid #ccc;
}

/* สไตล์สำหรับ input fields ในคอลัมน์ของข้อมูล */
td input[type="text"],
td input[type="password"] {
    border: none; /* ไม่ต้องมีเส้นกรอบ */
}
.form-control {
    background-color: #f2f2f2; /* เปลี่ยนสีพื้นหลังเป็นเทาอ่อน */
    border: 1px solid #ccc; /* เปลี่ยนสีขอบเป็นสีเทาอ่อน */
}
.form-control{
    border-color: red;
}
/* เปลี่ยนสีขอบของ input fields เมื่อมีการโฟกัส */
.form-control:focus {
        border-color: #28a745;
        box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
    } 
    </style>
</head>
<body>
<div class="container-fluid p-0">
        <div class="row">
            <div class="col col-sm-12">
                <nav class="navbar navbar-expand-lg navbar navbar-dark bg-primary">
                    <a class="navbar-brand" href="test.php"><img src="img/logo.png" alt="#" width="110" height="40"></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item active">
                                <a class="nav-link" href="test.php">หน้าหลัก <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" href="mypost.php">โพสต์ของฉัน<span class="sr-only">(current)</span></a>
                            </li>

                            <?php
                            if ($Status == "ADMIN") {
                                echo '<li class="nav-item active">
                                <a class="nav-link" href="mypost.php">หลังบ้าน<span class="sr-only">(current)</span></a>
                            </li>';
                            } else {
                            }
                            ?>



                        </ul>
                        <form class="form-inline my-2 my-lg-0" action="editusermember.php">
                            <button class="btn btn-warning" type="submit">แก้ไขข้อมูลส่วนตัว</button>
                        </form>
                        <form class="form-inline my-2 my-lg-0" action="savecontent.php" method="post">
                            <button class="btn btn-success" id="openPopup">ตั้งกระทู้</button>
                            <div id="postPopup" class="popup">
                                <div class="popup-content">
                                    <span id="closePopup" class="close-button">&times;</span>
                                    <h3>ตั้งกระทู้</h3>
                                    <hr>
                                    <form id="postForm" name="frm">
                                        <input type="hidden" id="commentid" name="Pcommentid" value="0">
                                        <div class="form-group">
                                            <label for="postContent">เขียนเนื้อหา</label>
                                            <br>
                                            <textarea id="postContent" class="form-control" rows="7" cols="400" name="txtMsg" required></textarea>
                                        </div>
                                        <input type="submit" id="butsave" name="save" class="btn btn-success" value="บันทึก">
                                    </form>
                                </div>
                            </div>
                        </form>

                        <form class="form-inline my-2 my-lg-0" action="logout.php">
                            <button class="btn btn-danger" type="button" onclick="showLogoutModal()">ออกจากระบบ</button>
                        </form>
                        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="logoutModalLabel">ยืนยันการออกจากระบบ</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        คุณต้องการออกจากระบบหรือไม่?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                                        <button type="button" class="btn btn-danger" onclick="logout()">ยืนยัน</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <script>
                            function showLogoutModal() {
                                $('#logoutModal').modal('show');
                            }

                            function logout() {
                                window.location.href = 'logout.php';
                                $('#logoutModal').modal('hide');
                            }
                        </script>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <form name="editForm" action="save_editmember.php" method="post">
    <?php

    if(isset($_SESSION['UserID'])){ // ตรวจสอบว่ามีผู้ใช้ล็อกอินอยู่หรือไม่

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "mydatabase1";
        $conn = mysqli_connect($servername, $username, $password, $dbname);

        if(!$conn){
            die("Connection failed: " . mysqli_connect_error());
        }

        $UserID = $_SESSION['UserID']; // ใช้ ID จากเซสชัน

        $sql = "SELECT * FROM member WHERE UserID='$UserID'";
        $query = mysqli_query($conn, $sql);
        $result = mysqli_fetch_array($query);

        if (!$result) {
            echo "ไม่พบข้อมูล UserID " . $_SESSION["UserID"];
        } else {
        ?>
        
            <div class="container">
                <div>
                    <br>
                    <h1 style="color:black;">แก้ไขข้อมูลส่วนตัว</h2>
                    <br>
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
                <center><a class = "btn btn-danger"href="test.php">Back</a>&nbsp;&nbsp;<button type="submit" class="btn btn-success">Submit</button></center>
            </div>
        <?php
        }
        mysqli_close($conn);
    } else {
        echo "กรุณาล็อกอินก่อนเข้าถึงหน้านี้";
    }
    ?>
    </form>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="script.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>
