<?php
require_once ("pdo-connect.php");

$order_detail_id=$_GET["order_detail_id"];
//echo $order_detail_id."<br>";
$order_id=$_GET["order_id"];
//echo $order_id;

//刪除訂單細項
$sqlOrder="DELETE FROM order_detail WHERE id=?";
$stmtOrder=$db_host->prepare($sqlOrder);
//$stmtOrder->execute([$id]);

try{
    $stmtOrder->execute([$order_detail_id]);
    echo "<script> alert('刪除成功!'); window.location.href='order-edit.php?id=$order_id'</script>";
//    header("location: order-list.php");

}catch(PDOException $e){
    echo $e->getMessage();
}



