<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname="mydatabase1";
$conn=mysqli_connect($servername, $username, $password, $dbname);

if (!$conn){
    die("Connection failed: " .mysqli_connect_error);

}

$sql = "CREATE table member(UserID int(6)unsigned auto_increment primary key,
username varchar(30) not null,
password varchar(40) not null,
name varchar(100) not null,
Status enum('ADMIN','USER') not null default 'USER')";
if (mysqli_query($conn, $sql)){
    echo "สร้างตารางข้อมูลสำเร็จ";
}
else{
    echo "สร้างตารางไม่สำเร็จ" . mysqli_error($conn);
}
mysqli_close($conn);

?>