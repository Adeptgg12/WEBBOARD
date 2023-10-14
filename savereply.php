<?php
function checkLoginStatus() {
    session_start();
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
        header('Location: index.html');
        exit;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['replyMsg']) && isset($_GET['postID'])) {
    // ตรวจสอบว่าผู้ใช้เข้าสู่ระบบ
    checkLoginStatus();

    $replyMsg = $_GET['replyMsg'];
    $postID = $_GET['postID'];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "mydatabase1";

    // รับชื่อผู้ใช้จากเซสชัน
    $student = $_SESSION['username'];
    date_default_timezone_set('Asia/Bangkok');
    $date = date('Y-m-d H:i:s');

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("INSERT INTO replytest(postID, student, replyMsg,date) VALUES (:postID, :student, :replyMsg, :date)");
        $stmt->bindParam(':postID', $postID, PDO::PARAM_INT);
        $stmt->bindParam(':student', $student);
        $stmt->bindParam(':replyMsg', $replyMsg);
        $stmt->bindParam(':date', $date);

        if ($stmt->execute()) {
            header("location: reply.php?postID=$postID");
            echo "บันทึก reply สำเร็จ";
        } else {
            echo "เกิดข้อผิดพลาดในการบันทึก: " . implode(" ", $stmt->errorInfo());
        }
    } catch (PDOException $e) {
        echo "เกิดข้อผิดพลาดในการเชื่อมต่อกับฐานข้อมูล: " . $e->getMessage();
    }

    $conn = null; // ปิดการเชื่อมต่อกับฐานข้อมูล
} else {
    echo "ค่า 'replyMsg' หรือ 'postID' ไม่ถูกต้องหรือไม่ได้รับค่า";
}
?>
