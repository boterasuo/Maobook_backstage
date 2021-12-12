<?php
require_once("pdo-connect.php");




if(isset($_GET["petToday"])) {
    $petToday = $_GET["petToday"];
    $sqlPets = "SELECT * FROM pets WHERE valid!=9 AND DATE(created_at)=? ";
    $stmtPets = $db_host->prepare($sqlPets);
    $stmtPets->execute([$petToday]);
}else if(isset($_GET["dogTotal"])){
    $cate_dog = $_GET["dogTotal"];
    $sqlPets = "SELECT * FROM pets WHERE valid!=9 AND category=? ";
    $stmtPets = $db_host->prepare($sqlPets);
    $stmtPets->execute([$cate_dog]);
}else if (isset($_GET["catTotal"])){
    $cate_cat = $_GET["catTotal"];
    $sqlPets = "SELECT * FROM pets WHERE valid!=9 AND category=? ";
    $stmtPets = $db_host->prepare($sqlPets);
    $stmtPets->execute([$cate_cat]);
}
else{
    $sqlPets="SELECT * FROM pets WHERE valid!=9";
    $stmtPets=$db_host->prepare($sqlPets);
    $stmtPets->execute();
}
try{
    $petRows = $stmtPets->fetchAll(PDO::FETCH_ASSOC);
    $petCount=$stmtPets->rowCount();
}catch(PDOException $e){
    echo $e->getMessage();
}

$sqlUser="SELECT id, account, name, valid FROM users WHERE valid!=9";
$stmtUser=$db_host->prepare($sqlUser);
$stmtUser->execute();
$userRows = $stmtUser->fetchAll(PDO::FETCH_ASSOC);
$userAccount = array_column($userRows, "account", "id");
$userName = array_column($userRows, "name", "id");
$userValid = array_column($userRows, "valid", "id");

$now=date("Y-m-d");
$sqlPetCount="SELECT COUNT(id) AS pet_count FROM pets WHERE DATE(created_at)= ? ";
$stmtPetCount=$db_host->prepare($sqlPetCount);
$stmtPetCount->execute([$now]);
$petCount = $stmtPetCount->fetch(PDO::FETCH_ASSOC);
//var_dump($petCount);

$sqlTotalPet="SELECT *, COUNT(id) AS pet_total_count FROM pets WHERE valid!=9 GROUP BY category";
$stmtTotalPet=$db_host->prepare($sqlTotalPet);
$stmtTotalPet->execute();
$rowTotalPet=$stmtTotalPet->fetchAll(PDO::FETCH_ASSOC);
$totalPet=array_column($rowTotalPet, "pet_total_count", "category");
//var_dump($totalPet);


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

    <title>毛孩管理</title>

    <?php require_once("style.php"); ?>
    <link rel="stylesheet" href="css/ou-style.css?time=<?=time()?>">
    <style>
        .pet-count-card div{
            width: 68px;
        }
        .dog-count-card{
            background: var(--mao-dog-brown);
        }
        .cat-count-card{
            background: var(--mao-cat-oranger);
        }
    </style>

</head>
<body class="sb-nav-fixed">
<?php require_once("main-nav.php"); ?>
<!-- 主要內容 -->
<div id="layoutSidenav_content">
    <div class="container px-0">
        <div class="main px-5">
            <div class="container-fluid px-4">
                <h1 class="mt-4">毛孩管理</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item">首頁</li>
                    <li class="breadcrumb-item active">毛孩管理</li>
                </ol>

            <!-- 副標題 end -->
                <div class="row">
                    <div class="col-xl-4 col-md-4">
                        <div class="card bg-primary text-white mb-4">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <div class="pet-count-card">
                                    <div>今日新增毛孩數 <i class="fas fa-paw"></i></div>
                                </div>
                                <div class="px-3 fs-2"><?=$petCount["pet_count"]?> <span class="fs-6">個</span></div>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="pets-list.php?petToday=<?=$now?>">
                                    View Details
                                </a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-4">
                        <div class="dog-count-card card text-white mb-4">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <div class="pet-count-card">
                                    <div>目前所有狗狗數<i class="fas fa-dog"></i></div>
                                </div>
                                <?php $dogShare=round($totalPet["dog"]*100/
                                    ($totalPet["dog"]+$totalPet["cat"]), 0) ?>
                                <div class="px-2 fs-3"><?=$totalPet["dog"]?> <span class="fs-6">個 / </span>
                                    <?=$dogShare?><span class="fs-6"> %</span>
                                </div>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link"
                                   href="pets-list.php?dogTotal=dog">View Details</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-4">
                        <div class="cat-count-card card text-white mb-4">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <div class="pet-count-card">
                                    <div>目前所有貓貓數<i class="fas fa-cat"></i></div>
                                </div>
                                <?php $catShare=round($totalPet["cat"]*100/
                                    ($totalPet["dog"]+$totalPet["cat"]), 0) ?>
                                <div class="px-2 fs-3"><?=$totalPet["cat"]?> <span class="fs-6">個 / </span>
                                    <?=$catShare?><span class="fs-6"> %</span>
                                </div>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link"
                                   href="pets-list.php?catTotal=cat">View Details</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    資料表格
                </div>

                <!-- 表格區塊 -->
                <div class="card-body">
                    <table id="datatablesSimple">
                        <!-- 標題欄 -->
                        <thead>
                        <tr>
                            <!-- 表格註腳 thead -->
                            <th>ID</th>
                            <th>毛孩名稱</th>
                            <th>毛孩類型</th>
                            <th>奴才帳號</th>
                            <th>奴才名稱</th>
                            <th>建立時間</th>
                            <th>其他操作</th>
                        </tr>
                        </thead>
                        <!-- 總結資訊 tfoot -->
                        <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>毛孩名稱</th>
                            <th>毛孩類型</th>
                            <th>奴才帳號</th>
                            <th>奴才名稱</th>
                            <th>建立時間</th>
                            <th>其他操作</th>
                        </tr>
                        </tfoot>
                        <!-- 資料欄 tbody -->
                        <tbody>
                        <?php if ($petCount > 0):
                            foreach($petRows as $pet)://關聯式陣列
                                ?>
                                <tr>
                                    <td><?= $pet["id"] ?></td>
                                    <td><?= $pet["name"] ?></td>
                                    <td>
                                        <?php if($pet["category"]==="dog"): ?>
                                        狗狗
                                        <?php else: ?>
                                        貓貓
                                        <?php endif; ?>
                                    </td>
                                    <td><?= $userAccount[$pet["user_id"]] ?></td>
                                    <td>
                                        <?= $userName[$pet["user_id"]] ?>
                                        <?php if($userValid[$pet["user_id"]]==0): ?>
                                        <div class="data-time d-inline-block">封鎖中</div>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= $pet["created_at"] ?></td>
                                    <td>
                                        <a class="btn btn-mao-primary" href="pet-info.php?id=<?=$pet["id"]?>"
                                           title="檢視此毛孩資料">
                                            <i class="fas fa-paw"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4">沒有資料</td>
                            </tr>
                        <?php endif; ?>
                        </tbody>
                    </table>
                    <?php if(isset($petToday) || isset($cate_dog) || isset($cate_cat)): ?>
                    <div class="text-center">
                        <a class="btn btn-mao-primary btn-sm" href="pets-list.php">回所有毛孩列表</a>
                    </div>
                    <?php endif; ?>
                </div><!-- 表格區塊 end-->
            </div>

        </main><!-- 主要內容end -->

    </div>
<!--    --><?php //require_once("footer.php"); ?>
<!--</div>-->
</div>
<?php require_once("JS.php"); ?>
</body>
</html>
