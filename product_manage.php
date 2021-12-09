<?php

$servername = "localhost";
$username = "admin";
$password = "12345";
$dbname = "my_db";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("連線失敗: " . $conn->connect_error);
} else {
    //echo "資料庫連線成功";
}

require_once("style.php");
require_once("main-nav.php");


$sqlBrand_Category="SELECT * FROM brand_category";
$resultBrand_Category=$conn->query($sqlBrand_Category);
$Brand_categoryArr=[];
while($row=$resultBrand_Category->fetch_assoc()){
    $Brand_categoryArr[$row["id"]]=$row["name"];
}

$sqlProduct_Category="SELECT * FROM product_category";
$resultProduct_Category=$conn->query($sqlProduct_Category);
$Product_categoryArr=[];
while($row=$resultProduct_Category->fetch_assoc()){
    $Product_categoryArr[$row["id"]]=$row["name"];
}

$sqlPet_Category="SELECT * FROM pet_category";
$resultPet_Category=$conn->query($sqlPet_Category);
$Pet_categoryArr=[];
while($row=$resultPet_Category->fetch_assoc()){
    $Pet_categoryArr[$row["id"]]=$row["name"];
}


$sql_query="SELECT * From products WHERE valid=1";
$result=$conn->query($sql_query);

$totalProductCount=$result->num_rows;
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
</style>
<body>

<div class="container">
    <div class="row align-items-center">
    <h1 class="text-center">商品資料管理</h1>
    <p class="text-center">目前共<?php echo $totalProductCount;?>筆資料　<a class="btn btn-primary" role="button" href="product_add.php">新增商品資料</a></p>
    </div>

    <table class="table table-bordered table-sm">
        <thead class="table-light">
        <tr>
            <th>商品編號</th>
            <th>商品名稱</th>
            <th>價格</th>
            <th>描述</th>
<!--            <th>是否上架</th>-->
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
        while($row_result=$result->fetch_assoc()){

            echo "<tr>";
            echo "<td>".$row_result["id"]."</td>";
            echo "<td>".$row_result["name"]."</td>";
            echo "<td>".$row_result["price"]."</td>";
            echo "<td>".$row_result["description"]."</td>";


            echo "<td>".$Brand_categoryArr[$row_result["brand_category"]]."</td>";
            echo "<td>".$Product_categoryArr[$row_result["product_category"]]."</td>";
            echo "<td>".$Pet_categoryArr[$row_result["pet_category"]]."</td>";

            echo "<td>".$row_result["stock_num"]."</td>";
//            echo "<td>".$row_result["img"]."</td>";

            echo $row_result["img"]==''?'<td>商品圖片</td>':'<td><img src="./product_images/'.$row_result["img"].'" class="img-responsive" width="250px" height="250px"></td>';

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