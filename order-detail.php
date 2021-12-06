<?php
require_once ("domain-pdo-connect.php"); //連線到遠端資料庫 domain-pdo-connect.php;
$id=$_GET["id"]; //order id
$sqlOrder="SELECT * FROM user_order WHERE id=?";
$stmtOrder=$db_host->prepare($sqlOrder);


try{
    $stmtOrder->execute([$id]);
    $rowOrder=$stmtOrder->fetch();
}catch(PDOException $e){
    echo "取得訂單資訊錯誤<br>";
    echo $e->getMessage();
}
// 抓取 users
$id=$_GET["id"]; //user id
$sqlUser="SELECT * FROM users WHERE id=?";
$stmtUser=$db_host->prepare($sqlUser);
try{
    $stmtUser->execute([$id]);
    $rowUser=$stmtUser->fetch();
}catch(PDOException $e){
    echo $e->getMessage();
}
//抓取 user_oder裡的名字
$sqlOrderList="SELECT * FROM user_order WHERE user_id=?";
$stmtOrderList=$db_host->prepare($sqlOrderList);
try{
    $stmtOrderList->execute([$id]);
    $rowOrderList=$stmtOrderList->fetchAll(PDO::FETCH_ASSOC);
    $orderCount=$stmtOrderList->rowCount();
}catch(PDOException $e){
    echo $e->getMessage();
}

$sql="SELECT order_detail.amount, products.name, products.price, products.img FROM order_detail 
JOIN products ON order_detail.product_id = products.id
WHERE order_detail.order_id = ?";
$stmt=$db_host->prepare($sql);
try{
    $stmt->execute([$id]);
    $rows=$stmt->fetchAll(PDO::FETCH_ASSOC);

//    $rowOrder=$stmtOrder->fetch();
}catch(PDOException $e){
    echo "取得訂單細節錯誤<br>";
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

    <?php require_once("style.php"); ?>

</head>
<body class="sb-nav-fixed">
<?php require_once("main-nav.php"); ?>
<!-- 主要內容 -->
<div id="layoutSidenav_content">
    <div class="container px-0">
        <main class="main px-5">
            <div class="container-fluid px-4">
                <h1 class="mt-4"><?=$rowUser["name"]?>的購物車</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="home.php">首頁</a></li>
                    <li class="breadcrumb-item active">所有購物清單</li>
                </ol>
            </div>

            <!--    本頁 內容    -->
            <div class="py-2">
                <a role="button" class="btn btn-primary" href="user-order.php?id=<?=$rowOrder["user_id"]?>">回訂單列表</a>
            </div>

            <div class="py-2">
                訂單編號: <?=$id?><br>訂單時間: <?=$rowOrder["order_time"]?><br>狀態: <?=$rowOrder["status"]?>
            </div>
            <div>
                <table class="table table-bordered table-sm">
                    <thead>
                    <tr>
                        <th>產品名稱</th>
                        <th>單價</th>
                        <th>數量</th>
                        <th>小計</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $total=0;
                    foreach($rows as $value): ?>
                        <tr>
                            <td><?=$value["name"]?></td>
                            <td class="text-end"><?=$value["price"]?></td>
                            <td class="text-end"><?=$value["amount"]?></td>
                            <td class="text-end"><?php
                                $subtotal=$value["amount"]*$value["price"];
                                echo $subtotal;
                                //                            $total=$total+$subtotal;
                                $total+=$subtotal;

                                ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <td class="text-end" colspan="4">總計: <?=$total?></td>
                    </tr>
                    </tfoot>
                </table>
            </div>
    </div>

    <!--   本頁內容 end  -->


    </main><!-- 主要內容end -->

    <!--    --><?php //require_once("footer.php"); ?>

</div>
<?php require_once("JS.php"); ?>
</body>
</html>
