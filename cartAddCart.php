<?php
session_start();
require_once("pdo-connect.php");

$cartCount = 0;
foreach ($_SESSION["cart"] as $key => $value1) {
    $cartCount += $value1["num"];
}

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    //ID存在先讀取商品
    $sql = "SELECT * FROM products WHERE id=? AND valid=1";//從資料庫讀取id=$id商品資料
    $stmt1 = $db_host->prepare($sql);
    try {
        $stmt1->execute([$id]);
        $idExist = $stmt1->rowCount(); //確認是否有get到id

        if ($idExist > 0) {  //如果大於0才執行以下
            $result = $stmt1->fetch(); //抓出商品id=$id全部資訊存入關聯式陣列
            $stock = $result["stock_num"];
            $name = $result["name"];//先存name，要做路徑
            if (isset($_GET["num"]) && ctype_digit($_GET["num"])) { //在判斷num是否存在
                $num = $_GET["num"];
                $item = [  //取出需要的資料存成新的關聯式陣列
                    "id" => $result["id"],
                    "num" => $num,
                    "name" => $name,
                    "price" => $result["price"]
                ];

            } else {
                $num = 0;
                echo "<script>var name='$name'; alert('請輸入數字，且不為負數');document.location.href ='cart-product-detial.php?name='+name;</script> ";
            }

            //加入購物車
            if (isset($_SESSION['cart'][$id])) { //判斷是否有重複品項，若直接對數量+1
                $product = $_SESSION['cart'][$id];
                $productStock = $product["num"];
                if (($stock - $productStock) >= $num) { //判斷庫存，不可為0，因為還未加入商品
                    $product["num"] = $product["num"] + $num;
                    $_SESSION['cart'][$id] = $product;
                    $cartCount += $num;
                    echo "<script>var name='$name'; alert('已加入購物車');document.location.href ='cart-product-detial.php?name='+name;</script> ";
                } else {
                    echo "<script> var name='$name';alert('!!!!庫存不足!!!!');document.location.href ='cart-product-detial.php?name='+name;</script> ";
                }
            } else {//若沒有則直接存入第二陣列
                if ($stock - $num >= 0) {
                    $_SESSION['cart'][$id] = $item;
                    $cartCount += $num;
                    echo "<script>var name='$name'; alert('!!!!已加入購物車!!!!'); document.location.href ='cart-product-detial.php?name='+name;</script> ";
                } else {
                    echo "<script>var name='$name'; alert('!!!!庫存不足!!!!');document.location.href ='cart-product-detial.php?name='+name;</script> ";
                }
            }

            //$a = implode(",", $_SESSION['cart'][1]);//測試是否有存入用
        }
//    header("location:cart-product-list.php");
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

} else {
    $id = 0;
}