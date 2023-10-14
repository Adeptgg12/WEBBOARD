<?php
function checkLoginStatus()
{
    session_start();
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
        header('Location: index.html');
        exit;
    }
}

checkLoginStatus();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydatabase1";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_GET['postID'])) {
        $postID = $_GET['postID'];

        $stmt = $conn->prepare("SELECT * FROM discussion WHERE postID = :postID");
        $stmt->bindParam(':postID', $postID);
        $stmt->execute();
        $post = $stmt->fetch(PDO::FETCH_ASSOC);
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <title> SCI-Board</title>
    <!-- https://ionicons.com/ -->
    <script src="https://unpkg.com/ionicons@5.1.2/dist/ionicons.js"></script>
</head>

<body style="background-color:LightGray;">
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

    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                <h3>ตอบกลับโพสต์</h3>
                <h6>โพสต์โดย: <?php echo $post['student']; ?></h6>
                <h6>วันที่: <?php echo $post['date']; ?></h6>
                <h6>เนื้อหา:&nbsp;&nbsp;&nbsp;
                    <?php
                    $postContent = $post['post'];
                    $maxLineLength = 320;
                    $formattedContent = wordwrap($postContent, $maxLineLength, "<br />\n", true);
                    echo $formattedContent;
                    ?>
                    </p>
                    <hr>


            </div>
        </div>
    </div>
    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                <tbody>
                    <?php
                    $stmt = $conn->prepare("SELECT * FROM replytest WHERE postID = :postID");
                    $stmt->bindParam(':postID', $postID, PDO::PARAM_INT);
                    $stmt->execute();
                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    $student = $_SESSION['username'];
                    foreach ($result as $row) {
                        echo "<h6>ตอบกลับโดย: " . $row["student"] . "</h6>";
                        echo "<h6>วันที่: " . $row["date"] . "</h6>";
                        echo "<h6>เนื้อหา:&nbsp;&nbsp;&nbsp;
                        " . insertLineBreaks($row["replyMsg"], 280) . "</h6>";
                        $Status = $_SESSION['Status'];
                        if ($student == $row["student"] || $Status == "ADMIN") {
                            $replyID = $row["replyID"];
                            echo "<a href='editreply.php?replyID=$replyID'>แก้ไข</a>";

                            echo "&nbsp;&nbsp;&nbsp;<a href='delToReply.php?replyID=$replyID' style='color: red'>ลบ</a>";
                        }

                        echo "<hr>";
                    }

                    function insertLineBreaks($text, $maxLength)
                    {
                        return wordwrap($text, $maxLength, "<br>", true);
                    }
                    ?>

                </tbody>
                <style>
                    textarea#replyMsg {
                        background-color: rgb(220, 220, 220);
                        border-color: black;
                        border-radius: .4rem;
                        padding: .2rem;
                    }
                </style>
                <form method="get" action="savereply.php">
                    <div class="form-group">
                        <label for="replyMsg">ข้อความตอบกลับ</label>
                        <textarea class="form-control" id="replyMsg" name="replyMsg" rows="5" required></textarea>
                    </div>
                    <?php
                    $postID = $_GET['postID'];
                    echo "<input type='hidden' name='postID' value='$postID'>";
                    ?>
                    <button type="submit" class="btn btn-primary">ส่งตอบกลับ</button>
                </form>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="script.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>

</html>