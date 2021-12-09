<?php

$article_title=$_POST["article_title"];
$article_content=$_POST["article_content"];
$article_cate=$_POST["article_cate"];
$id=$_POST["id"];

require_once ("../db-connect.php");


$sql="UPDATE social_forum SET 
                        article_title='$article_title', 
                        article_content='$article_content', 
                        article_cate='$article_cate' WHERE id='$id'";
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

