<?php
require_once ("pdo-connect.php");
$name=$_POST["name"];
$email=$_POST["email"];
$mobile=$_POST["mobile"];
$password=$_POST["password"];
$repassword=$_POST["repassword"];


if($password!==$repassword){
    echo "密碼不一致";
    exit();
}
$crPassword=md5($password);
//echo "$crPassword<br>";
$sqlCheck="SELECT * FROM users WHERE email='$email'";
$checkResult=$conn->query($sqlCheck);
$emailExist=$checkResult->num_rows;
//echo $userExist;
if($emailExist>0){
    echo "已有相同信箱進行註冊";
    exit();
}
$now=date("Y-m-d H:i:s");
$sql="INSERT INTO users(name, email, mobile, password, created_at) VALUES('$name', '$email','$mobile', '$crPassword', '$now')";


if ($conn->query($sql) === TRUE) {
    echo "新增資料完成<br>";
    $id=$conn->insert_id;
    header("location: sign-in.php");
} else {
    echo "新增資料錯誤: " . $conn->error;
}

?>