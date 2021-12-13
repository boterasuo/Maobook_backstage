<?php

require_once("style.php");
require_once("main-nav.php");

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


    <title>新增商品</title>

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
            <form action="product_doInsert.php" method="post">

                <div class="mb-3">
                    <label for="name">商品名稱</label>
                    <input id="name" type="text" name="name" class="form-control" required >
                </div>

                <div class="mb-3">
                    <label for="price">價格</label>
                    <input id="price" type="number" name="price" class="form-control" required >
                </div>

                <div class="mb-3">
                    <label for="description">描述</label><br>
                    <textarea style= "width:735px;height:100px;"
                    name="description" rows="6" cols="40" required></textarea>
<!--                    <input id="description" type="textfield3" name="description" class="form-control" >-->
                </div>

<!--                <div class="mb-3">-->
<!--                    <label for="valid">上架</label>-->
<!--                    <input id="valid" type="text" name="valid" class="form-control" >-->
<!--                </div>-->

                <div class="mb-3">
                    <label for="brand_category">品牌分類</label>
<!--                    <input id="brand_category" type="text" name="brand_category" class="form-control" >-->
                    <select name="brand_category" id="brand_category" required>
                        <option value="1">Merrick 奇跡</option>
                        <option value="2">ZiwiPeak 巔峰</option>
                        <option value="3">Hills 希爾思</option>
                        <option value="4">Orijen 渴望</option>
                        <option value="5">NOW 鮮肉無穀</option>
                        <option value="6">Barf 巴夫</option>
                        <option value="7">Trilogy 奇境</option>
                        <option value="8">Instinct 原點</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="product_category">商品分類</label>
<!--                    <input id="product_category" type="text" name="product_category" class="form-control" >-->
                    <select name="product_category" id="product_category" required>
                        <optgroup label="狗 Dogs">
                            <option value="1">狗乾糧</option>
                            <option value="2">狗罐頭</option>
                            <option value="3">狗零食</option>
                            <option value="4">狗玩具</option>
                        </optgroup>
                        <optgroup label="貓 Cats">
                        <option value="5">貓乾糧</option>
                        <option value="6">貓罐頭</option>
                        <option value="7">貓零食</option>
                        <option value="8">貓玩具</option>
                        </optgroup>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="pet_category">寵物分類</label>
                    <select name="pet_category" id="pet_category" required>
<!--                    <input id="pet_category" type="text" name="pet_category" class="form-control" >-->
                    <optgroup label="狗 Dogs">

                        <option value="1">幼犬</option>
                    <option value="2">成犬</option>
                    <option value="3">熟齡犬</option>
                    <option value="4">全年齡犬</option>
                    </optgroup>
                    <optgroup label="貓 Cats">
                    <option value="5">幼貓</option>
                    <option value="6">成貓</option>
                    <option value="7">熟齡貓</option>
                    <option value="8">全年齡貓</option>
                    </optgroup>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="stock_num">庫存數量</label>
                    <input id="stock_num" type="number" name="stock_num" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="img">圖片路徑</label>
                    <input id="img" type="text" name="img" class="form-control"required>
                </div>

                <button class="btn btn-primary" type="submit">送出</button>
            </form>

        </div>
    </div>
</div>
</body>
</html>