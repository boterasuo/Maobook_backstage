<?php
require_once ("../db-connect.php");
$now=date("Y-m-d H:i:s");

$sql="INSERT INTO users(account, name, created_at) VALUES('tom', 'Tom', '$now');";
$sql.="INSERT INTO users(account, name, created_at) VALUES('rock', 'Rock', '$now');";
$sql.="INSERT INTO users(account, name, created_at) VALUES('kete', 'Kate', '$now');";

if ($conn->multi_query($sql) === TRUE) {
    echo "新增資料完成<br>";
    ?>
    <img src="https://c.tenor.com/Z05zOgg55_oAAAAC/minions.gif" alt="" style="height: 200px; width:200px">
<?php
} else {
    echo "新增資料錯誤: " . $conn->error;
}