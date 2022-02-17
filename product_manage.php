<?php

require_once ("pdo-connect.php");
require_once("style.php");
require_once("main-nav.php");


$sql_Brand="SELECT * FROM brand_category";
$stmt_Brand=$db_host->prepare($sql_Brand);
$stmt_Brand->execute();
$Brand_categoryArr=[];
while ($row_Brand=$stmt_Brand->fetch()){
    $Brand_categoryArr[$row_Brand["id"]]=$row_Brand["name"];
}

$sql_Product="SELECT * FROM product_category";
$stmt_Product=$db_host->prepare($sql_Product);
$stmt_Product->execute();
$Product_categoryArr=[];
while ($row_Product=$stmt_Product->fetch()){
    $Product_categoryArr[$row_Product["id"]]=$row_Product["name"];
}

$sql_Pet="SELECT * FROM pet_category";
$stmt_Pet=$db_host->prepare($sql_Pet);
$stmt_Pet->execute();
$Pet_categoryArr=[];
while ($row_Pet=$stmt_Pet->fetch()){
    $Pet_categoryArr[$row_Pet["id"]]=$row_Pet["name"];
}

$sql= "SELECT * From products WHERE valid=1";
$stmt=$db_host->prepare($sql);
try{
$stmt->execute();
$result=$stmt->fetch(PDO::FETCH_ASSOC);
$productCount=$stmt->rowCount();
}catch (PDOException $e){
    echo $e->getMessage();
}


?>

<!doctype html>
<html lang="en">
<head>
    <title>Product Edit</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.0.2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"  integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<style>
    .product-list{
        width: auto;
    }
    .product-list th{
        width: 20px;
    }
</style>
<body>

<div class="container">
    <div class="row align-items-center">
        <h1 class="text-center">商品資料管理</h1>
        <div class="text-center">目前共<?=$productCount;?>筆資料 
        <a class="btn btn-primary" role="button" href="product_add.php">新增商品資料</a></div>
    </div>
        <table class="product-list table table-bordered table-sm">
            <thead class="table-light">
            <tr>
                <th>商品編號</th>
                <th>商品名稱</th>
                <th>價格</th>
                <th>描述</th>
                <th>品牌分類</th>
                <th>產品分類</th>
                <th>寵物分類</th>
                <th>庫存</th>
                <th>圖片</th>
                <th>建立時間</th>
                <th>功能</th>
            </tr>
            </thead>

            <tbody>

            <?php
            while($row_result=$stmt->fetch(PDO::FETCH_ASSOC)): ?>

            <tr>
                <td><?=$row_result["id"]?></td>
                <td><?=$row_result["name"]?></td>
                <td><?=$row_result["price"]?></td>
                <td><?=$row_result["description"]?></td>


                <td><?=$Brand_categoryArr[$row_result["brand_category"]]?></td>
                <td><?=$Product_categoryArr[$row_result["product_category"]]?></td>
                <td><?=$Pet_categoryArr[$row_result["pet_category"]]?></td>


                <td><?=$row_result["stock_num"]?></td>

                <td><img src="./images/product_images/<?=$row_result["img"]?>" class="img-responsive" width="250px" height="250px"></td>';

                <td><?=$row_result["created_at"]?></td>

                <td>
                    <a class='btn btn-primary' href='product_edit.php?id=<?=$row_result["id"]?>'>修改</a>
                    <a class='btn btn-primary' href='product_doDelete.php?id=<?=$row_result["id"]?>'>刪除</a> 
                </td>
            </tr>
            <?php endwhile; ?>

            </tbody>
            </table>

    
</div>


<!-- Bootstrap JavaScript Libraries -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</body>
</html>