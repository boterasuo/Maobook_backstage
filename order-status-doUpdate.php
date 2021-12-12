<?php
require_once("pdo-connect.php");

//user-order
//status
$id=$_POST["id"]; //訂單id
$user_id=$_POST["user_id"]; //訂購人id
$order_time=$_POST["order_time"]; //
$status=$_POST["status"]; //


$sqlSelect="UPDATE user_order SET  user_id=?, order_time=?, status=? WHERE id=?";
$stmtSelect=$db_host->prepare($sqlSelect);
try{
    $stmtSelect->execute([$user_id, $order_time, $status,$id]);
    echo "<script> alert('狀態修改成功!'); window.location.href='order-edit.php?id=$id'</script>";
}catch(PDOException $e){
    echo $e->getMessage();
}


