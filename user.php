<?php
require_once("pdo-connect.php"); //連線到遠端資料庫
$id=$_GET["id"];
$sqlUser="SELECT * FROM users WHERE id=?";
$stmtUser=$db_host->prepare($sqlUser);
try{
    $stmtUser->execute([$id]);
    $rowUser=$stmtUser->fetch();
}catch(PDOException $e){
    echo $e->getMessage();
}

$sqlTotalPet="SELECT pets.id, pets.name, pets.img FROM pets WHERE user_id=? AND valid=1";
$stmtTotalPet=$db_host->prepare($sqlTotalPet);
try{
    $stmtTotalPet->execute([$id]);
    $rowTotalPet=$stmtTotalPet->fetchAll(PDO::FETCH_ASSOC);
}catch(PDOException $e){
    echo $e->getMessage();
}
$petTotalCount=$stmtTotalPet->rowCount();

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

    <title><?=$rowUser["name"]?>的個人資料</title>

<!--  板模的css、BS5、fontawesome  -->
    <?php require_once("style.php"); ?>
    <!--  板模end  -->

    <!-- 此處新增css檔 -->
    <link rel="stylesheet" href="css/ou-style.css?time=<?=time()?>">
    <!-- Css檔 end   -->


</head>
<body class="sb-nav-fixed">
<?php require_once("main-nav.php"); ?>
<!-- 主要內容 -->
<div id="layoutSidenav_content">
    <div class="container px-0">
        <main class="main px-5">
            <div class="container-fluid px-4">
                <h1 class="mt-4"><?=$rowUser["name"]?>的個人資料</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="home.php">首頁</a></li>
                    <li class="breadcrumb-item active">會員資料</li>
                </ol>

            </div>

            <!--    本頁 內容    -->
            <div class="row">
                <div class="col-7">
                    <table class="table table-bordered table-sm user-table">
                        <tr>
                            <th>奴才帳號</th>
                            <td><?=$rowUser["account"]?></td>
                        </tr>
                        <tr>
                            <th>奴才密碼</th>
                            <td><?=$rowUser["password"]?></td>
                        </tr>
                        <tr>
                            <th>奴才姓名</th>
                            <td><?=$rowUser["name"]?></td>
                        </tr>
                        <tr>
                            <th>奴才性別</th>
                            <td class="d-flex">
                                <div class="form-check me-3">
                                    <input class="form-check-input" type="radio" name="flexRadioDisabled" id="flexRadioDisabled" disabled
                                        <?php if ($rowUser["gender"]==1):
                                            echo "checked";
                                        endif; ?>>
                                    <label class="form-check-label" for="flexRadioDisabled">男孩</label>
                                </div>
                                <div class="form-check me-3">
                                    <input class="form-check-input" type="radio" name="flexRadioDisabled" id="flexRadioDisabled" disabled
                                        <?php if ($rowUser["gender"]==2):
                                            echo "checked";
                                        endif; ?>>
                                    <label class="form-check-label" for="flexRadioDisabled">女孩</label>
                                </div>
                                <div class="form-check me-3">
                                    <input class="form-check-input" type="radio" name="flexRadioDisabled" id="flexRadioDisabled" disabled
                                        <?php if ($rowUser["gender"]==9):
                                            echo "checked";
                                        endif; ?>>
                                    <label class="form-check-label" for="flexRadioDisabled">不透漏</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>奴才生日</th>
                            <td><?=$rowUser["birthday"]?>
                                <?php $now=date("Y-m-d");
                                $userBirth=$rowUser["birthday"];
                                $age=date_diff(date_create($now), date_create($userBirth)); ?>
                                <div class="data-time d-inline-block ms-3">
                                    <?=$age->format('%y');?> 歲
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>奴才手機</th>
                            <td><?=$rowUser["mobile"]?></td>
                        </tr>
                        <tr>
                            <th rowspan="2">奴才地址</th>
                            <td>
                                <span class="add-tag">郵遞區號</span><?=$rowUser["zip_code"]?>
                                <span class="add-tag">縣市</span><?=$rowUser["county"]?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="add-tag">詳細地址</span><?=$rowUser["address"]?>
                            </td>
                        </tr>
                        <tr>
                            <th>使用者權限</th>
                            <td class="d-flex">
                                <div class="form-check me-3">
                                    <input class="form-check-input" type="radio" name="flexRadioDisabled2" id="flexRadioDisabled" disabled
                                        <?php if ($rowUser["valid"]==1):
                                            echo "checked";
                                        endif; ?>>
                                    <label class="form-check-label" for="flexRadioDisabled2">一般</label>
                                </div>
                                <div class="form-check me-3">
                                    <input class="form-check-input" type="radio" name="flexRadioDisabled2" id="flexRadioDisabled" disabled
                                        <?php if ($rowUser["valid"]==0):
                                            echo "checked";
                                        endif; ?>>
                                    <label class="form-check-label" for="flexRadioDisabled2">封鎖中</label>
                                </div>
                            </td>
                        </tr>

                    </table>
                    <div class="text-end">
                        <a class="btn btn-danger" href="user-doDelete.php?id=<?=$rowUser["id"]?>">刪除會員</a>
                        <a class="btn btn-mao-primary" href="user-edit.php?id=<?=$rowUser["id"]?>">編輯會員資料</a>

                    </div>

                </div>
                <div class="avatar col-5">
                    <div>
                        <h4><?=$rowUser["name"]?>的大頭照</h4>
                        <figure class="main-pet ratio ratio-1x1">
                            <?php if($rowUser["image"]!==""): ?>
                                <img class="cover-fit" src="images/<?=$rowUser["image"]?>" alt="">
                            <?php else: ?>
                                <img class="cover-fit" src="images/avatar_user.png" alt="">
                            <?php endif; ?>
                        </figure>
                    </div>
                    <div>
                        <h4>目前服侍毛孩</h4>
                        <?php if($petTotalCount==0): ?>
                        <p class="text-secondary">尚無服侍毛孩</p>
                        <?php elseif($petTotalCount>0): ?>
                        <div class="d-flex flex-wrap">
                        <?php foreach($rowTotalPet as $eachPet): ?>
                            <div class="me-3">
                                <figure  class="sub-pet ratio ratio-1x1">
                                    <a href="pet-info.php?id=<?=$eachPet["id"]?>">
                                        <?php if($eachPet["img"]!==""): ?>
                                            <img  class="cover-fit" src="images/<?=$eachPet["img"]?>"
                                                  alt="">
                                        <?php else: ?>
                                            <img  class="cover-fit" src="images/avatar_pet.png" alt="">
                                        <?php endif; ?>
                                    </a>
                                </figure>
                                <p class="text-center"><?=$eachPet["name"]?></p>
                            </div>
                            <?php endforeach; ?>
                        </div>
                        <?php endif; ?>
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
