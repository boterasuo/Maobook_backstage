<?php
require_once ("pdo-connect.php");

$id=$_GET["user_id"];

//刪除訂單細項
$sqlOrder="DELETE FROM order_detail WHERE user_id=?";
$stmtOrder=$db_host->prepare($sqlOrder);
//$stmtOrder->execute([$id]);

try{
    $stmtOrder->execute([$id]);
    echo "<script> alert('刪除成功!'); window.location.href='order-list.php'</script>";
//    header("location: order-list.php");

}catch(PDOException $e){
    echo $e->getMessage();
}



