<?php
require_once("pdo-connect.php");
session_start();
$id=$_POST["id"];
$orderDetailsCount=$_SESSION["orderDetailsCount"];
//echo "$orderDetailsCount";
for($i=0; $i<($orderDetailsCount-1); $i++){
    $amount=$_POST["amount".$i];
    $detail_id=$_POST["order_detail_id".$i];
    if($amount==0){
        $sqlOderDetail="DELETE FROM order_detail WHERE id=?";
        $stmtOderDetail=$db_host->prepare($sqlOderDetail);
        $stmtOderDetail->execute([$detail_id]);
    }else{
        $sqlOderDetail="UPDATE order_detail SET amount=? WHERE id=?";
        $stmtOderDetail=$db_host->prepare($sqlOderDetail);
        $stmtOderDetail->execute([$amount, $detail_id]);
    }
}

header("location: order-detail.php?id=$id");



//user_order
//$id=print_r($_POST["id"]); //訂單id
////$user_id=$_POST["user_id"];
////$name=$_POST["status"];
//
////order_detail
////$image=$_POST["img"];
//$product_id=print_r($_POST["product_id"]);
//$amount=print_r($_POST["amount"]);
//$order_id=print_r($_POST["order_id"]);


//$sqlUser="UPDATE order_detail SET product_id=?, amount=? WHERE order_id=?  ";
//$stmtUser=$db_host->prepare($sqlUser);
////$productArr=in_array([$product_id],[$amount],[$order_id],[$id]);
//try{
//    $stmtUser->execute([$product_id,$amount,$order_id]);
//    echo "<script> alert('狀態修改成功!'); window.location.href='order-detail.php?id=$id'</script>";
//
//}catch(PDOException $e){
//    echo $e->getMessage();
//}


