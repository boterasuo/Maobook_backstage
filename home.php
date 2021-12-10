<?php
require_once("pdo-connect.php");
$sql="SELECT id, account, name, email, created_at FROM users WHERE valid!=9";
$stmt=$db_host->prepare($sql);

try{
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $userCount=$stmt->rowCount();
}catch(PDOException $e){
    echo $e->getMessage();
}
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

    <title>首頁</title>

    <?php require_once("style.php"); ?>

</head>
<body class="sb-nav-fixed">
<?php require_once("main-nav.php"); ?>
<!-- 主要內容 -->
<div id="layoutSidenav_content">
    <div class="container px-0">
        <main class="main px-5">
            <div class="container-fluid px-4">
                <h1 class="mt-4">首頁</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">首頁</li>
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
                            <th>帳號</th>
                            <th>名稱</th>
                            <th>建立時間</th>
                            <th>其他操作</th>
                        </tr>
                        </thead>
                        <!-- 總結資訊 tfoot -->
                        <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>帳號</th>
                            <th>名稱</th>
                            <th>建立時間</th>
                            <th>其他操作</th>
                        </tr>
                        </tfoot>
                        <!-- 資料欄 tbody -->
                        <tbody>
                        <?php if ($userCount > 0):
                            foreach($rows as $user)://關聯式陣列
                                ?>
                                <tr>
                                    <td><?= $user["id"] ?></td>
                                    <td><?= $user["email"] ?></td>
                                    <td><?= $user["name"] ?></td>
                                    <td><?= $user["created_at"] ?></td>
                                    <td>
                                        <a class="btn btn-mao-primary" href="user.php?id=<?=$user["id"]?>"
                                           title="檢視此會員資料">
                                            <i class="fas fa-user" ></i></a>
                                        <a class="btn btn-mao-primary" href="user-edit.php?id=<?= $user["id"] ?>"
                                           title="編輯此會員資料">
                                            <i class="fas fa-edit"></i></a>
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
