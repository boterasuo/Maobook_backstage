<?php
//連線到本地資料庫
require_once("pdo-connect.php");
$URL = $_SERVER['PHP_SELF'];//取得當前取得當前php檔名，傳入清空購物車
////右上購物車總數判斷
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
    $cartCount = 0; //購物車預設0;
}
if (empty($_SESSION['cart'])) {
    $cartCount = 0; //購物車預設0;
} else {
    $cartCount = count($_SESSION['cart']);
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

        .table {
            margin-bottom: 80px;
        }

        .pay {
            width: 500px;
            height: 200px;
            background: #cccccc;
            border-radius: 30px;
            box-shadow: 12px 12px 7px rgba(0, 0, 0, 0.4);
            margin-left: 60px;
            margin-top: 80px;
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
                <h1 class="title fs-2">購物車清單</h1>
                <a class="link-secondary" href="cart-shipping.php"><img class="CartIcon"
                                                                        src="images/shopping-bag.png"><span><?= $cartCount ?></span></a>
            </header>
            <div class="d-flex justify-content-end">
                <a class="btn btn-secondary mb-5 me-2" href="cart-product-list.php">回商品區</a>
                <a id="cleanAll" class="btn btn-secondary mb-5" ">清空購物車</a>
            </div>
            <main>
                <table class="table table-hover ">
                    <thead>
                    <tr>
                        <th scope="col">商品</th>
                        <th class="text-end" scope="col">價格</th>
                        <th class="text-end" scope="col">數量</th>
                        <th class="text-end" scope="col">小計</th>
                        <th class="text-end" scope="col">刪除</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $totalPrice = 0;
                    $deliveryFee=60; //運費
                    if (!empty($_SESSION["cart"])):
                        $cart = array();
                        $cart = $_SESSION["cart"];
                        foreach ($cart as $key => $value): ?>
                            <?php
                            $totalPrice += $value["price"] * $value["num"];
                            ?>
                            <tr>
                                <td class="align-middle"><?= $value["name"] ?></td>
                                <td class="text-end align-middle"><?= $value["price"] ?></td>
                                <td class="text-end align-middle"><?= $value["num"] ?></td>
                                <td class="text-end align-middle"><?= $value["price"] * $value["num"] ?></td>

                                <td class="text-end"><a href="cartCleanItem.php?id=<?= $value["id"] ?>"><i
                                                class="far fa-2x fa-trash-alt"></i></a></td>
                            </tr>
                        <?php endforeach; ?>
                        <tr>
                            <td colspan="4" class="text-end">總計：<?= $totalPrice ?></td>
                        </tr>
                    <?php else: ?>
                        <tr>
                            <td colspan="5">尚未有訂單</td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>

                <div class="row m-0 mb-5 ">
                    <div class="col-5 p-0">
                        <form class="d-grid gap-3" action="">
                            <h2 class="fs-4 border-bottom pb-2 mb-3 fw-bold">帳單資訊</h2>
                            <div>
                                <lebel class="text-danger">請輸入會員帳號</lebel>
                                <input class="form-control form-control" type="text"
                                       placeholder="type your account name">
                            </div>
                            <div>
                                <lebel>姓名</lebel>
                                <input class="form-control form-control" type="text" placeholder="name">
                            </div>
                            <div>
                                <lebel>地址</lebel>
                                <input class="form-control form-control" type="text" placeholder="address">
                            </div>
                            <div>
                                <lebel>電話</lebel>
                                <input class="form-control form-control" type="text" placeholder="phone">
                            </div>
                            <div>
                                <lebel>Email</lebel>
                                <input class="form-control form-control" type="text" placeholder="email">
                            </div>

                        </form>
                    </div>
                    <div class="pay col-5  p-4">
                        <div>
                            <form action="">
                                <div class="row text-end m-0">
                                    <div class="col-10 d-grid gap-3 ">
                                        <div>商品總金額：</div>
                                        <div>運費：</div>
                                        <div>結帳金額：</div>
                                    </div>
                                    <div class="col-2 d-grid gap-3">
                                        <?php if ($totalPrice == 0){
                                            $deliveryFee=0;}
                                        ?>
                                        <div>NT$<?= $totalPrice ?></div>
                                        <div>+NT$<?=$deliveryFee ?></div>
                                        <div>NT$<?= $totalPrice + $deliveryFee ?></div>
                                    </div>
                                </div>
                                <div class=" d-grid">
                                    <button type="button" class="btn btn-mao-primary mt-3 ">下單購買</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </main>
        </div>
        <!--    --><?php //require_once("footer.php"); ?>
    </div>
</div>
<!--   本頁內容 end  -->

<?php require_once("JS.php"); ?>

<script>//安全檢查刪除購物車
    let count = '<?=$cartCount?>';//接住php變數

    if (count == 0) {  //判斷購物車是否為0
        stop()
    } else {
        let cleanAll = document.querySelector("#cleanAll");

        function doClean(e) { //執行警示窗
            if (window.confirm('是否要全部刪除?') == true) {
                document.location.href = "cartCleanAll.php?url=" + location.href;
            }
        };
        cleanAll.addEventListener('click', doClean);
    }
</script>
</body>
</html>

