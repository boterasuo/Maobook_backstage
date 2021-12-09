<?php
$servername = "localhost";
$username = "admin";
$password = "12345";
$dbname = "my_db";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("連線失敗: " . $conn->connect_error);
} else {
    //echo "資料庫連線成功";
}

$id = $_GET['id'];
$sql = "UPDATE products SET valid=0 WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    echo "資料已刪除<br>";
header("location: product_manage.php");
} else {
    echo "資料刪除失敗". $conn->error;
}

