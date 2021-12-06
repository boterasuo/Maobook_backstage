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
    $sqlOrderList="SELECT * FROM user_order WHERE user_id=? AND DATE(order_time) BETWEEN ? AND ? ORDER BY order_time DESC";

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
    <title><?=$rowUser["name"]?> 訂單列表</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.0.2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"  integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<body>
<div class="container">
    <h1><?=$rowUser["name"]?> 的訂單列表</h1>
    <?php if(isset($_GET["start"])): ?>
        <div class="py-2">
            <a role="button" class="btn btn-primary" href="user-order.php?id=<?=$id?>">回列表</a>
        </div>
    <?php endif; ?>
    <div class="py-2 d-flex justify-content-between">
        <div>
            共 <?=$orderCount?> 筆
        </div>
        <form action="user-order.php" method="get">
            <div class="d-flex align-items-center">
                <input type="hidden" name="id" value="<?=$id?>">
                <input type="date" class="form-control me-2" name="start"
                       value="<?php if(isset($start))echo $start; ?>"
                >
                <div class="me-2">~</div>
                <input type="date" class="form-control me-2" name="end"
                       value="<?php if(isset($end))echo $end; ?>">
                <button type="submit" class="btn btn-primary text-nowrap">篩選</button>
            </div>
        </form>
    </div>
    <table class="table table-bordered table-sm">
        <thead>
        <tr>
            <th>編號</th>
            <th>訂購時間</th>
            <th>狀態</th>
        </tr>
        </thead>
        <tbody>
        <?php if($orderCount>0):
            foreach ($rowOrderList as $value):
                ?>
                <tr>
                    <td><a href="order-detail.php?id=<?=$value["id"]?>"><?=$value["id"]?></a></td>
                    <td><?=$value["order_time"]?></td>
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
</div>
</body>
</html>