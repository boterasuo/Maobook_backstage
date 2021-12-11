<?php
require_once ("pdo-connect.php");
$account=$_POST["account"];
$name=$_POST["name"];
$email=$_POST["email"];
$mobile=$_POST["mobile"];
$password=$_POST["password"];
$RePassword=$_POST["RePassword"];
$valid=1;


if($password!==$RePassword){

    echo '<div class="alert alert-warning" role="alert">
        密碼不一致</div>';
    exit();
}
$crPassword=md5($password);
//echo "$crPassword<br>";
$sqlCheck="SELECT * FROM users WHERE account='$account'";
$checkResult=$conn->query($sqlCheck);
$emailExist=$checkResult->num_rows;
//echo $userExist;
if($emailExist>0){

    echo '<div class="alert alert-warning" role="alert">
        已有相同信箱進行註冊！</div>';
    exit();

}
$now=date("Y-m-d H:i:s");
$sql="INSERT INTO users( account , name , email, mobile , password , valid , created_at)VALUES('$account','$name', '$email','$mobile', '$password','$valid','$now')";


if ($conn->query($sql) === TRUE) {
    echo '<div class="alert alert-warning" role="alert">
        註冊成功！期待與您一起書寫毛毛日記！</div>';
    $id=$conn->insert_id;
    header("location: sign-in.php");


} else {
    echo "新增資料錯誤: " . $conn->error;
}

?>