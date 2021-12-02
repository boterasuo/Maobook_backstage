<?php
require_once("../db-connect.php");

$id = $_GET["id"];

//$sql = "DELETE FROM users WHERE id='$id'";
$sql = "UPDATE users SET valid=0 WHERE id='$id'";

if ($conn->query($sql) === TRUE) {
    echo "刪除資料完成<br>";
//    header("location: user-edit.php?id=".$id); //完全刪除
} else {
    echo "刪除資料錯誤: " . $conn->error;
}
?>

<div>
    <a class="btn btn-info" href="user-list.php">使用者列表</a>
</div>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"  integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">