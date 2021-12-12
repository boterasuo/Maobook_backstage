<?php

$id = $_GET["id"];

require_once("db-connect.php");

require_once("style.php");
require_once("main-nav.php");

//$sql = "DELETE FROM users WHERE id='$id'";
$sql = "UPDATE social_forum SET valid=9 WHERE id='$id'";


if ($conn->query($sql) === TRUE) {
    echo "刪除資料完成<br>";
//    header("location: user-edit.php?id=".$id); //完全刪除
} else {
    echo "刪除資料錯誤: " . $conn->error;
}
?>

<div>
    <a class="btn btn-info" href="user-social-log.php">返回文章列表</a>
</div>

<!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"  integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">-->