<?php
require_once("pdo-connect.php");
//$id = $_GET["id"]; //order id

//status 抓取
$sqlStatusType = "SELECT * FROM order_status";
$stmtStatusType = $db_host->prepare($sqlStatusType);
try {
    $stmtStatusType->execute();
    $statusTypeRows = $stmtStatusType->fetchAll(PDO::FETCH_ASSOC);
    $statusTypes = array_column($statusTypeRows, "name", "id");
} catch (PDOException $e) {
    echo "預處理陳述式執行失敗！ <br/>";
    echo "Error: " . $e->getMessage() . "<br/>";
    $db_host = NULL;
    exit;
}

// 抓取 users 會員資料表
//$id = $_GET["id"]; //user id
$sqlUser = "SELECT * FROM users ";
$stmtUser = $db_host->prepare($sqlUser);
try {
    $stmtUser->execute();
    $rowUser = $stmtUser->fetch();//會員資料
} catch (PDOException $e) {
    echo $e->getMessage();
}

//抓取 user_order
$sqlOrderList = "SELECT * FROM user_order ";
$stmtOrderList = $db_host->prepare($sqlOrderList);
try {
    $stmtOrderList->execute();
    $rowOrderLists = $stmtOrderList->fetchAll(PDO::FETCH_ASSOC);
//    $rowOrderList = $stmtOrderList->fetch(PDO::FETCH_ASSOC);
    $orderCount = $stmtOrderList->rowCount();

} catch (PDOException $e) {
    echo $e->getMessage();
}

//選擇訂單總金額、產品名稱、產品價格、產品圖片從[order-detail]加入到[products]參考ON在order_detail.product_id = products.id
//$sql = "SELECT order_detail.amount, products.name, products.price, products.img FROM order_detail
//JOIN products ON order_detail.product_id = products.id
//WHERE order_detail.order_id = ?";
//$stmt = $db_host->prepare($sql);
//try {
//    $stmt->execute();
//    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
////    $rowOrder=$stmtOrder->fetch();
//} catch (PDOException $e) {
//    echo "取得訂單細節錯誤<br>";
//    echo $e->getMessage();
//}

//抓status的名稱
//$sql = "SELECT order_status.name,order_status.id, user_order.status, user_order.id FROM user_order JOIN order_status ON user_order.status = order_status.id
//WHERE user_order.id = ?";
//$stmtOrderStatus = $db_host->prepare($sql);
//try {
//    $stmtOrderStatus->execute();
//    $statusRow = $stmtOrderStatus->fetch(PDO::FETCH_ASSOC);
//    $statusRows = $stmtOrderStatus->fetchAll(PDO::FETCH_ASSOC);
////    $rowOrder=$stmtOrder->fetch();
//} catch (PDOException $e) {
//    echo "取得訂單細節錯誤<br>";
//    echo $e->getMessage();
//}

//抓user_id的名稱
$sql = "SELECT  user_order.user_id, user_order.id, users.name FROM  users JOIN user_order ON user_order.user_id = users.id";
$stmtOrderUser = $db_host->prepare($sql);
try {
    $stmtOrderUser->execute();
    $orderUserRows = $stmtOrderUser->fetchAll(PDO::FETCH_ASSOC);
//    $orderUserRow = $stmtOrderUser->fetch(PDO::FETCH_ASSOC);
    $orderName = array_column($orderUserRows, "name", "user_id");

} catch (PDOException $e) {
    echo "取得訂單細節錯誤<br>";
    echo $e->getMessage();
}

//var_dump($orderUserRows[$rowOrderList]);
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

    <title>訂單查詢</title>

    <?php require_once("style.php"); ?>
    <!-- 此處新增css檔 -->
    <link rel="stylesheet" href="css/anun-style.css">
    <!-- Css檔 end   -->

</head>
<body class="sb-nav-fixed">
<?php require_once("main-nav.php"); ?>
<!-- 主要內容 -->
<div id="layoutSidenav_content">
    <div class="container px-0">
        <main class="main px-5">
            <div class="container-fluid px-0 ">
                <h1 class="mt-4 ">訂單查詢</h1>
                <ol class="breadcrumb my-4 ">
                    <li class="breadcrumb-item"><a href="home.php">首頁</a></li>
                    <li class="breadcrumb-item active">訂單查詢</li>
                </ol>
            </div>

            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between" title="新增訂單">
                    <a><i class="fas fa-table me-1 end-0"></i>
                        訂單列表</a>
                    <a href="order-add.php"><i class="fas fa-plus me-1 end-0"></i>
                        新增訂單&nbsp;&nbsp;</a>
                </div>
                <div class="card-body">
                    <div class="py-2 d-flex justify-content-between">

                    </div>
                    <table id="datatablesSimple" class="table table-bordered table-sm">
                        <thead>
                        <tr>
                            <th width="10%">訂單編號</th>
                            <th width="30%">訂購時間</th>
                            <th width="20%">訂購人</th>
                            <th width="20%">訂單狀態</th>
                            <th width="20%">訂單操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if ($orderCount > 0):
                            foreach ($rowOrderLists as $value):
                                $value["id"] = sprintf("%02d", $value["id"]);
                                ?>
                                <tr>
                                    <td>
                                        <a href='order-detail.php?id=<?= $value["id"] ?>' title='訂單編號: <?= $value["id"] ?>'><b>#<?= $value["id"] ?></b></a>
                                    </td>
                                    <td><?= $value["order_time"] ?></td>
                                    <td title='查看<?= $orderName[$value["user_id"]] ?>(ID:<?= $value["user_id"] ?>)的所有訂單'>
                                        <a href="user-order.php?id=<?= $value["user_id"] ?>">@<?= $orderName[$value["user_id"]] ?></a>
                                    </td>
                                    <td title='訂單狀態:  <?= $value["status"] ?> '>
                                        <a class=""><?= $statusTypes[$value["status"]] ?></a>
                                    </td>
                                    <td>
                                        <a class="btn btn-mao-primary" href='order-detail.php?id=<?= $value["id"] ?>' title="檢視訂單明細">
                                            <i class="fas fa-info-circle"></i></a>
                                        <a class="btn btn-mao-primary" href='order-edit.php?id=<?= $value["id"] ?>' title="編輯該筆訂單">
                                            <i class="fas fa-edit"></i></a>
                                    </td>
                                </tr>
                            <?php
                            endforeach;
                        else: ?>
                            <tr>
                                <td colspan="12">尚未有訂單</td>
                            </tr>

                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
    </div>

    <?php require_once("JS.php") ?>
</div>
</div>
</body>
</html>
