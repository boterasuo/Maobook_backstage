<?php
require_once ("pdo-connect.php");

$id=$_GET["id"];

//取消訂單 status->0(已刪除)
$sqlOrder="DELETE FROM user_order WHERE id=?";
$stmtOrder=$db_host->prepare($sqlOrder);
//$stmtOrder->execute([$id]);

try{
    $stmtOrder->execute([$id]);

    echo "<script> alert('刪除成功!'); window.location.href='order-list.php'</script>";
//    header("location: order-list.php");

}catch(PDOException $e){
    echo $e->getMessage();
}



