<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydatabase1";
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // ถ้าไม่มี session หรือไม่ตรงกับค่าที่ต้องการ ให้ redirect ผู้ใช้ไปยังหน้า login หรือหน้าที่เหมาะสม
    header('Location: index.php'); // แก้ไปยังหน้า login ของคุณ
    exit;
}
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "failed" . $e->getMessage();
}
?>
<!doctype html>
<html lang="en">

<head>
<link rel="stylesheet" type="text/css" href="styles.css">
    
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <title> My Board</title>
    <!-- https://ionicons.com/ -->
    <script src="https://unpkg.com/ionicons@5.1.2/dist/ionicons.js"></script>
</head>

<body>
    <!-- start navbar -->
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
                                <a class="nav-link" href="mypost.php">โพสต์ของฉัน</a>
                            </li>
                            <?php
                            $Status = $_SESSION['Status'];
                            if ($Status == "ADMIN") {
                                echo '<li class="nav-item active">
                                <a class="nav-link" href="testadmin.php">หลังบ้าน<span class="sr-only">(current)</span></a>
                            </li>';
                            }
                            else{}
                            ?>
                        </ul>
                        <form method="post" class="form-inline my-2 my-lg-0" style="margin-left: 25%; margin-right: 25%;" action="search.php">
                            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search">
                            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                        </form>
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
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-12">
                <table class="table table-striped">
                    <thead>
                        <tr class="table-danger">
                            <th scope="col" width="20%">ว/ด/ป</th>
                            <th scope="col" width="40%">เนื้อหา</th>
                            <th scope="col" width="10%">ผู้เขียน</th>
                            <th scope="col" width="10%">ตอบกลับ</th>
                            <th scope="col" width="10%">แก้ไขโพสต์</th>
                            <th scope="col" width="10%">ลบโพสต์</th>
                        </tr>
                    </thead>
                    <?php
                    $student = $_SESSION['username'];
                    $sql = "SELECT * FROM discussion WHERE student = :student ORDER BY date DESC";
                    $stmt = $conn->prepare($sql);
                    $stmt->bindParam(':student', $student, PDO::PARAM_STR);
                    $stmt->execute();
                            
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>";
                        echo "<td>" . $row["date"] . "</td>";
                        echo "<td>" . insertLineBreaks($row["post"], 280) . "</td>";
                        echo "<td>" . $row["student"] . "</td>";
                        echo '<td><button class="btn btn-info" onclick="replyToPost(' . $row["postID"] . ')">ตอบกลับ</button></td>';
                        echo '<td><button class="btn btn-primary" onclick="editToPost(' . $row["postID"] . ')">แก้ไข</button></td>';
                        echo '<td><form class="form-inline my-2 my-lg-0" action="delToPost(' . $row["postID"] . ')">
                        <button class="btn btn-danger" type="button" onclick="showdelModal()">ลบโพสต์</button>
                    </form>
                    <div class="modal fade" id="delModal" tabindex="-1" role="dialog" aria-labelledby="delModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="delModalLabel">ยืนยันการลบโพสต์</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    คุณต้องการลบโพสต์หรือไม่?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                                    <button type="button" class="btn btn-danger" onclick="delToPost(' . $row["postID"] . ')">ยืนยัน</button>
                                </div>
                            </div>
                        </div>
                    </div></td>';
                        /*echo '<td><button class="btn btn-danger" onclick="delToPost(' . $row["postID"] . ')">ลบโพสต์</button></td>';*/
                        echo "</tr>";
                    }
                    function insertLineBreaks($text, $maxLength)
                    {
                        // Add line breaks after the specified character count
                        return wordwrap($text, $maxLength, "<br>", true);
                    }

                    ?>
                </table>
            </div>
        </div>
    </div>
    </div>
    <!-- start last post -->
    <p align="center"> @oveneiei </p>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script>
        function replyToPost(postID) {
            window.location.href = 'reply.php?postID=' + postID;
        }

        function editToPost(postID) {
            window.location.href = 'editpost.php?postID=' + postID;
        }
        function showdelModal() {
            $('#delModal').modal('show');
        }
        function delToPost(postID) {
            window.location.href = 'delToPost.php?postID=' + postID;
            $('#delModal').modal('hide');
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="script.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>

</html>