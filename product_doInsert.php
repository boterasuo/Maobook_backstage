<?php
$servername="localhost";
$username="admin";
$password="12345";
$dbname="my_db";
$conn=new mysqli($servername, $username, $password, $dbname);
if($conn->connect_error){
    die("連線失敗: ".$conn->connect_error);
}else{
   //echo "資料庫連線成功";
}

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
