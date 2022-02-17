<?php
require_once("pdo-connect.php"); //連線到遠端資料庫

$id=$_POST["id"];
$email=$_POST["email"];
$password=$_POST["password"];
$name=$_POST["name"];
$mobile=$_POST["mobile"];
$valid=$_POST["valid"];

if(isset($_POST["gender"])){
    $gender=$_POST["gender"];
//    var_dump($gender);
}else{
    $gender=null;
//    var_dump($gender);
}

if(isset($_POST["birthday"])){
    $birthday=$_POST["birthday"];
    if($birthday==""){
        $birthday=null;
    }
}else{
    $birthday=null;
}

if(isset($_POST["zip"])){
    $zip=$_POST["zip"];
    if($zip==""){
      $zip=null;
    }
}else{
    $zip=null;
}

if(isset($_POST["county"])){
    $county=$_POST["county"];
    if($county==""){
        $county=null;
    }
}else{
    $county=null;
}

if(isset($_POST["address"])){
    $address=$_POST["address"];
    if($address==""){
        $address=null;
    }
}else{
    $address=null;
}


$sqlUser="UPDATE users SET email=?, password=?, name=?, gender=?, birthday=?, mobile=?, zip_code=?, county=?, address=?, valid=?
WHERE id=?";
$stmtUser=$db_host->prepare($sqlUser);
try{
    $stmtUser->execute([$email, $password, $name, $gender, $birthday, $mobile, $zip, $county, $address, $valid, $id]);
//    echo "修改資料完成<br>";
//    header("location: user.php?id=$id");
}catch(PDOException $e){
    echo $e->getMessage();
}

//var_dump($_POST["noAvatarPic"]);
//69~74判斷最後一次對大頭貼的編輯動作為何(上傳新圖 or 刪除)
//因只要有修改圖片(上傳)$_FILES["myFile"]["error"]就是0, 即使再按刪除鍵還是一樣, 故要再加判斷修改error值
if ($_POST["noAvatarPic"]=="avatar_user.png"){
    $_FILES["myFile"]["error"]=1;
    echo $_FILES["myFile"]["error"];
}else{
    echo "fail!";
}


if ($_FILES["myFile"]["error"] === 0){
//    echo $_FILES["myFile"]["name"];
    $fileExt=pathinfo($_FILES["myFile"]["name"], PATHINFO_EXTENSION);
    if (move_uploaded_file($_FILES["myFile"]["tmp_name"], "images/".$id."-".time().".".$fileExt)){
        $file_name=$id."-".time().".".$fileExt;

        $sqlPic="UPDATE users SET image=? WHERE id=? ";
        $stmtPic=$db_host->prepare($sqlPic);
        try{
            $stmtPic->execute([$file_name, $id]); //寫入資料庫
//            echo "upload success";
            echo "<script> alert('修改成功!'); window.location.href='user.php?id=$id'</script>";
        }catch (PDOException $e){
            echo $e->getMessage();
        }
    }else{
        echo "upload failed";
    }
}else{
    if(isset($_POST["noAvatarPic"]) && $_POST["noAvatarPic"]=="avatar_user.png"){
        $noAvatarPic=null;
        $sqlPic="UPDATE users SET image=? WHERE id=? ";
        $stmtPic=$db_host->prepare($sqlPic);
        $stmtPic->execute([$noAvatarPic, $id]);
        echo "<script> alert('修改成功!'); window.location.href='user.php?id=$id'</script>";
    }
    echo "<script> alert('修改成功!'); window.location.href='user.php?id=$id'</script>";
}

$petId = $_POST["pet_id"];
$sqlPet="UPDATE pets SET valid=9 WHERE id=?";
$stmtPet=$db_host->prepare($sqlPet);
try{
    $stmtPet -> execute([$petId]);
    $data = [
        "status" => 1,
    ];
}catch(PDOException $e){
    echo $e->getMessage();
    $data = [
        "status" => 0,
        "message" => "失敗啦!"
    ];
}

echo json_encode($data);