<?php
$account=$_POST["account"];
$email=$_POST["email"];
$password=$_POST["password"];
$repassword=$_POST["repassword"];
if($password!==$repassword){
    echo "密碼不一致";
    exit();
}
$password=md5($password);
require_once ("../db-connect.php");
$sqlCheck="SELECT * FROM users WHERE account='$account'";
$checkResult=$conn->query($sqlCheck);
$userExist=$checkResult->num_rows;
//echo $userExist;
if($userExist>0){
    echo "帳號已存在";
    exit();
}
$now=date("Y-m-d H:i:s");
$sql="INSERT INTO users(account, email, password, created_at) VALUES('$account', '$email', '$password', '$now')";



?>