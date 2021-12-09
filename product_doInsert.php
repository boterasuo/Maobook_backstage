<?php

require_once ("db-connect.php");

$name=$_POST["name"];
$price=$_POST["price"];
$description=$_POST["description"];
//$valid=$_POST["valid"];
$brand_category=$_POST["brand_category"];
$product_category=$_POST["product_category"];
$pet_category=$_POST["pet_category"];
$stock_num=$_POST["stock_num"];
$now=date("Y-m-d H:i:s");
$img=$_POST["img"];

//        $sql = "INSERT INTO products (name, price, description, valid, brand_category, product_category, pet_category, stock_num, created_at) VALUES ('$name', '$price', '$description', '$valid', '$brand_category', '$product_category', '$pet_category', '$stock_num', '$now')";

$sql = "INSERT INTO products (name, price, description, brand_category, product_category, pet_category, stock_num, img, created_at) VALUES ('$name', '$price', '$description', '$brand_category', '$product_category', '$pet_category', '$stock_num', '$img', '$now')";

if ($conn->query($sql) === TRUE) {
    echo "新增資料完成<br>";
    header("location: product_manage.php");
} else {
    echo "新增資料錯誤: " . $conn->error;
}
