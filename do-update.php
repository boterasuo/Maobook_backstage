<?php

$name=$_POST["name"];
$email=$_POST["email"];
$id=$_POST["id"];

require_once ("../db-connect.php");


$sql="UPDATE users SET email='$email', name='$name' WHERE id='$id'";
//echo $sql;
//
//exit();
if ($conn->query($sql) === TRUE) {
    echo "修改資料完成<br>";
    $id=$conn->insert_id;
//    echo "id: $id";
    header("location: user-edit.php?id=".$id);
} else {
    echo "修改資料錯誤: " . $conn->error;
}