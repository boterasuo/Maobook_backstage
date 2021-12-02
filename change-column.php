
<?php
require_once ("../db-connect.php");
$sql="ALTER TABLE users CHANGE COLUMN account userAccount VARCHAR(30) , ADD INDEX(userAccount);";

if ($conn->query($sql) === TRUE) {
    echo "users 修改欄位完成";
} else {
    echo "修改欄位錯誤: " . $conn->error;
}?>
<title>修改欄位名稱</title>