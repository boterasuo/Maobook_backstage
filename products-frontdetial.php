<?php
//連線到本地資料庫
//require_once("domain-pdo-connect.php");
require_once ("pdo-connect.php");
//session讀取
$cartCount=count( $_SESSION['cart']); //購物車總數
//讀取商品
if(isset($_GET["id"])){
    $id=$_GET["id"];
}else{
    $id=0;
}
$sql="SELECT * FROM products WHERE id='$id' AND valid=1";
$stmt= $db_host->prepare($sql);
try {
    $stmt->execute();
//    $row = $stmt->fetch(PDO::FETCH_ASSOC); //取出全部
    $totalProductCount=$stmt->rowCount(); //共有幾筆
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
                <a class="link-secondary" href="shipping-cart.php" ><img class="CartIcon" src="images/shopping-bag.png"><span><?=$cartCount?></span></a>
            </header>
            <main >
                <a class="btn btn-secondary" href="product-frontlist.php">回商品區</a>
                <div class="row">
                    <?php while($result=$stmt->fetch(PDO::FETCH_ASSOC)): ?>
                    <div class="col-md-6">
                        <figure>
                            <img class="img-fluid px-5 py-5" src="images/product_images/<?=$result["img"]?>" alt="<?=$result["name"]?>">
                        </figure>
                    </div>
                    <div class="col-md-6 px-5 py-5">
                        <h1 class="fs-4"><?=$result["name"]?></h1>
                        <div class="fs-5 my-5">NT$<?=$result["price"]?></div>
                        <div class="fs-6 my-3 text-danger fw-bold">庫存：<?=$result["stock_num"]?></div>
                        <button type="button" class="btn btn-mao-primary">加入購物車</button>
                        <p class="fs-6 my-5 fw-bold">
                            <span>產品成分：</span>
                            <br>
                            <?=$result["description"]?>
                        </p>
                    </div>
                    <?php endwhile; ?>
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
