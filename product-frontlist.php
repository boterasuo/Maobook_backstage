<?php
//連線到遠端資料庫
//require_once("domain-pdo-connect.php");
require_once ("111pdo-connect.php");
//讀取商品
$sqlTotal="SELECT * FROM products";
$stmt= $db_host->prepare($sqlTotal);
try {
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC); //取出全部
    $totalProductCount=$stmt->rowCount(); //共有幾筆
}catch(PDOException $e){
    echo $e->getMessage();
}

//<!--做分頁-->

$sqlPage="SELECT * FROM products WHERE valid=1 ORDER BY id LIMIT 6";
try {
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC); //取出全部
    $productCount=$stmt->rowCount(); //共有幾筆
}catch(PDOException $e){
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
<!--    <link rel="stylesheet" href="css2/shippingcart.css">-->
    <?php require_once("style.php"); ?>
    <style>
        .cover-fit{
            padding: 20px 0 10px 0;
            width: 100%;
            height: 100%;
            object-fit: contain;
        }
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
            width: 20px;
            height: 20px;
            background: darkorange;
            color: white;
            border-radius: 50%;
            text-align: center;
            line-height: 20px;
            position: absolute;
            left: 15px;
            top:-10px;
        }
        .CartIconSmall{
            width:15px;
            height:15px;
        }
        .card h5{
            font-size: 15px;
            font-weight:700;
            color: #333;
            margin:10px 0 35px 0;
        }
        .card p{
            font-size: 12px;
            font-weight:600;
            color: #333;
        }
        .card a{
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
            <header class="d-flex justify-content-between align-items-center mb-5">
                <h1 class="title fs-2">商品列表</h1>
                <a class="link-secondary " href="shipping-cart.php" ><img class="CartIcon" src="/maobook-main/images/shopping-bag.png"><span>5</span></a>
            </header>
            <main>
                <div class="row">
                    <?php foreach($rows as $value): ?>
                    <div class="col-md-3 mb-5">
                        <div class="card" ">
                                <a href="products-frontdetial.php?id=<?=$value["id"]?>">
                                    <figure class="m-0 ratio ratio-4x3">
                                        <div>
                                            <img class=" cover-fit" src="/maobook-main/images/product_images/<?=$value["img"]?>"  alt="minion">
                                        </div>
                                    </figure>
                                </a>
                            <div class="card-body">
                                <h5 class="card-title"><?=$value["name"]?></h5>
                                <p class="card-text mb-2">NT$<?=$value["price"]?></p>
                                <a class="link-secondary text-decoration-none d-flex align-items-center" href="doShippingcart.php">
                                    <img class="CartIconSmall" src="/maobook-main/images/shopping-bag.png">
                                    <span class="text-end ms-1">加入購物車</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            <!--分頁-->


            </main>



            <!--    本頁 內容    -->
            <!--   本頁內容 end  -->


        </div><!-- 主要內容end -->

    </div>
<!--    --><?php //require_once("footer.php"); ?>

</div>
<?php require_once("JS.php"); ?>
</body>
</html>
