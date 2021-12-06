<?php
require_once ("domain-pdo-connect.php");
$id=$_GET["id"]; //user id
$sqlUser="SELECT * FROM users WHERE id=?";
$stmtUser=$db_host->prepare($sqlUser);
try{
    $stmtUser->execute([$id]);
    $rowUser=$stmtUser->fetch();
}catch(PDOException $e){
    echo $e->getMessage();
}

if(isset($_GET["start"])){
    $start=$_GET["start"];
    $end=$_GET["end"];
//    $sqlOrderList="SELECT * FROM user_order WHERE user_id=? AND DATE(order_time)=? ORDER BY order_time DESC";
    $sqlOrderList="SELECT * FROM user_order WHERE  DATE(order_time) BETWEEN ? AND ? ORDER BY order_time DESC";

    $stmtOrderList=$db_host->prepare($sqlOrderList);
    try{
        $stmtOrderList->execute([$id, $start, $end]);
        $rowOrderList=$stmtOrderList->fetchAll(PDO::FETCH_ASSOC);
        $orderCount=$stmtOrderList->rowCount();
    }catch(PDOException $e){
        echo $e->getMessage();
    }
}else{
    $sqlOrderList="SELECT * FROM user_order WHERE user_id=? ORDER BY order_time DESC";
    $stmtOrderList=$db_host->prepare($sqlOrderList);
    try{
        $stmtOrderList->execute([$id]);
        $rowOrderList=$stmtOrderList->fetchAll(PDO::FETCH_ASSOC);
        $orderCount=$stmtOrderList->rowCount();
    }catch(PDOException $e){
        echo $e->getMessage();
    }
}



?>
<!doctype html>
<html lang="en">
<head>
    <title>訂單列表</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="Description" content="MaoBook小組專題報告"/>
    <meta name="Content-Language" content="zh-TW">
    <meta name="author" content="Team MaoBook"/>
    <!--  網站圖示  -->
    <link rel="apple-touch-icon" type="image/png" href="images/logo-nbg.png"/>
    <link rel="shortcut icon" type="image/png" href="images/logo-nbg.png"/>
    <link rel="mask-icon" type="image/png" href="images/logo-nbg.png"/>
    <?php require_once("style.php"); ?>


</head>
<body class="sb-nav-fixed">
<?php require_once("main-nav.php"); ?>
<!-- 主要內容 -->
<div id="layoutSidenav_content">
    <div class="container px-0">
        <main class="main px-5">
            <div class="container-fluid px-4">
                <h1 class="mt-4">所有訂單</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="home.php">首頁</a></li>
                    <li class="breadcrumb-item active">所有訂單</li>
                </ol>
            </div>

    <?php if(isset($_GET["start"])): ?>
        <div class="py-2">
            <a role="button" class="btn btn-mao-primary" href="user-order.php?id=<?=$id?>">回列表</a>
        </div>
    <?php endif; ?>
    <div class="py-2 d-flex justify-content-between">

        <form action="user-order.php" method="get">
            <div class="d-flex align-items-center">
                <input type="hidden" name="id" value="<?=$id?>">
                <input type="date" class="form-control me-2" name="start"
                       value="<?php if(isset($start))echo $start; ?>"
                >
                <div class="me-2">~</div>
                <input type="date" class="form-control me-2" name="end"
                       value="<?php if(isset($end))echo $end; ?>">
                <button type="submit" class="btn btn-mao-primary text-nowrap">篩選</button>
            </div>
<!--     TABLE       -->
        </form>
    </div>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    資料表格
                </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <!-- 標題欄 -->
                    <thead>
                    <tr>
                        <!-- 表格註腳 thead -->
                        <th><input type="checkbox"> 全選</th>
                        <th>訂單編號</th>
                        <th>訂單日期</th>
                        <th>客戶姓名</th>
                        <th>付款狀態</th>
                        <th>出貨狀態</th>
                        <th>總金額</th>
                    </tr>
                    </thead>
                    <!-- 總結資訊 tfoot -->
                    <tfoot>
                    <tr>
                        <th><input type="checkbox">全選</th>
                        <th>訂單編號</th>
                        <th>訂單日期</th>
                        <th>客戶姓名</th>
                        <th>付款狀態</th>
                        <th>出貨狀態</th>
                        <th>總金額</th>
                    </tr>
                    </tfoot>
                    <!-- 資料欄 tbody -->
                    <tbody>

                    <?php if($orderCount>0):
                        foreach ($rowOrderList as $value):
                            ?>
                            <tr>
                                <td><input type="checkbox"></td>
                                <td><a href="order-detail.php?id=<?=$value["id"]?>"><?=$value["id"]?></a></td>
                                <td><?=$value["order_time"]?></td>
                                <td><?=$rowUser["name"]?></td>
                                <td><?=$value["status"]?></td>
                                <td><?=$value["status"]?></td>
                                <td><?=$value["status"]?></td>
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
            </div><!-- 表格區塊 end -->
    </div></div>
<?php require_once("JS.php") ?>
</body>
</html>