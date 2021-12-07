<?php
require_once("domain-pdo-connect.php"); //連線到遠端資料庫
$id=$_GET["id"]; // pets id
$sqlPets="SELECT * FROM pets WHERE id=?";
$stmtPets=$db_host->prepare($sqlPets);
try{
    $stmtPets->execute([$id]);
    $rowPet=$stmtPets->fetch();
}catch(PDOException $e){
    echo $e->getMessage();
}

$sqlProfile="SELECT * FROM pets_basic_profile WHERE created_at=(SELECT MAX(created_at) 
    AS maxtime FROM pets_basic_profile WHERE pet_id=?)";
//AND created_at=(SELECT MAX(created_at) FROM pets_basic_profile) 最新的毛孩數據
$stmtProfile=$db_host->prepare($sqlProfile);
try{
    $stmtProfile->execute([$id]);
    $rowProfile=$stmtProfile->fetch(PDO::FETCH_ASSOC);
}catch(PDOException $e){
    echo $e->getMessage();
}

$sqlUser="SELECT pets.id, users.id, users.account, users.name, users.image FROM pets
JOIN users ON pets.user_id = users.id
WHERE pets.id=?";
$stmtUser=$db_host->prepare($sqlUser);
try{
    $stmtUser->execute([$id]);
    $rowUser=$stmtUser->fetch();
}catch(PDOException $e){
    echo $e->getMessage();
}

$user_id=$rowUser["id"];
$sqlOtherPet="SELECT pets.id, pets.name, pets.img FROM pets WHERE user_id=?";
$stmtOtherPet=$db_host->prepare($sqlOtherPet);
try{
    $stmtOtherPet->execute([$user_id]);
    $rowOtherPet=$stmtOtherPet->fetchAll(PDO::FETCH_ASSOC);
}catch(PDOException $e){
    echo $e->getMessage();
}
$petCount=$stmtOtherPet->rowCount();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="Description" content="MaoBook小組專題報告"/>
    <meta name="Content-Language" content="zh-TW">
    <meta name="author" content="Team MaoBook"/>
    <!--  網站圖示  -->
    <link rel="apple-touch-icon" type="image/png" href="images/logo-nbg.png"/>
    <link rel="shortcut icon" type="image/png" href="images/logo-nbg.png"/>
    <link rel="mask-icon" type="image/png" href="images/logo-nbg.png"/>


    <title><?=$rowPet["name"]?>的資料</title>

    <?php require_once("style.php"); ?>
    <link rel="stylesheet" href="css/ou-style.css">

</head>
<body class="sb-nav-fixed">
<?php require_once("main-nav.php"); ?>
<!-- 主要內容 -->
<div id="layoutSidenav_content">
    <div class="container px-0">
        <main class="main px-5">
            <div class="container-fluid px-4">
                <h1 class="mt-4"><?=$rowPet["name"]?>的資料</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="index.php">首頁</a></li>
                    <li class="breadcrumb-item"><a href="">會員資料</a></li>
                    <li class="breadcrumb-item active"><?=$rowPet["name"]?>的資料</li>
                </ol>
            </div>

            <!--    本頁 內容    -->
            <div class="row">
                <div class="col-7">
                    <table class="table table-bordered table-sm">
                        <tr>
                            <th>毛孩姓名</th>
                            <td><?=$rowPet["name"]?></td>
                        </tr>
                        <tr>
                            <th>毛孩性別</th>
                            <td class="pet-gender d-flex">
                                <div class="form-check me-3">
                                    <input class="form-check-input" type="radio" name="flexRadioDisabled" id="flexRadioDisabled" disabled
                                        <?php if ($rowPet["gender"]==1):
                                            echo "checked";
                                        endif; ?>
                                    >
                                    <label class="form-check-label" for="flexRadioDisabled">男孩</label>
                                </div>
                                <div class="form-check me-3">
                                    <input class="form-check-input" type="radio" name="flexRadioDisabled" id="flexRadioDisabled" disabled
                                        <?php if ($rowPet["gender"]==2):
                                            echo "checked";
                                        endif; ?>
                                    >
                                    <label class="form-check-label" for="flexRadioDisabled">女孩</label>
                                </div>
                                <div class="form-check me-3">
                                    <input class="form-check-input" type="radio" name="flexRadioDisabled" id="flexRadioDisabled" disabled
                                        <?php if ($rowPet["gender"]==9):
                                            echo "checked";
                                        endif; ?>
                                    >
                                    <label class="form-check-label" for="flexRadioDisabled">不透漏</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>毛孩類型</th>
                            <td>
                                <?php if($rowPet["category"]==="dog"):
                                    echo "狗狗";
                                elseif($rowPet["category"]==="cat"):
                                    echo "貓貓";
                                endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>毛孩生日</th>
                            <td><?=$rowPet["birthday"]?></td>
                        </tr>
                        <tr>
                            <th>毛孩到家日</th>
                            <td><?=$rowPet["adopt_time"]?>
                                <?php $now=date("Y-m-d");
                                $timeDiff=strtotime($now) - strtotime($rowPet["adopt_time"]);
                                ?>
                                <div class="data-time d-inline-block ms-3">
                                    已陪伴您 <?=$timeDiff / (60*60*24)?> 天
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>收養類型</th>
                            <td><?php if($rowPet["adopt_type"]==1):
                                    echo "接養";
                                elseif($rowPet["adopt_type"]==2):
                                    echo "領養";
                                elseif($rowPet["adopt_type"]==3):
                                    echo "購買";
                                endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>毛孩體重</th>
                            <td>
                                <?=$rowProfile["weight"];?> kg
                                <div class="data-time d-inline-block ms-3">資料時間：<?=$rowProfile["created_at"]?></div>
                            </td>
                        </tr>
                        <tr>
                            <th>毛孩身高</th>
                            <td>
                                <?=$rowProfile["height"]?> cm
                                <div class="data-time d-inline-block ms-3">資料時間：<?=$rowProfile["created_at"]?></div>
                            </td>
                        </tr>
                        <tr>
                            <th>奴才會員帳號</th>
                            <td>
                                <?=$rowUser["account"]?>
                                <a class="btn btn-mao-primary btn-sm ms-3" href="#">檢視會員資料</a>
                            </td>
                        </tr>
                        <tr>
                            <th>奴才姓名</th>
                            <td><?=$rowUser["name"]?></td>
                        </tr>
                    </table>
                </div>
                <div class="avatar col-4">
                    <div>
                        <h4><?=$rowPet["name"]?>的大頭照</h4>
                        <figure class="main-pet ratio ratio-1x1">
                            <img class="cover-fit" src="images/<?=$rowPet["img"]?>" alt="">
                        </figure>
                    </div>
                    <div>
                        <h4>毛孩家人</h4>
                        <div class="d-flex">
                            <figure  class="main-user ratio ratio-1x1 me-3">
                                <a href="#">
                                    <img  class="cover-fit" src="images/<?=$rowUser["image"]?>" alt="">
                                </a>
                            </figure>
                            <?php if($petCount>1): ?>
                            <?php for($i=0; $i<=($petCount-1); $i++): ?>
                                    <?php if($rowOtherPet[$i]["id"]!==$rowPet["id"]):?>
                            <figure  class="sub-pet ratio ratio-1x1 me-3">
                                <a href="pet-info.php?id=<?=$rowOtherPet[$i]["id"]?>">
                                    <img  class="cover-fit" src="images/<?=$rowOtherPet[$i]["img"]?>"
                                          alt="">
                                </a>
                            </figure>
                                    <?php endif; ?>
                                <?php endfor; ?>
                            <?php endif; ?>

                        </div>

                    </div>
                </div>
            </div>


            <!--   本頁內容 end  -->


        </main><!-- 主要內容end -->

    </div>
<!--    --><?php //require_once("footer.php"); ?>

</div>
<?php require_once("JS.php"); ?>
</body>
</html>
