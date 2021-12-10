<?php
require_once("pdo-connect.php"); //連線到遠端資料庫

$id=$_POST["id"];
$password=$_POST["password"];
$name=$_POST["name"];
$gender=$_POST["gender"];
$birthday=$_POST["birthday"];
$mobile=$_POST["mobile"];
$zip=$_POST["zip"];
$county=$_POST["county"];
$address=$_POST["address"];
$valid=$_POST["valid"];

$sqlUser="UPDATE users SET password=?, name=?, gender=?, birthday=?, mobile=?, zip_code=?, county=?, address=?, valid=?
WHERE id=?";
$stmtUser=$db_host->prepare($sqlUser);
try{
    $stmtUser->execute([$password, $name, $gender, $birthday, $mobile, $zip, $county, $address, $valid, $id]);
//    echo "修改資料完成<br>";
//    header("location: user.php?id=$id");
}catch(PDOException $e){
    echo $e->getMessage();
}

if ($_FILES["myFile"]["error"] === 0){
    if (move_uploaded_file($_FILES["myFile"]["tmp_name"], "images/".$id.$_FILES["myFile"]["name"])){
        $file_name=$id.$_FILES["myFile"]["name"];

        $sqlPic="UPDATE users SET image=? WHERE id=? ";
        $stmtPic=$db_host->prepare($sqlPic);
        try{
            $stmtPic->execute([$file_name, $id]); //寫入資料庫
//            echo "upload success";
            header("location: user.php?id=$id");
        }catch (PDOException $e){
            echo $e->getMessage();
        }
    }else{
        echo "upload failed";
    }
}else{
    header("location: user.php?id=$id");
}