<?php
//require_once ("domain-pdo-connect.php");
require_once("pdo-connect.php");
$id = $_GET["id"]; //user id
$sqlUser = "SELECT * FROM users WHERE id=?";
$stmtUser = $db_host->prepare($sqlUser);
try {
    $stmtUser->execute([$id]);
    $rowUser = $stmtUser->fetch();
} catch (PDOException $e) {
    echo $e->getMessage();
}

if (isset($_GET["start"])) {
    $start = $_GET["start"];
    $end = $_GET["end"];
//    $sqlOrderList="SELECT * FROM user_order WHERE user_id=? AND DATE(order_time)=? ORDER BY order_time DESC";
    $sqlOrderList = "SELECT * FROM user_order WHERE user_id=? AND DATE(order_time) BETWEEN ? AND ? ORDER BY order_time DESC";

    $stmtOrderList = $db_host->prepare($sqlOrderList);
    try {
        $stmtOrderList->execute([$id, $start, $end]);
        $rowOrderList = $stmtOrderList->fetchAll(PDO::FETCH_ASSOC);
        $orderCount = $stmtOrderList->rowCount();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
} else {
    $sqlOrderList = "SELECT * FROM user_order WHERE user_id=? ORDER BY order_time DESC";
    $stmtOrderList = $db_host->prepare($sqlOrderList);
    try {
        $stmtOrderList->execute([$id]);
        $rowOrderList = $stmtOrderList->fetchAll(PDO::FETCH_ASSOC);
        $orderCount = $stmtOrderList->rowCount();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}


//抓status的名稱
$sql="SELECT order_status.name,order_status.id, user_order.status, user_order.id FROM user_order JOIN order_status ON user_order.status = order_status.id
WHERE user_order.id = ?";
$stmtOrderStatus=$db_host->prepare($sql);
try{
    $stmtOrderStatus->execute([$id]);
    $statusRow=$stmtOrderStatus->fetch(PDO::FETCH_ASSOC);
//    $rowOrder=$stmtOrder->fetch();
}catch(PDOException $e){
    echo "取得訂單細節錯誤<br>";
    echo $e->getMessage();
}
?>
<!doctype html>
<html lang="en">
<head>
    <title><?= $rowUser["name"] ?> 訂單列表</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.0.2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <?php require_once("style.php") ?>

</head>
<div>
    <?php require_once("main-nav.php") ?>
    <div id="layoutSidenav_content">
        <div class="container px-0">
            <main class="main px-5">
                <div class="container-fluid px-0">
                    <h1 class="mt-4"><?= $rowUser["name"] ?> 的訂單列表</h1>
                    <ol class="breadcrumb my-4 ">
                        <li class="breadcrumb-item"><a href="home.php">首頁</a></li>
                        <li class="breadcrumb-item"><a href="order-list.php">所有訂單</a></li>
                        <li class="breadcrumb-item active"><?= $rowUser["name"] ?>的訂單列表</li>
                    </ol>
                </div>

                <?php if (isset($_GET["start"])): ?>
                    <div class="py-2">
                        <a role="button" class="btn btn-primary" href="user-order.php?id=<?= $id ?>">回列表</a>
                    </div>
                <?php endif; ?>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        <?= $rowUser["name"] ?> 的訂單列表
                    </div>
                    <div class="card-body">
                        <div class="py-2 d-flex justify-content-between">
                            <!--        <div>-->
                            <!--            共 --><? //=$orderCount?><!-- 筆-->
                            <!--        </div>-->
                            <form action="user-order.php" method="get">
                                <div class="d-flex align-items-center">
                                    <input type="hidden" name="id" value="<?= $id ?>">
                                    <!--                時間範圍-->
                                    <!--                <input type="date" class="form-control me-2" name="start"-->
                                    <!--                       value="-->
                                    <?php //if(isset($start))echo $start; ?><!--">-->
                                    <!--                <div class="me-2">~</div>-->
                                    <!--                <input type="date" class="form-control me-2" name="end"-->
                                    <!--                       value="--><?php //if(isset($end))echo $end; ?><!--">-->
                                    <!--                時間範圍end-->
                                    <!--                篩選-->
                                    <!--                <button type="submit" class="btn btn-primary text-nowrap">篩選</button>-->
                                    <!--                篩選end-->

                                </div>
                            </form>
                        </div>
                        <table id="datatablesSimple" class="table table-bordered table-sm">
                            <thead>
                            <tr>
                                <th>編號</th>
                                <th>訂購時間</th>
                                <th>狀態</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if ($orderCount > 0):
                                foreach ($rowOrderList as $value):
                                    ?>
                                    <tr>
                                        <td><a href="order-detail.php?id=<?= $value["id"] ?>"><?= $value["id"] ?></a>
                                        </td>
                                        <td><?=$value["order_time"] ?></td>
                                        <td><?=$statusRow["name"]?></td>
                                    </tr>
                                <?php
                                endforeach;
                            else: ?>
                                <tr>
                                    <td colspan="3">尚未有訂單</td>
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