<?php
//建立第一層
//連線到本地資料庫
require_once("pdo-connect.php");

//if(isset($_POST["user_id"])) {
//    $orderTime = $_POST["order_time"];
//    $tatus = $_POST["status"];
    $id = $_POST["user_id"];
    $now = date("Y-m-d H:i:s");

//插入使用者資料

    //新增訂單
//存資料: 先抓出user的ID
//    $sql1 = "SELECT id FROM users   "; //AND valid=1
//    $stmt1 = $db_host->prepare($sql1);
//    $stmt1->execute();
//    $row = $stmt1->fetch();


//將資料存入user_order
    $sql2 = "INSERT INTO user_order (user_id,order_time,status) VALUES('$id','$now','1')";
    $stmt2 = $db_host->prepare($sql2);
    $stmt2->execute();
    $orderID = $db_host->lastInsertId();//取得user_order的ID，將存入orderID

        $amount=$_POST["amount"];
        $productID=$_POST["product_id"];
        try{

            //存入order_detail
            $sql3 = "INSERT INTO order_detail (order_id,product_id,amount) VALUES('$orderID','$productID','$amount')";
            $stmt3 = $db_host->prepare($sql3);
            $stmt3->execute();
            echo "<script> alert('新增成功!'); window.location.href='order-add.php'</script>";

        }catch(PDOException $e){
            echo $e->getMessage();


    }




//}