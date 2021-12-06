<?php

$servername="50.87.143.200"; //主機
$username="simauflo"; //使用者
$password="MFee22::Team04"; //密碼
$dbname="simauflo_my_db"; //選擇資料庫

try{
    $db_host= new PDO(
        "mysql:host={$servername};dbname={$dbname};charset=utf8",
        $username, $password
    );
//    echo "資料庫連線成功";

}catch(PDOException $e){
    echo "資料庫連線失敗";
    echo "error: ".$e->getMessage();
}


//IP查詢
//https://cpanel.net/showip.shtml
