<?php
require_once ("../db-connect.php");
if(isset($_GET["id"])){
    $id=$_GET["id"];
}else{
    $id=0;
}

$sqlCategory="SELECT * FROM category";
$resultCategory=$conn->query($sqlCategory);
//["1"=> "marvel", "2"=>"DC Comics"];
$categoryArr=[];
while($row=$resultCategory->fetch_assoc()){
    $categoryArr[$row["id"]]=$row["name"];
}


$sql="SELECT * FROM products WHERE id='$id' AND valid=1";
//join
//$sql="SELECT products.*, category.name AS category_name FROM products
//JOIN category ON products.category_id = category.id
//WHERE products.id='$id' AND products.valid=1";

$result=$conn->query($sql);
$userExist=$result->num_rows;
$row=$result->fetch_assoc();
?>
<!doctype html>
<html lang="en">
<head>
    <title><?=$row["name"]?></title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php require_once("css.php") ?>
</head>
<body>
<?php require_once ("header.php"); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="py-2">
                <!-- 利用 join -->
                <!--                    <span class="badge bg-info">--><?//=$row["category_name"]?><!--</span>-->
                <span class="badge bg-info"><?=$categoryArr[$row["category_id"]]?></span>
            </div>
            <h1><?=$row["name"]?></h1>
            <figure>
                <img class="img-fluid" src="images/<?=$row["img"]?>" alt="<?=$row["name"]?>">
            </figure>
            <div>$ <?=$row["price"]?></div>
        </div>
    </div>
</div>
</body>
</html>