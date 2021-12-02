<?php
require_once ("../db-connect.php");
$now=date("Y-m-d H:i:s");
//echo $now;
//exit;
$sql="INSERT INTO users(account, name, created_at) VALUES('tom', 'Tom', '$now')";


if ($conn->query($sql) === TRUE) {
    echo "新增資料完成";
} else {
    echo "新增資料錯誤: " . $conn->error;
}