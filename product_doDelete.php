<?php

require_once ("db-connect.php");

$id = $_GET['id'];
$sql = "UPDATE products SET valid=0 WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    echo "資料已刪除<br>";
header("location: product_manage.php");
} else {
    echo "資料刪除失敗". $conn->error;
}

