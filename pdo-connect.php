<?php
$servername="localhost";
$username="admin";
$password="12345";
//$dbname="my_db";
$dbname="team4_db";

try{
    $db_host= new PDO(
        "mysql:host={$servername};dbname={$dbname};charset=utf8",
        $username, $password);
//    echo "資料庫連線成功";

}catch(PDOException $e){
    echo "資料庫連線失敗";
    echo "error: ".$e->getMessage();
}

//$conn=new mysqli($servername, $username, $password, $dbname);
?>