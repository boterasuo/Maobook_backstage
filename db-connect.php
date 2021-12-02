<!--PHP-->
<?php
$servername="localhost"; //主機
$username="admin"; //使用者
$password="12345"; //密碼
$dbname="my_db"; //選擇資料庫

$conn=new MySQLi($servername,$username,$password,$dbname);
//$cnn 資料庫連結物件


if($conn->connect_error){
    die("連線失敗:　".$conn->connect_error);
}else{
//    echo "資料庫連線成功！<br>";
}

