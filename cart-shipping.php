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

//搜尋使用者資料

$account="user";
if (isset($_POST["useraccount"])) {
    $useraccount= $_POST["useraccount"];

}
$sql = "SELECT * FROM users WHERE account=?  AND valid=1";
$stmt = $db_host->prepare($sql);
try {
    $stmt->execute([$useraccount]);
    $userExist = $stmt->rowCount();
//    echo $userExist;
    if ($userExist > 0) {
        $row = $stmt->fetch();
        $id = $row["id"];
        $account=$row["account"];
        $name = $row["mailing_name"];
        $email = $row["mailing_email"];
        $phone = $row["mailing_phone"];
        $address = $row["mailing_address"];
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}
if(isset($useraccount)&&$useraccount===$account){
 $a="yes";
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
                <h1 class="title fs-2">購物車清單<?=$a?></h1>
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
                    $deliveryFee = 60; //運費
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
                        <h2 class="fs-4 border-bottom pb-2 mb-3 fw-bold">帳單資訊</h2>
                        <form class="d-grid gap-3 mb-3" action="" method="post" name="form1">
                            <div>
                                <label for="useraccount" class="text-danger">請輸入會員帳號</label>
                                <input  <?php if(isset($useraccount)&&$useraccount===$account):?> value="<?=$account?>" <?php endif;?> name="useraccount" type="text" class="form-control form-control" required >
                                <button id="yes" class="btn btn-mao-primary mt-2" type="submit" name="Submit">確認</button>


                            </div>
                        </form>
                        <form class="d-grid gap-3" action="" method="post" name="form2">
                            <?php if(isset($useraccount)&&$useraccount===$account):?>
                            <div>
                                <label for="name">聯絡人</label>
                                <input value="<?=$name?>" name="name" type="text" class="form-control form-control" placeholder="name" required>
                            </div>
                            <div>
                                <label for="validationCustom03" class="form-label">詳細地址</label>
                                <input value="<?=$address?>" type="text" class="form-control" id="validationCustom03" required>
                                <div class="invalid-feedback">請填入詳細地址</div>
                            </div>
                            <div>
                                <label for="phone">電話</label>
                                <input value="<?=$phone?>" name="phone" type="tel" class="form-control form-control">
                            </div>
                            <div>
                                <label for="email">Email</label>
                                <input value="<?=$email?>" name="email" class="form-control form-control" type="email">
                            </div>
                            <?php endif;?>

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
                                        <?php if ($totalPrice == 0) {
                                            $deliveryFee = 0;
                                        }
                                        ?>
                                        <div>NT$<?= $totalPrice ?></div>
                                        <div>+NT$<?= $deliveryFee ?></div>
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

<script>
    //安全檢查刪除購物車
    let count = '<?=$cartCount?>';//接住php變數
    if (count == 0) {  //判斷購物車是否為0
        stop()
    } else {
        let cleanAll = document.querySelector("#cleanAll");

        function doClean(e) { //執行警示窗
            if (window.confirm('是否要全部刪除?') == true) {
                document.location.href = "cartCleanAll.php?url=" + location.href;
            }
        }
        cleanAll.addEventListener('click', doClean);
    }

    //
    //var button = document.querySelector("#yes");

    //
    //
    //button.onclick = function () {
    //    alert("只限會員購買，請註冊會員");
    //};

    let button = document.querySelector("#yes");
    let userkeyin='<?=$useraccount?>';
    let account='<?=$account?>';


</script>
</body>
</html>

