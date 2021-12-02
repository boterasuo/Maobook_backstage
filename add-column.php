<?php
require_once ("../db-connect.php");
$sql="ALTER TABLE users ADD COLUMN age INT(3)";
if ($conn->query($sql) === TRUE) {
    echo "users 增加欄位完成";
} else {
    echo "修改欄位錯誤: " . $conn->error;
}