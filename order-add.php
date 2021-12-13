<?php
require_once("pdo-connect.php");


//商品資訊

//廠商品牌分類
$sql_Brand = "SELECT * FROM brand_category";
$stmt_Brand = $db_host->prepare($sql_Brand);
$stmt_Brand->execute();
$Brand_categoryArr = [];
while ($row_Brand = $stmt_Brand->fetch()) {
    $Brand_categoryArr[$row_Brand["id"]] = $row_Brand["name"];
}
//商品類型
$sql_Product = "SELECT * FROM product_category";
$stmt_Product = $db_host->prepare($sql_Product);
$stmt_Product->execute();
$Product_categoryArr = [];
while ($row_Product = $stmt_Product->fetch()) {
    $Product_categoryArr[$row_Product["id"]] = $row_Product["name"];
}
//寵物類型
$sql_Pet = "SELECT * FROM pet_category";
$stmt_Pet = $db_host->prepare($sql_Pet);
$stmt_Pet->execute();
$Pet_categoryArr = [];
while ($row_Pet = $stmt_Pet->fetch()) {
    $Pet_categoryArr[$row_Pet["id"]] = $row_Pet["name"];
}
//全部商品資料
$sql = "SELECT * From products WHERE valid=1";
$stmt = $db_host->prepare($sql);
try {
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $productCount = $stmt->rowCount();
    $resultArr = array_column($results, "product", "id");
} catch (PDOException $e) {
    echo $e->getMessage();
}


//搜尋使用者資料
$account = "user";
$useraccount = "useraccount";
if (isset($_POST["useraccount"])) {
    $useraccount = $_POST["useraccount"];

}
$sql = "SELECT * FROM users WHERE id=?  ";  //AND valid=1
$stmt = $db_host->prepare($sql);
try {
    $stmt->execute([$useraccount]);
    $userExist = $stmt->rowCount();
//    echo $userExist;
    if ($userExist > 0) {
        $row = $stmt->fetch();
        $id = $row["id"];
        $account = $row["account"];
        $name = $row["mailing_name"];
        $email = $row["mailing_email"];
        $phone = $row["mailing_phone"];
        $address = $row["mailing_address"];
    }
} catch (PDOException $e) {
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

    <title>新增訂單</title>

    <?php require_once("style.php"); ?>
    <!-- 此處新增css檔 -->
    <!--    <link rel="stylesheet" href="css/anun-style.css">-->
    <!-- Css檔 end   -->
    <style>

        /*訂購人資訊 頭像*/
        .avatar {
            width: 60px;
        }

    </style>
</head>
<body class="sb-nav-fixed">
<?php require_once("main-nav.php"); ?>
<!-- 主要內容 -->
<div id="layoutSidenav_content">
    <div class="container-fluid px-0">
        <main class="main px-5">
            <!--                <div class="container px-0">-->
            <ol class="breadcrumb mb-2 mt-4">
                <li class="breadcrumb-item"><a href="home.php">首頁</a></li>
                <li class="breadcrumb-item"><a href="order-list.php">所有訂單</a></li>
                <li class="breadcrumb-item active">新增訂單</li>
            </ol>
            <h3 class="h3 mb-2 d-inline-block me-2">新增訂單</h3>
            <!--   row    -->
            <div class="row ">
                <!-- 左側col -->
                <div class="col-4 d-inline-block">
                    <div class="card my-0">
                        <div class="card-header justify-content-between" title="新增訂單">
                            <a><i class="fas fa-cart-arrow-down me-1 end-0"></i>
                                建立訂單</a>
                        </div>
                        <div class="card-body">
                            <!--    本頁 內容    -->
                            <form class="d-grid gap-3 mb-3" action="order-doInsert.php" method="post" name="form1">
<!--                                <div>-->
                                    <label for="user_id" class="text-muted ">請輸入會員id</label>
                                    <input name="user_id" type="text" class="form-control" required>
                                    <!-- 狀態: 訂單成立 -->
<!--                                    <input type="hidden" class="form-control" name="status" value="1">-->
                                    <!-- 訂購時間  -->
<!--                                    <label class="mb-2">-->
                                        <!--                                        <label for="order_time">下單時間</label>-->
                                        <input id="order_time" class="form-control" type="hidden" name="order_time"
                                               value="<?= date('Y/m/d h:i:s'); ?>" readonly>
                                        <label class="mt-2 for="product_id">請輸入商品ID</label>
                                        <input class="form-control" id="product_id" name="product_id" type="text">
                                        <label class="mt-2" for="amount">購買數量</label>
                                        <select class="form-control" id="amount" name="amount">
                                            <option class="text-muted" disabled readonly selected>請選擇數量</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                        <!--                        <label for="order_id"></label>-->
                                        <!--                        <input id="order_id" name="order_id" type="text" value="--><?//=$order_id ?><!--">-->
                                        <button class="btn btn-mao-primary mt-2" type="submit" name="Submit">確認
                                        </button>
                            </form>
                        </div>
                    </div>
                </div>
            <!-- 左側col end -->

            <!-- 右側col -->
            <div class="col-8 d-inline-block ">
                <!--  簡易查詢   -->
                <div>
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <a><i class="fas fa-search me-1 end-0"></i>簡易查詢</a>
                            <a href="cart-product-list.php" title="詳細商品頁面" target="_blank">
                                <i class="fas fa-cart-plus me-1 end-0 text-muted"></i>
                            </a>
                        </div>
                        <div class="card-body ">
                            <!-- 表格區塊 含user-list.php的php語法 -->
                            <div class="card-body">
                                <table id="datatablesSimple">

                                        <!-- 標題欄 -->
                                        <thead>
                                        <tr>
                                            <!-- 表格註腳 thead -->
                                            <th>商品ID</th>
                                            <th width="60%">名稱</th>
                                            <th>價格</th>
                                        </tr>
                                        </thead>
                                        <!-- 總結資訊 tfoot -->
                                        <tfoot>
                                        <tr>
                                            <th>商品ID</th>
                                            <th width="60%">名稱</th>
                                            <th>價格</th>
                                        </tr>
                                        </tfoot>
                                        <!-- 資料欄 tbody -->
                                        <tbody>
                                        <?php if ($productCount > 0):
                                            foreach ($results as $value): ?>
                                                <tr>
                                                    <td><?= $value["id"] ?></td>
                                                    <td><?= $value["name"] ?></td>
                                                    <td><?= $value["price"] ?></td>
                                                </tr>
                                            <?php
                                            endforeach;
                                        else: ?>
                                            <tr>
                                                <td colspan="3">目前未有商品上架！</td>
                                            </tr>
                                        <?php endif; ?>
                                        </tbody>
                                    </table>
                            </div><!-- 表格區塊 end -->
                        </div>
                        <!--  簡易查詢  end  -->
                        <!-- 右側col end -->
                    </div><!--row end -->
                </div>
                <!--   本頁內容 end  -->
                <!--      row end    -->
            </div>
        </main><!-- 主要內容end -->
        <?php require_once("JS.php"); ?>
    </div>
</div>
<script>
    // function openWindow() {
    //     window.open("http://localhost/pj_maobook/user-list.php", "_self");
    // }

    // function checkDelete() {
    //     if (!confirm('確認刪除該筆訂單嗎 ? 已刪除內容資料庫將無法保存')) {
    //         return false;
    //     }
    // }

    // function checkCancel() {
    //     if (!confirm('確認取消該筆訂單嗎 ?')) {
    //         return false;
    //     }
    // }

    // let showbtn = document.querySelector("#showBtn");
    // let closebtn = document.querySelector("#closeBtn");
    // var Box = document.querySelector('#showarea');
    // showbtn.onclick = function () {
    //     Box.style.visibility = "visible";
    // }
    // closebtn.onclick = function () {
    //     Box.style.visibility = "hidden";
    // }

</script>

</body>
</html>
