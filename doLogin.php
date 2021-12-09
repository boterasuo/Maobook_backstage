<?php
require_once ("../pdo-connect.php");

if(isset($_POST["email"])){
    $email=$_POST["email"];
    $password=$_POST["password"];
}else{
    exit();
}
$password=md5($password);
$sql="SELECT * FROM users WHERE email=? AND password = ? AND valid=1";
$stmt=$db_host->prepare($sql);
try{
    $stmt->execute([$email, $password]);
    $userExist=$stmt->rowCount();
//    echo $userExist;
    if($userExist>0){
        $row=$stmt->fetch();
        $user=[
            "account"=>$row["account"],
            "name"=>$row["name"],
            "email"=>$row["email"]
        ];
//        $_SESSION["cart"];
        $_SESSION["user"]=$user;
//        var_dump($_SESSION["user"]);
        header("location: dashboard.php");
    }
}catch(PDOException $e){
    echo $e->getMessage();
}

