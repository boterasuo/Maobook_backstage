<title>刪除資料表</title>
<?php
require_once("../db-connect.php");
$sql="ALTER TABLE users DROP COLUMN age";//刪除

//執行, 驗證
if ($conn->query($sql) === TRUE) {
    echo "資料表刪除完成";
} else {
    echo "刪除資料表錯誤: " . $conn->error;
}
