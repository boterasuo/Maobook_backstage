<?php
//連線到本地資料庫
require_once("pdo-connect.php");
$URL = $_SERVER['PHP_SELF'];//取得當前php檔名，傳入清空購物車
//購物車商品數量總數計算
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
    $cartCount = 0;
} else {
    $cartCount = 0;
    foreach ($_SESSION["cart"] as $key => $value1) {
        $cartCount += $value1["num"];
    }
}

//商品清單：讀取全部商品
$sqlTotal = "SELECT * FROM products";
$stmt = $db_host->prepare($sqlTotal);
try {
    $stmt->execute();
    $row1 = $stmt->fetchAll(PDO::FETCH_ASSOC); //取出全部
    $totalProductCount = $stmt->rowCount(); //共有幾筆
} catch (PDOException $e) {
    echo $e->getMessage();
}

//購物車：判斷ID是否存在get
if (isset($_GET["id"])) {
    $id = $_GET["id"];

    $sql = "SELECT * FROM products WHERE id=? AND valid=1";//從資料庫讀取id=$id商品資料
    $stmt1 = $db_host->prepare($sql);
    try {
        $stmt1->execute([$id]);
        $idExist = $stmt1->rowCount(); //確認是否有get到id
        if ($idExist > 0) {  //如果大於0才執行以下
            $row2 = $stmt1->fetch(); //抓出商品
            $stock = $row2["stock_num"];
            $item = [
                "id" => $row2["id"],
                "num" => 1,
                "name" => $row2["name"],
                "price" => $row2["price"]
            ];
            if (isset($_SESSION['cart'][$id])) { //判斷是否有重複品項，若直接對數量+1
                $product = $_SESSION['cart'][$id];
                $productStock = $product["num"];
                if (($stock - $productStock) > 0) { //判斷庫存，不可為0，因為還為加入商品
                    $product["num"] = $product["num"] + 1;
                    $_SESSION['cart'][$id] = $product;
                    $cartCount += 1;
                    echo "<script> alert('已加入購物車');</script> ";
                } else {
                    echo "<script> alert('!!!!庫存不足!!!!');</script> ";
                }
            } else {//若沒有則直接存入第二陣列
                if ($stock - 1 >= 0) {
                    $_SESSION['cart'][$id] = $item;
                    $cartCount += 1;
                    echo "<script> alert('已加入購物車');</script> ";
                } else {
                    echo "<script> alert('!!!!庫存不足!!!!');</script> ";
                }
            }
        }

//        $a = implode(",", $_SESSION['cart'][1]);//測試用~~~確認是否有存入用

    } catch (PDOException $e) {
        echo $e->getMessage();
    }
} else {
    $id = 0;
}


//<!--做分頁-->
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="Description" content="MaoBook小組專題報告"/>
    <meta name="Content-Language" content="zh-TW">
    <meta name="author" content="Team MaoBook"/>
    <!--  網站圖示  -->
    <link rel="apple-touch-icon" type="image/png" href="images/logo-nbg.png"/>
    <link rel="shortcut icon" type="image/png" href="images/logo-nbg.png"/>
    <link rel="mask-icon" type="image/png" href="images/logo-nbg.png"/>

    <title>板模</title>
    <!--    <link rel="stylesheet" href="css2/shippingcart.css">-->
    <?php require_once("style.php"); ?>
    <style>
        .cover-fit {
            padding: 20px 0 10px 0;
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .title {
            text-shadow: 3px 3px 3px #3335;
            color: peru;
        }

        .CartIcon {
            width: 25px;
            height: 25px;
        }

        header a {
            text-decoration: none;
            position: relative;
        }

        header span {
            display: inline-block;
            width: 25px;
            height: 25px;
            background: darkorange;
            color: white;
            border-radius: 50%;
            text-align: center;
            line-height: 25px;
            position: absolute;
            left: 15px;
            top: -10px;
        }

        .CartIconSmall {
            width: 15px;
            height: 15px;
        }

        .card h5 {
            font-size: 15px;
            font-weight: 700;
            color: #333;
            margin: 10px 0 35px 0;
        }

        .card p {
            font-size: 12px;
            font-weight: 600;
            color: #333;
        }

        .card a {
            font-size: 12px;
            color: #6c757d;
        }
    </style>


</head>
<body class="sb-nav-fixed">
<?php require_once("main-nav.php"); ?>
<!-- 主要內容 -->
<div id="layoutSidenav_content">
    <div class="container px-0 mt-5">
        <div class="main px-5">
            <header class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="title fs-2">商品列表</h1>
                <a class="link-secondary " href="cart-shipping.php"><img class="CartIcon" src="images/shopping-bag.png"><span><?= $cartCount ?></span></a>
            </header>
            <div class="d-flex justify-content-end">
                <a onClick="return doClean()" class="btn btn-mao-primary mb-2">清空購物車</a>
            </div>
            <main>
                <div class="row">
                    <?php foreach ($row1

                    as $value): ?>
                    <div class="col-md-3 mb-5">
                        <div class="card"
                        ">
                        <a href="cart-product-detial.php?name=<?= $value["name"] ?>">
                            <figure class="m-0 ratio ratio-4x3">
                                <div>
                                    <img class=" cover-fit" src="images/product_images/<?= $value["img"] ?>"
                                         alt="minion">
                                </div>
                            </figure>
                        </a>
                        <div class="card-body">
                            <h5 class="card-title"><?= $value["name"] ?></h5>
                            <p class="card-text mb-2">NT$<?= $value["price"] ?></p>
                            <a id="addcart" class="link-secondary text-decoration-none d-flex align-items-center"
                               href="cart-product-list.php?id=<?= $value["id"] ?>">
                                <img class="CartIconSmall" src="images/shopping-bag.png">
                                <span class="text-end ms-1">加入購物車</span>
                            </a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
        </div>
        <!--分頁-->


        </main>
    </div><!-- 主要內容end -->

</div>
<!--    --><?php //require_once("footer.php"); ?>
</div>
<?php require_once("JS.php"); ?>

<script>
    let count = <?=$cartCount?>; //接住php變數

    //安全檢查刪除購物車
    function doClean() {
        if (count === 0) {
            alert('購物車"沒有"商品 ! ');
        } else if (confirm('確定要清空購物車嗎?') === true) {
            document.location.href = "cartCleanAll.php?url=" + location.href;
        }
        return false;
    }


</script>

</body>
</html>
