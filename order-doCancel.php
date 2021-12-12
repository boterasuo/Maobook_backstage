<?php
require_once ("pdo-connect.php");

$id=$_GET["id"];

//取消訂單 status->5(已取消)
$sqlOrder="UPDATE user_order SET status=5 WHERE id=?";
$stmtOrder=$db_host->prepare($sqlOrder);


try{
    $stmtOrder->execute([$id]);
//    echo "使用者刪除成功<br>";
    echo "<script> alert('已取消訂單!'); window.location.href='order-edit.php?id=$id'</script>";
//    header("location: user-list.php");
}catch(PDOException $e){
    echo $e->getMessage();
}
