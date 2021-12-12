<?php
//連線到本地資料庫
require_once ("pdo-connect.php");
//購物車商品數量總數計算
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
    $cartCount = 0;

}else{
    $cartCount = 0;
    foreach ($_SESSION["cart"] as $key => $value1) {
        $cartCount+=$value1["num"];
    }
}
//讀取商品
if(isset($_GET["name"])){
    $name=$_GET["name"];
}else{
    $name=0;
}
$sql="SELECT * FROM products WHERE name=? AND valid=1";
$stmt= $db_host->prepare($sql);
try {
    $stmt->execute([$name]);
    $result = $stmt->fetch();
    $totalProductCount=$stmt->rowCount(); //共有幾筆
}catch(PDOException $e){
    echo $e->getMessage();
}

//加入購物車，重新讀取商品，直接覆蓋上面$result
if(isset($_GET["id"])) {
    $id = $_GET["id"];
}else {
    $id = 0;
}
    $sql="SELECT * FROM products WHERE id=? AND valid=1";//從資料庫讀取id=$id商品資料
    $stmt1= $db_host->prepare($sql);
    try {
        $stmt1->execute([$id]);
        $idExist = $stmt1->rowCount(); //確認是否有get到id

        if ($idExist > 0) {  //如果大於0才執行以下
            $result = $stmt1->fetch(); //抓出商品id=$id全部資訊存入關聯式陣列
            $stock = $result["stock_num"];
            $item = [  //取出需要的資料存成新的關聯式陣列
                "id" => $result["id"],
                "num" => 1,
                "name" => $result["name"],
                "price" => $result["price"]
            ];
            if (isset($_SESSION['cart'][$id])) { //判斷是否有重複品項，若直接對數量+1
                $product = $_SESSION['cart'][$id];
                $productStock = $product["num"];
                if (($stock - $productStock) > 0) { //判斷庫存，不可為0，因為還為加入商品
                    $product["num"] = $product["num"] + 1;
                    $_SESSION['cart'][$id] = $product;
                    $cartCount+=1;
                    echo "<script> alert('已加入購物車');</script> ";
                } else {
                    echo "<script> alert('!!!!庫存不足!!!!');</script> ";
                }
            } else {//若沒有則直接存入第二陣列
                if ($stock - 1 >= 0) {
                    $_SESSION['cart'][$id] = $item;
                    $cartCount+=1;
                    echo "<script> alert('!!!!已加入購物車!!!!');</script> ";
                } else {
                    echo "<script> alert('!!!!庫存不足!!!!');</script> ";
                }
            }
            //$a = implode(",", $_SESSION['cart'][1]);//測試是否有存入用
        }
    }
    catch
        (PDOException $e){
            echo $e->getMessage();
        }
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

    <!--  板模的css、BS5、fontawesome  -->
    <?php require_once("style.php"); ?>
    <!--  板模end  -->

    <!-- 此處新增css檔 -->
    <style>
        .title{
            text-shadow: 3px 3px 3px #3335;
            color: peru;
        }
        .CartIcon{
            width:25px;
            height:25px;
        }
        header a{
            text-decoration: none;
            position: relative;
        }
        header span{
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
            top:-10px;
        }
    </style>
    <!-- Css檔 end   -->


</head>
<body class="sb-nav-fixed">
<?php require_once("main-nav.php"); ?>
<!--    本頁 內容    -->
<div id="layoutSidenav_content">
    <div class="container px-0 mt-5">
        <div class="main px-5">
            <header class="d-flex justify-content-between align-items-center mb-3">
                <h1 class="title fs-2">商品介紹</h1>
                <a class="link-secondary" href="cart-shipping.php" ><img class="CartIcon" src="images/shopping-bag.png"><span><?=$cartCount?></span></a>
            </header>
            <main >
                <a class="btn btn-secondary" href="cart-product-list.php">回商品區</a>
                <div class="row">
                    <div class="col-md-6">
                        <figure>
                            <img class="img-fluid px-5 py-5" src="images/product_images/<?=$result["img"]?>" alt="<?=$result["name"]?>">
                        </figure>
                    </div>
                    <div class="col-md-6 px-5 py-5">
                        <h1 class="fs-4"><?=$result["name"]?></h1>
                        <div class="fs-5 my-5">NT$<?=$result["price"]?></div>
                        <div class="fs-6 my-3 text-danger fw-bold">
                            庫存：<?php if($result["stock_num"]>=0) {echo $result["stock_num"];} else echo "0"?>
                        </div> <!--庫存檢查-->
                        <a class="btn btn-mao-primary" href="cart-product-detial.php?id=<?=$result["id"]?>">加入購物車</a>

                        <p class="fs-6 my-5 fw-bold">
                            <span>產品成分：</span>
                            <br>
                            <?=$result["description"]?>
                        </p>
                    </div>
                </div>

            </main>
        </div>
        <!--    --><?php //require_once("footer.php"); ?>
    </div>
</div>
<!--   本頁內容 end  -->

<?php require_once("JS.php"); ?>


</body>
</html>