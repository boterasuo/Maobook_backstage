<?php

require_once ("pdo-connect.php");

$id=$_POST["id"];
$name=$_POST['name'];
$price=$_POST["price"];
$description=$_POST["description"];
//$valid=$_POST["valid"];
$brand_category=$_POST["brand_category"];
$product_category=$_POST["product_category"];
$pet_category=$_POST["pet_category"];
$stock_num=$_POST["stock_num"];
$img=$_POST["img"];

//$sql="UPDATE products SET name='$name', price='$price',description='$description', brand_category='$brand_category', product_category='$product_category', pet_category='$pet_category', stock_num='$stock_num', img='$img' WHERE id='$id'";

$sql="UPDATE products SET name=?, price=?,description=?, brand_category=?, product_category=?, pet_category=?, stock_num=?, img=? WHERE id=?";

$stmt=$db_host->prepare($sql);

try{
    $stmt->execute([$name, $price, $description, $brand_category, $product_category, $pet_category, $stock_num, $img, $id]);
    header("location: product_manage.php");
}catch(PDOException $e){
    echo $e->getMessage();
}


//if ($db_host->exec($sql) === TRUE) {
//    echo "修改資料完成<br>";
//    header("location: product_manage.php");
//} else {
//    echo "修改資料失敗: " . $conn->error;
//}