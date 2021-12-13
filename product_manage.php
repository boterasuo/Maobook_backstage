<?php

require_once ("pdo-connect.php");

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

    <title>商品資料管理</title>

    <?php
    require_once("style.php");
    require_once("main-nav.php");
    ?>

</head>

<style>

    table {
        table-layout: fixed;
        word-wrap:break-word;
        text-align:center
    }
    #th-id{
        width: 4%;
    }
    #th-name{
        width: 9%;
    }
    #th-description{
        width: 35%;
    }
    #th-price{
        width: 4.5%;
    }
    #th-stock{
        width: 3.5%;
    }
    #th-product, #th-pet, #th-brand{
        width: 4%;
    }
    #th-time{
        width: 5%;
    }
    #th-img{
        width:22%;
    }

</style>

<body>

<div class="container">
    <div class="container px-0">
        <main class="main px-5">
            <div class="container-fluid px-0 ">
    <h1 class="mt-4">商品資料管理</h1>
                <ol class="breadcrumb my-4 ">
                    <li class="breadcrumb-item"><a href="home.php">首頁</a></li>
                    <li class="breadcrumb-item active">商品資料管理</li>
                </ol>

    <p class="text">目前共<?php echo $productCount;?>筆資料　<a class="btn btn-primary" role="button" href="product_add.php">新增商品資料</a></p>
    </div>
    </div>


    <table class="table table-bordered table-sm">
        <thead class="table-light">
        <tr>
            <th id="th-id">商品編號</th>
            <th id="th-name">商品名稱</th>
            <th id="th-price">價格</th>
            <th id="th-description">描述</th>
<!--            <th>是否上架</th>-->
            <th id="th-brand">品牌分類</th>
            <th id="th-product">產品分類</th>
            <th id="th-pet">寵物分類</th>
            <th id="th-stock">庫存</th>
            <th id="th-img">圖片</th>
            <th id="th-time">建立時間</th>
            <th id="th-function">功能</th>
        </tr>
        </thead>

        <tbody>

        <?php
        while($row_result=$stmt->fetch(PDO::FETCH_ASSOC)){

            echo "<tr>";
            echo "<td>".$row_result["id"]."</td>";
            echo "<td>".$row_result["name"]."</td>";
            echo "<td>".$row_result["price"]."</td>";
            echo "<td align='left'>".$row_result["description"]."</td>";


            echo "<td align='left'>".$Brand_categoryArr[$row_result["brand_category"]]."</td>";
            echo "<td align='left'>".$Product_categoryArr[$row_result["product_category"]]."</td>";
            echo "<td align='left'>".$Pet_categoryArr[$row_result["pet_category"]]."</td>";


            echo "<td>".$row_result["stock_num"]."</td>";
//            echo "<td>".$row_result["img"]."</td>";

            echo $row_result["img"]==''?'<td>商品圖片</td>':'<td><img src="./images/product_images/'.$row_result["img"].'" class="img-responsive" width="250px" height="250px"></td>';

            echo "<td>".$row_result["created_at"]."</td>";

            echo "<td><a class='btn btn-primary' href='product_edit.php?id=".$row_result["id"]."'>修改</a>";
            echo "　<br>　";
            echo "<a class='btn btn-primary' href='product_doDelete.php?id=".$row_result["id"]."'>刪除</a> </td>";
//            echo "<a href='product_doDelete.php?id=".$row_result["id"]."'>上傳/修改圖片</a> </td>";
            echo "</td>";

        }
        ?>

        </tbody>
        </table>
</div>


<!-- Bootstrap JavaScript Libraries -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</body>
</html>