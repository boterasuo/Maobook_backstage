<?php

$title=$_POST["title"];
$content=$_POST["content"];
$category=$_POST["category"];
$now=date("Y-m-d H:i:s");

require_once ("pdo-connect.php");

$id=$_POST["id"];

$sql="UPDATE social_forum SET title='$title', content='$content', category='$category' WHERE id='$id'";
//echo $sql;
//exit();


if ($conn->query($sql) === TRUE) {
    echo "修改資料完成<br>";

//    $id=$conn->insert_id;
//    echo "id: $id";
    header("location: user-social-edit.php?id=".$id);
} else {
    echo "修改資料錯誤: " . $conn->error;
}

