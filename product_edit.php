<?php
if(isset($_GET["id"])){
    $id=$_GET["id"];
}else{
    $id=0;
}

require_once ("db-connect.php");

$sql="SELECT * FROM products WHERE id='$id'";
$result=$conn->query($sql);
$productExist=$result->num_rows;


require_once("style.php");
require_once("main-nav.php");


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
<body>

<div class="container">
    <div class="py-2 d-flex justify-content-end">
        <div>
            <a class="btn btn-primary" href="product_manage.php">回商品列表</a>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <?php if($productExist===0): ?>
                商品不存在
            <?php else:
                $row=$result->fetch_assoc();
                ?>

                <form action="product_doUpdate.php" method="post">
                    <input type="hidden" name="id" value="<?=$row["id"]?>">

                    <div class="mb-3">
                        <label for="name">商品編號</label>
                        <input id="id" type="text" name="id" class="form-control" value="<?=$row["id"]?>" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="name">商品名稱</label>
                        <input id="name" type="text" name="name" class="form-control" value="<?=$row["name"]?>">
                    </div>

                    <div class="mb-3">
                        <label for="price">價格</label>
                        <input id="price" type="text" name="price" class="form-control" value="<?=$row["price"]?>">
                    </div>

                    <div class="mb-3">
                        <label for="description">商品描述</label>
                        <input id="description" type="text" name="description" class="form-control" value="<?=$row["description"]?>">
                    </div>

<!--                    <div class="mb-3">-->
<!--                        <label for="valid">上架</label>-->
<!--                        <input id="valid" type="text" name="valid" class="form-control" value="--><?//=$row["valid"]?><!--">-->
<!--                    </div>-->
<!---->
<!--                    <div class="mb-3">-->
<!--                        <label for="brand_category">品牌分類</label>-->
<!--                        <input id="brand_category" type="text" name="brand_category" class="form-control" value="--><?//=$row["brand_category"]?><!--">-->
<!--                    </div>-->

                    <div class="mb-3">
                        <label for="brand_category">品牌分類</label>
                        <!--                    <input id="brand_category" type="text" name="brand_category" class="form-control" >-->
                        <select name="brand_category" id="brand_category" required>
                            <option value="1" <?php if($row["brand_category"] == '1') echo"selected"; ?>>Merrick 奇跡</option>
                            <option value="2" <?php if($row["brand_category"] == '2') echo"selected"; ?>>ZiwiPeak 巔峰</option>
                            <option value="3" <?php if($row["brand_category"] == '3') echo"selected"; ?>>Hills 希爾思</option>
                            <option value="4">Orijen 渴望</option>
                            <option value="5">NOW 鮮肉無穀</option>
                            <option value="6">Barf 巴夫</option>
                            <option value="7">Trilogy 奇境</option>
                            <option value="8">Instinct 原點</option>
                        </select>
                    </div>


<!--                    <div class="mb-3">-->
<!--                        <label for="product_category">產品分類</label>-->
<!--                        <input id="product_category" type="text" name="product_category" class="form-control" value="--><?//=$row["product_category"]?><!--">-->
<!--                    </div>-->

                    <div class="mb-3">
                        <label for="product_category">商品分類</label>
                        <!--                    <input id="product_category" type="text" name="product_category" class="form-control" >-->
                        <select name="product_category" id="product_category" required>
                            <optgroup label="狗 Dogs">
                                <option value="1" <?php if($row["product_category"] == '1') echo"selected"; ?>>狗乾糧</option>
                                <option value="2" <?php if($row["product_category"] == '2') echo"selected"; ?>>狗罐頭</option>
                                <option value="3" <?php if($row["product_category"] == '3') echo"selected"; ?>>狗零食</option>
                                <option value="4" <?php if($row["product_category"] == '4') echo"selected"; ?>>狗玩具</option>
                            </optgroup>
                            <optgroup label="貓 Cats">
                                <option value="5" <?php if($row["product_category"] == '5') echo"selected"; ?>>貓乾糧</option>
                                <option value="6" <?php if($row["product_category"] == '6') echo"selected"; ?>>貓罐頭</option>
                                <option value="7" <?php if($row["product_category"] == '7') echo"selected"; ?>>貓零食</option>
                                <option value="8" <?php if($row["product_category"] == '8') echo"selected"; ?>>貓玩具</option>
                            </optgroup>
                        </select>
                    </div>

<!--                    <div class="mb-3">-->
<!--                        <label for="pet_category">寵物分類</label>-->
<!--                        <input id="pet_category" type="text" name="pet_category" class="form-control" value="--><?//=$row["pet_category"]?><!--">-->
<!--                    </div>-->

                    <div class="mb-3">
                        <label for="pet_category">寵物分類</label>
                        <select name="pet_category" id="pet_category" required>
                            <!--                    <input id="pet_category" type="text" name="pet_category" class="form-control" >-->
                            <optgroup label="狗 Dogs">

                                <option value="1" <?php if($row["pet_category"] == '1') echo"selected"; ?>>幼犬</option>
                                <option value="2" <?php if($row["pet_category"] == '2') echo"selected"; ?>>成犬</option>
                                <option value="3" <?php if($row["pet_category"] == '3') echo"selected"; ?>>熟齡犬</option>
                                <option value="4" <?php if($row["pet_category"] == '4') echo"selected"; ?>>全年齡犬</option>
                            </optgroup>
                            <optgroup label="貓 Cats">
                                <option value="5" <?php if($row["pet_category"] == '5') echo"selected"; ?>>幼貓</option>
                                <option value="6" <?php if($row["pet_category"] == '6') echo"selected"; ?>>成貓</option>
                                <option value="7" <?php if($row["pet_category"] == '7') echo"selected"; ?>>熟齡貓</option>
                                <option value="8" <?php if($row["pet_category"] == '8') echo"selected"; ?>>全年齡貓</option>
                            </optgroup>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="stock_num">庫存</label>
                        <input id="stock_num" type="text" name="stock_num" class="form-control" value="<?=$row["stock_num"]?>">
                    </div>

                    <div class="mb-3">
                        <label for="img">商品圖片</label>
                        <input id="img" type="text" name="img" class="form-control" value="<?=$row["img"]?>">
                    </div>

                    <button class="btn btn-primary" type="submit">送出</button>
                </form>


            <?php endif; ?>
        </div>
    </div>
</div>
</body>
</html>