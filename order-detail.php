<?php
require_once ("../pdo-connect.php");
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

$sql="SELECT user_order_detail.amount, products.name, products.price, products.img FROM user_order_detail 
JOIN products ON user_order_detail.product_id = products.id
WHERE user_order_detail.order_id = ?";
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
<!doctype html>
<html lang="en">
<head>
    <title>Order Detail</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.0.2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"  integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<body>
<div class="container">
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

</body>
</html>