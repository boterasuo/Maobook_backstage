<?php
require_once("pdo-connect.php");
$sqlPets="SELECT * FROM pets WHERE valid!=9";
$stmtPets=$db_host->prepare($sqlPets);

try{
    $stmtPets->execute();
    $petRows = $stmtPets->fetchAll(PDO::FETCH_ASSOC);
    $petCount=$stmtPets->rowCount();
}catch(PDOException $e){
    echo $e->getMessage();
}

$sqlUser="SELECT id, account, name FROM users WHERE valid!=9";
$stmtUser=$db_host->prepare($sqlUser);
$stmtUser->execute();
$userRows = $stmtUser->fetchAll(PDO::FETCH_ASSOC);
$userAccount = array_column($userRows, "account", "id");
$userName = array_column($userRows, "name", "id");

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

</head>
<body class="sb-nav-fixed">
<?php require_once("main-nav.php"); ?>
<!-- 主要內容 -->
<div id="layoutSidenav_content">
    <div class="container px-0">
        <main class="main px-5">
            <div class="container-fluid px-4">
                <h1 class="mt-4">毛孩管理</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item">首頁</li>
                    <li class="breadcrumb-item active">毛孩管理</li>
                </ol>

            <!-- 副標題 end -->
                <div class="row">
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-primary text-white mb-4">
                            <div class="card-body">Primary Card</div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="#">View Details</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-warning text-white mb-4">
                            <div class="card-body">Warning Card</div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="#">View Details</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-success text-white mb-4">
                            <div class="card-body">Success Card</div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="#">View Details</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-danger text-white mb-4">
                            <div class="card-body">Danger Card</div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="#">View Details</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-6">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-chart-area me-1"></i>
                                面積圖表
                            </div>
                            <div class="card-body">
                                <canvas id="myAreaChart" width="100%" height="40"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-chart-bar me-1"></i>
                                長條圖表
                            </div>
                            <div class="card-body">
                                <canvas id="myBarChart" width="100%" height="40"></canvas>
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
                                    <td><?= $userAccount[$pet["user_id"]] ?></td>
                                    <td><?= $userName[$pet["user_id"]] ?></td>
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
