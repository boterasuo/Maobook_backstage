<?php
$name=$_POST["name"];
$account=$_POST["account"];
$email=$_POST["email"];


require_once ("../db-connect.php");
$now=date("Y-m-d H:i:s");
//echo $now;
//exit;
$sql="INSERT INTO users(account, name, email, created_at) VALUES('$account', '$name', '$email', '$now')";


if ($conn->query($sql) === TRUE) {
    echo "新增資料完成<br>";
    $id=$conn->insert_id;//當我新增一筆資料時獲得id
//    echo "id: $id";
    header("location: user-edit.php?id=".$id);
} else {
    echo "新增資料錯誤: " . $conn->error;
}