<?php
require_once("pdo-connect.php");
if (isset($_GET["id"])):
    $id = $_GET["id"]; //order id
    $sqlOrder = "SELECT * FROM user_order WHERE id=?";//從訂單抓資料
    $stmtOrder = $db_host->prepare($sqlOrder);
    try {
        $stmtOrder->execute([$id]);
        $rowOrder = $stmtOrder->fetch(); //訂單資料

    } catch (PDOException $e) {
        echo "取得訂單資訊錯誤<br>";
        echo $e->getMessage();
    }
// 抓取 users 會員資料表
    $id = $_GET["id"]; //user id
    $sqlUser = "SELECT * FROM users WHERE id=?";
    $stmtUser = $db_host->prepare($sqlUser);
    try {
        $stmtUser->execute([$id]);
        $rowUser = $stmtUser->fetch();//會員資料
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

//抓取 user_order
    $sqlOrderList = "SELECT * FROM user_order WHERE user_id=?";
    $stmtOrderList = $db_host->prepare($sqlOrderList);
    try {
        $stmtOrderList->execute([$id]);
        $rowOrderList = $stmtOrderList->fetch(PDO::FETCH_ASSOC);
        $orderCount = $stmtOrderList->rowCount();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

//選擇訂單總金額、產品名稱、產品價格、產品圖片從[order-detail]加入到[products]參考ON在order_detail.product_id = products.id
    $sql = "SELECT order_detail.amount, products.name, products.price, products.img FROM order_detail 
JOIN products ON order_detail.product_id = products.id
WHERE order_detail.order_id = ?";
    $stmt = $db_host->prepare($sql);
    try {
        $stmt->execute([$id]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
//    $rowOrder=$stmtOrder->fetch();
    } catch (PDOException $e) {
        echo "取得訂單細節錯誤<br>";
        echo $e->getMessage();
    }

//抓status的名稱 [user_order].status -> [order_status].name
    $sql = "SELECT order_status.name,order_status.id, user_order.status, user_order.id FROM user_order JOIN order_status ON user_order.status = order_status.id
WHERE user_order.id = ?";
    $stmtOrderStatus = $db_host->prepare($sql);
    try {
        $stmtOrderStatus->execute([$id]);
        $statusRow = $stmtOrderStatus->fetch(PDO::FETCH_ASSOC);
//    $rowOrder=$stmtOrder->fetch();
    } catch (PDOException $e) {
        echo "取得訂單細節錯誤<br>";
        echo $e->getMessage();
    }

//抓user_id的名稱[user_order].user_id -> [users].id
    $sql = "SELECT  user_order.user_id, user_order.id, users.name FROM user_order JOIN users ON user_order.user_id = users.id
WHERE user_order.id = ?";
    $stmtOrderUser = $db_host->prepare($sql);
    try {
        $stmtOrderUser->execute([$id]);
        $orderUserRow = $stmtOrderUser->fetch(PDO::FETCH_ASSOC);
//    $rowOrder=$stmtOrder->fetch();
    } catch (PDOException $e) {
        echo "取得訂單細節錯誤<br>";
        echo $e->getMessage();
    }
endif;


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

    <title>訂單編號：<?= $rowUser["id"] ?></title>

    <?php require_once("style.php"); ?>
    <!-- 此處新增css檔 -->
    <!--    <link rel="stylesheet" href="css/anun-style.css">-->
    <!-- Css檔 end   -->
    <style>
        .text {
            font-weight: 600;
            margin-bottom: 15px;
        }

        .pointer{
            cursor: pointer;
        }
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
                <li class="breadcrumb-item"><a href="order-list.php">訂單查詢</a></li>
                <li class="breadcrumb-item active">訂單管理</li>
            </ol>
            <h3 class="h3 mb-4 d-inline-block me-2">訂單編號：#<?= $id ?></h3>
            <small class="text-muted me-2 d-inline-block" title="訂單成立時間：<?= $rowOrder["order_time"] ?>">
                <time><?= $rowOrder["order_time"] ?></time>
            </small>
            <small class="d-inline-block rounded-pill border border-5 " title="<?= $statusRow["name"] ?>">
                <status>&nbsp; <?= $statusRow["name"] ?>&nbsp;</status>
            </small>


            <!--   row    -->
            <div class="row ">
                <!-- 左側col -->
                <div class="col-8 ">
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between">
                            <a><i class="fas fa-table me-1 end-0"></i>
                                訂單明細</a>
                            <a href="order-edit.php?id=<?= $id ?>" title="修改訂單">
                                <i class="fas fa-edit me-1 end-0 " ></i>
                            </a>
                        </div>
                        <div class="card-body">
                            <!--    本頁 內容    -->

                            <table class="table table-bordered table-sm"><!-- id="datatablesSimple" -->
                                <thead>
                                <tr>
                                    <th>產品名稱</th>
                                    <th>產品名稱</th>
                                    <th>單價</th>
                                    <th>數量</th>
                                    <th>小計</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $total = 0;
                                foreach ($rows as $value): ?>
                                    <tr>
                                        <td><a href="cart-product-detial.php?name=<?= $value["name"] ?>"
                                               title="<?= $value["name"] ?>">
                                                <img src="images/product_images/<?= $value["img"] ?>" alt=""
                                                     width="100px">
                                            </a></td><!-- 商品圖片 -->
                                        <td><?= $value["name"] ?></td> <!-- 訂購人名稱 -->

                                        <td class="text-end"><?= $value["price"] ?></td>
                                        <td class="text-end"><?= $value["amount"] ?></td>
                                        <td class="text-end"><?php
                                            $subtotal = $value["amount"] * $value["price"];
                                            echo $subtotal;
                                            //                            $total=$total+$subtotal;
                                            $total += $subtotal;

                                            ?></td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td class="text-end h3 bg-mao-primary " colspan="12">總計: <?= $total ?></td>
                                </tr>
                                </tfoot>
                            </table>
                            <div class="text-end">
                                <a href="order-edit.php?id=<?= $rowOrder["user_id"] ?>" class="btn btn-warning">修改數量</a>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- 左側col end -->

                <!-- 右側col -->
                <div class="col-4 ">

                    <!--  客戶資訊   -->
                    <div>
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <a><i class="fas fa-user-tag me-1 end-0"></i>客戶資訊</a>
                                <a href="user.php?id=<?=$rowOrder["user_id"]?>" title="查看會員資料" target="_blank">
                                    <i class="fas fa-external-link-alt me-1 end-0 text-muted" ></i>
                                </a>
                            </div>
                            <div class="card-body ">
                                <!--頭貼-->
                                <?php if (is_null($rowUser["image"])): ?>
                                    <a href="user.php?id=<?= $rowOrder["user_id"] ?>" title="檢視買家">
                                        <img class="avatar cover-fit rounded-circle float-start me-2"
                                             src="images/default_avatar.png"
                                             alt=""></a>
                                <?php else: ?>
                                    <a href="user.php?id=<?= $rowOrder["user_id"] ?>" title="檢視買家" target="_blank">
                                        <img class=" avatar cover-fit rounded-circle float-start me-2" src="images/<?=$rowUser["image"]?>" alt=""></a>
                                <?php endif; ?>
                                訂購人: <a href="user.php?id=<?= $rowOrder["user_id"] ?>"
                                        title="查看【<?= $orderUserRow["name"] ?>】的會員資料" target="_blank"><?= $orderUserRow["name"] ?></a>
                                <p><?php if($rowUser != NULL):?>
                                        <?= $rowUser["mailing_email"] ?><?php else:{ } endif;?></p>
                                <br>
                            </div>
                        </div>
                        <!--  客戶資訊  end  -->
                        <br>
                        <!--  宅配地址   -->
                        <div>
                            <div class="card">
                                <div class="card-header d-flex justify-content-between">
                                    <a><i class="fas fa-truck me-1 end-0"></i>宅配資訊</a>
<!--                                    <a href="user-edit.php?id=--><?//= $id ?><!--">-->
<!--                                        <i class="fas fa-edit me-1 end-0 text-muted"></i>-->
<!--                                    </a>-->
                                </div>
                                <div class="card-body ">
                                    <p>
                                        <?php if(isset($rowUser["mailing_name"])):?>
                                        收件人:　<?= $rowUser["mailing_name"] ?><br>
                                        地址：　<?= $rowUser["mailing_address"] ?><br>
                                        手機：　<?= $rowUser["mailing_phone"] ?><br>
                                        信箱：　<?= $rowUser["mailing_email"] ?></p>
                                    <?php else: echo "未登錄資訊"; endif;?>
                                </div>
                            </div>
                            <!--  宅配地址  end  -->

                            <!-- 右側col end -->
                            <!--   本頁內容 end  -->
                        </div>
                    </div>

        </main><!-- 主要內容end -->
        <!--    --><?php //require_once("footer.php"); ?>
    </div>
    <?php require_once("JS.php"); ?>

    <script>
        function openWindow() {
            window.open("http://localhost/pj_maobook/user-list.php", "_self");
        }
        // function checkDelete() {
        //     if (!confirm('確認刪除該筆訂單嗎 ? 已刪除內容資料庫將無法保存')) {
        //         return false;
        //     }
        // }

        function checkCancel() {
            if (!confirm('確認取消該筆訂單嗎 ?')) {
                return false;
            }
        }


        let showbtn = document.querySelector("#showBtn");
        let closebtn = document.querySelector("#closeBtn");
        var Box = document.querySelector('#showarea');
        showbtn.onclick = function () {
            Box.style.visibility = "visible";
        }
        closebtn.onclick = function () {
            Box.style.visibility = "hidden";
        }

    </script>

</body>
</html>
