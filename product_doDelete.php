<?php

require_once ("pdo-connect.php");

$id = $_GET['id'];

$sql = "UPDATE products SET valid=0 WHERE id=? ";
$stmt=$db_host->prepare($sql);

try {
    $stmt->execute([$id]);
//    echo "<script> alert('刪除成功!'); window.location.href='product_manage.php'</script>";
    header("location: product_manage.php");
}catch(PDOException $e){
    echo $e->getMessage();
}


