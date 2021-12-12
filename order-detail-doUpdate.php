<?php
require_once("pdo-connect.php");

//user_order
$id=$_POST["id"]; //訂單id
//$user_id=$_POST["user_id"];
//$name=$_POST["status"];

//order_detail
$image=$_POST["img"];
$product_id=$_POST["product_id"];
$amount=$_POST["amount"];
$order_id=$_POST["order_id"];


$sqlUser="UPDATE order_detail SET amount=? WHERE id=?";
$stmtUser=$db_host->prepare($sqlUser);
try{
    $stmtUser->execute([$amount,  $id]);
    echo "<script> alert('狀態修改成功!'); window.location.href='order-detail.php?id=$id'</script>";

}catch(PDOException $e){
    echo $e->getMessage();
}


