<?php
require_once ("pdo-connect.php");

$id=$_GET["id"];

//刪除該會員寵物資料
$sqlPet="UPDATE pets SET valid=9 WHERE user_id=?";
$stmtPet=$db_host->prepare($sqlPet);
$stmtPet->execute([$id]);

//刪除該會員本人資料
$sqlUser="UPDATE users SET valid=9 WHERE id=? ";
$stmtUser=$db_host->prepare($sqlUser);

try{
    $stmtUser->execute([$id]);
//    echo "使用者刪除成功<br>";
    echo "<script> alert('刪除成功!'); window.location.href='user-list.php'</script>";
//    header("location: user-list.php");
}catch(PDOException $e){
    echo $e->getMessage();
}
