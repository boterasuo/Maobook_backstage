<?php
//連線到本地資料庫
session_start();
require_once("pdo-connect.php");
$cartCount = 0;
foreach ($_SESSION["cart"] as $key => $value1) {
$cartCount+=$value1["num"];
}


if(isset($_POST["account"]) && $cartCount>0) {
    $account = $_POST["account"];
    $name = $_POST["name"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    $email = $_POST["email"];

    $now = date("Y-m-d H:i:s");

//修改使用者資料
    $sql = "UPDATE users SET mailing_name='$name',mailing_phone='$phone',mailing_email='$email',mailing_address='$address'WHERE  account='$account'";
    $stmt = $db_host->prepare($sql);
    $stmt->execute();

//新增訂單
//存資料: 先抓出user的ID
    $sql1 = "SELECT id FROM users WHERE account=?  "; //AND valid=1
    $stmt1 = $db_host->prepare($sql1);
    $stmt1->execute([$account]);
    $row = $stmt1->fetch();
    $id = $row["id"];

//將資料存入user_order
    $sql2 = "INSERT INTO user_order (user_id,order_time,status) VALUES('$id','$now','1')";
    $stmt2 = $db_host->prepare($sql2);
    $stmt2->execute();
    $orderID = $db_host->lastInsertId(); //取得user_order的ID，將存入orderID

//抓出購物車資料
    if (!empty($_SESSION["cart"])) {
        $cart = array();
        $cart = $_SESSION["cart"];
        foreach ($cart as $key => $value) {
            $productID = $value["id"];
            $amount = $value["num"];

            //存入order_detail
            $sql3 = "INSERT INTO order_detail (order_id,product_id,amount) VALUES('$orderID','$productID','$amount')";
            $stmt3 = $db_host->prepare($sql3);
            $stmt3->execute();

            //更新庫存
            $sql4 = "SELECT stock_num FROM products WHERE id=?  AND valid=1";
            $stmt4 = $db_host->prepare($sql4);
            $stmt4->execute([$productID]);
            $row2 = $stmt4->fetch();
            $stock = $row2["stock_num"];
            $newStock = ($stock - $amount);

            $sql5 = "UPDATE products SET stock_num='$newStock' WHERE  id='$productID'";
            $stmt5 = $db_host->prepare($sql5);
            $stmt5->execute();
        }
    };

    //清除購物車

    unset($_SESSION['cart']);

    echo "<script> alert('訂單送出成功!');
        window.location.href='cart-shipping.php' ; 
    </script> ";
}

else{

    header("location: cart-shipping.php");

}
