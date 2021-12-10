<?php
require_once ("pdo-connect.php");
$id=$_GET["id"]; //order id
$sqlOrder="SELECT * FROM user_order WHERE id=?";//從訂單抓資料
$stmtOrder=$db_host->prepare($sqlOrder);
try{
    $stmtOrder->execute([$id]);
    $rowOrder=$stmtOrder->fetch(); //訂單資料

}catch(PDOException $e){
    echo "取得訂單資訊錯誤<br>";
    echo $e->getMessage();
}
// 抓取 users 會員資料表
$id=$_GET["id"]; //user id
$sqlUser="SELECT * FROM users WHERE id=?";
$stmtUser=$db_host->prepare($sqlUser);
try{
    $stmtUser->execute([$id]);
    $rowUser=$stmtUser->fetch();//會員資料
}catch(PDOException $e){
    echo $e->getMessage();
}

//抓取 user_order
$sqlOrderList="SELECT * FROM user_order WHERE user_id=?";
$stmtOrderList=$db_host->prepare($sqlOrderList);
try{
    $stmtOrderList->execute([$id]);
    $rowOrderList=$stmtOrderList->fetchAll(PDO::FETCH_ASSOC);
    $orderCount=$stmtOrderList->rowCount();
}catch(PDOException $e){
    echo $e->getMessage();
}

//選擇訂單總金額、產品名稱、產品價格、產品圖片從[order-detail]加入到[products]參考ON在order_detail.product_id = products.id
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

//抓user_id的名稱
$sql="SELECT  user_order.user_id, user_order.id, users.name FROM user_order JOIN users ON user_order.user_id = users.id
WHERE user_order.id = ?";
$stmtOrderUser=$db_host->prepare($sql);
try{
    $stmtOrderUser->execute([$id]);
    $orderUserRow=$stmtOrderUser->fetch(PDO::FETCH_ASSOC);
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

    <title>訂單編號：<?=$rowUser["id"]?></title>

    <?php require_once("style.php"); ?>

</head>
<body class="sb-nav-fixed">
<?php require_once("main-nav.php"); ?>
<!-- 主要內容 -->
<div id="layoutSidenav_content">
    <div class="container px-0">
        <main class="main px-5">
            <div class="container-fluid px-0">
                <ol class="breadcrumb mb-2 mt-4">
                    <li class="breadcrumb-item"><a href="home.php">首頁</a></li>
                    <li class="breadcrumb-item active"><a href="order-list.php">訂單管理</a></li>
                    <li class="breadcrumb-item active">訂單管理</li>
                </ol>
                <h3 class="mb-4">訂單編號：#<?=$id?></h3>

            </div>
<!--            <div class="py-2">-->
<!--                <a role="button" class="btn btn-primary" href="user-order.php?id=--><?//=$rowOrder["user_id"]?><!--">回訂單列表</a>-->
<!--            </div>-->
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between"" title="新增訂單">
                <a ><i class="fas fa-table me-1 end-0"></i>
                    資料表格</a>
                <a href="order-edit.php"><i class="fas fa-edit me-1 end-0"></i>
                    修改訂單&nbsp;&nbsp;</a>
                </div>
    <div class="card-body">
            <!--    本頁 內容    -->
            <div class="py-2">
                訂單編號: <?=$id?><br>
                訂購人: <a href="user-order.php?id=<?=$rowOrder["user_id"]?>" title="查看【<?=$orderUserRow["name"]?>】的所有訂單"><?=$orderUserRow["name"]?></a><br>
                訂單時間: <?=$rowOrder["order_time"]?><br>
                狀態: <?=$statusRow["name"]?><br>
            </div>
            <div>
                <table  class="table table-bordered table-sm"><!-- id="datatablesSimple" -->
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
                    $total=0;
                    foreach($rows as $value): ?>
                        <tr>
                            <td><a href="cart-product-detial.php?name=<?=$value["name"]?>" title="<?=$value["name"]?>"><img src="images/product_images/<?=$value["img"]?>" alt="" width="100px" ></a></td><!-- 商品圖片 -->
                            <td><?=$value["name"]?></td> <!-- 訂購人名稱 -->

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
                        <td class="text-end" colspan="12">總計: <?=$total?></td>
                    </tr>
                    </tfoot>
                </table>
            </div>
    </div>
    </div>
    </div>
    <!--   本頁內容 end  -->


    </main><!-- 主要內容end -->
    <!--    --><?php //require_once("footer.php"); ?>
</div>
<?php require_once("JS.php"); ?>

</body>
</html>
