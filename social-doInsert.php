<?php
$article_title=$_POST["article_title"];
$article_content=$_POST["article_content"];
$article_cate=$_POST["article_cate"];
$now=date("Y-m-d H:i:s");
$id=$_POST["id"];

require_once ("../db-connect.php");

//echo $now;
//exit;
$sql="INSERT INTO social_forum(article_title, article_content, article_cate, created_at) 
VALUES('$article_title', '$article_content', '$article_cate', '$now')";


if ($conn->query($sql) === TRUE) {
    echo "新增資料完成<br>";
    $id=$conn->insert_id;//當我新增一筆資料時獲得id
//    echo "id: $id";
    header("location: user-social-log.php?id=".$id);
} else {
    echo "新增資料錯誤: " . $conn->error;
}