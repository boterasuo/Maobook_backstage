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
$sqlCheck="SELECT * FROM users WHERE account=? ";
$stmtCheck=$db_host->prepare($sqlCheck);
$stmtCheck->execute([$account]);
$emailExist=$stmtCheck->rowCount();
//echo $userExist;
if($emailExist>0){

    echo '<div class="alert alert-warning" role="alert">
        已有相同信箱進行註冊！</div>';
    exit();

}
$now=date("Y-m-d H:i:s");
$sql="INSERT INTO users( account , name , email, mobile , password , valid , created_at)VALUES('$account','$name', '$email','$mobile', '$crPassword','$valid','$now')";

$stmt=$db_host->prepare($sql);
try{
    $stmt->execute();
    header("location: sign-in.php");
}catch(PDOException $e){
    echo $e->getMessage();
}

?>