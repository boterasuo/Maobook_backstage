<?php
require_once ("../pdo-connect.php");

if(isset($_POST["email"])){
    $email=$_POST["email"];
    $password=$_POST["password"];
}else{
    exit();
}
$password=md5($password);
$sql="SELECT * FROM users WHERE email= ? AND password = ? AND valid=1";
$stmt=$db_host->prepare($sql);
try{
    $stmt->execute([$email, $password]);
    $userExist=$stmt->rowCount();
    //echo $userExist;

    if($userExist>0){
        $row=$stmt->fetch();
        $user=[
            "id"=>$row["id"],
            "account"=>$row["account"],
            "name"=>$row["name"],
            "email"=>$row["email"]
        ];
//        $_SESSION["cart"];
        $_SESSION["user"]=$user;
        unset($_SESSION["error_times"]);
        unset($_SESSION["error_msg"]);
        var_dump($_SESSION["user"]);
        header("location: dashboard.php");
    }else{
        $_SESSION["error_msg"]="帳號或密碼輸入錯誤";
        if(isset($_SESSION["error_times"])){
            $_SESSION["error_times"]=$_SESSION["error_times"]+1;
        }else{
            $_SESSION["error_times"]=1;
        }

        header("location: sign-in.php");
    }
}catch(PDOException $e){
    echo $e->getMessage();
}
