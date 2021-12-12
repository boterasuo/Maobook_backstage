<?php

$id=$_POST["id"];
$title=$_POST["title"];
$content=$_POST["content"];
$img=$_POST["img"];
$category=$_POST["category"];
$now=date("Y-m-d H:i:s");

require_once ("db-connect.php");

//echo $now;
//exit;
$sql="INSERT INTO social_forum(title, content, img, category, created_at) VALUES('$title', '$content', '$img', '$category','$now')";


if ($conn->query($sql) === TRUE) {
    echo "新增資料完成<br>";
    $id=$conn->insert_id;//當我新增一筆資料時獲得id
//    echo "id: $id";
    header("location: user-social-log.php?id=".$id);
} else {
    echo "新增資料錯誤: " . $conn->error;
}

