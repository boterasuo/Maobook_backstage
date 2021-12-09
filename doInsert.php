<?php
$name=$_POST["name"];
$email=$_POST["email"];
$mobile=$_POST["mobile"];
$password=$_POST["password"];

require_once ("db_connect.php");
//$sql="ALTER TABLE users CHANGE COLUMN account userAccount VARCHAR(30), ADD INDEX(userAccount)";

$now=date(format:"Y-m-d H:i:s");
//echo $now;
//exit;

$sql="INSERT INTO users( name , email , mobile , password ,  created_at) VALUES('$name','$email','$now')";

if ($conn->query($sql) === TRUE) {
    echo  "新增資料完成" ;

}else{
    echo "新增資料錯誤" .$conn ->error;
}
?>