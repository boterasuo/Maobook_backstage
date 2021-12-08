<?php
//連線到本地資料庫
require_once ("pdo-connect.php");
//session讀取
//購物袋數量顯示:先判斷是否有購物車存在，沒有就建一個新的購物車陣列，購物車數量顯示0，沒有則顯示原本購物車數量

if( !isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
    $cartCount=0; //購物車預設0;
}
else{ $cartCount=count( $_SESSION['cart']); }
//商品清單：讀取全部商品
$sqlTotal="SELECT * FROM products";
$stmt= $db_host->prepare($sqlTotal);
try {
    $stmt->execute();
    $row1 = $stmt->fetchAll(PDO::FETCH_ASSOC); //取出全部
    $totalProductCount=$stmt->rowCount(); //共有幾筆
}catch(PDOException $e){
    echo $e->getMessage();
}

//購物車：判斷ID是否存在get
if(isset($_GET["id"])){
    $id=$_GET["id"];
}else{
    $id=0;
}
$sql="SELECT * FROM products WHERE id=$id AND valid=1";//從資料庫讀取id=$id商品資料
$stmt1= $db_host->prepare($sql);
try {
    $stmt1->execute();
    $idExist=$stmt1->rowCount(); //確認是否有get到id
    if($idExist>0) {  //如果大於0才執行以下
        $row2 = $stmt1->fetch(); //抓出商品id=$id全部資訊存入關聯式陣列
        $item=[  //取出需要的資料存成新的關聯式陣列
            "id"=>$row2["id"],
            "數量"=>1,
            "商品"=>$row2["name"],
            "價錢"=>$row2["price"]
        ];

        if (isset($_SESSION['cart'][$id])) { //判斷是否有重複品項，若直接對數量+1
            $countAmount=$_SESSION['cart'][$id];
            $countAmount["數量"]=$countAmount["數量"]+1;
            $_SESSION['cart'][$id]=$countAmount;
        }
        else{  //若有則直接存入第二陣列
            $_SESSION['cart'][$id] = $item;

        }
        $cartCount=count( $_SESSION['cart']); //重新計算購物車總數
//        $a = implode(",", $_SESSION['cart'][1]);//測試是否有存入用
    }

}catch(PDOException $e){
    echo $e->getMessage();
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
                <a class="link-secondary " href="cart-shipping.php" ><img class="CartIcon" src="images/shopping-bag.png"><span><?=$cartCount?></span></a>
            </header>
            <main>
                <div class="row">
                    <?php foreach($row1 as $value): ?>
                    <div class="col-md-3 mb-5">
                        <div class="card" ">
                                <a href="cart-product-detial.php?id=<?=$value["id"]?>">
                                    <figure class="m-0 ratio ratio-4x3">
                                        <div>
                                            <img class=" cover-fit" src="images/product_images/<?=$value["img"]?>"  alt="minion">
                                        </div>
                                    </figure>
                                </a>
                            <div class="card-body">
                                <h5 class="card-title"><?=$value["name"]?></h5>
                                <p class="card-text mb-2">NT$<?=$value["price"]?></p>
                                <a class="link-secondary text-decoration-none d-flex align-items-center" href="cart-product-list.php?id=<?=$value["id"]?>">
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
<!--<script>-->
<!--  let addCart=document.querySelector("#addCart");-->
<!--  let cartNum=document.querySelector("#cartNum");-->
<!--  let cartCount=0;-->
<!---->
<!--  addCart.onclick=function (){-->
<!--      cartCount+=1;-->
<!--  }-->
<!--  cartNum.textContent=cartCount;-->
<!--</script>-->
</body>
</html>
