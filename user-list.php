<?php
require_once("pdo-connect.php");
$sql = "SELECT id, account, name, created_at FROM users WHERE valid!=9";
$stmt=$db_host->prepare($sql);
try{
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $userCount=$stmt->rowCount();
}catch(PDOException $e){
    echo $e->getMessage();
}
for ($i=0; $i<count($rows); $i++){
    $sqlDogs = "SELECT user_id, COUNT(id) AS dog_count FROM pets WHERE category='dog' AND user_id=? GROUP BY user_id";
    $sqlCats = "SELECT user_id, COUNT(id) AS cat_count FROM pets WHERE category='cat' AND user_id=? GROUP BY user_id";
    $stmtDogs=$db_host->prepare($sqlDogs);
    $stmtDogs->execute([$rows[$i]["id"]]);
    $userDogs = $stmtDogs->fetchAll(PDO::FETCH_ASSOC);
    $stmtCats=$db_host->prepare($sqlCats);
    $stmtCats->execute([$rows[$i]["id"]]);
    $userCats = $stmtCats->fetchAll(PDO::FETCH_ASSOC);
//    var_dump($userDogs);
//    echo "<br>";
    $dogCountArr=array_column($userDogs, "dog_count");
    $catCountArr=array_column($userCats, "cat_count");
    foreach($dogCountArr as $dogCount){
        $rows[$i]["dogs"]=$dogCount;
    }
    foreach($catCountArr as $catCount){
        $rows[$i]["cats"]=$catCount;
    }
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

    <title>會員列表</title>

    <?php require_once("style.php"); ?>
    <style>
        #th-id{
            width: 7%;
        }
        #th-account{
            width: 17%;
        }
        #th-created-at{
            width: 22%;
        }
        #th-dog-count, #th-cat-count{
            width: 10%;
        }
        .pet-icon{
            width: 20px;
        }
    </style>

</head>
<body class="sb-nav-fixed">
<?php require_once("main-nav.php"); ?>
<!-- 主要內容 -->
<div id="layoutSidenav_content">
    <div class="container px-0">
        <main class="main px-5">
            <div class="container-fluid px-2">
                <h1 class="mt-4">會員列表</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="home.php">首頁</a></li>
                    <li class="breadcrumb-item active">會員列表</li>
                </ol>

                <div class="py-2 d-flex justify-content-end" >
                <button class="col-auto mb-3 col-2 btn btn-outline-warning text-white" role="button" onclick="window.location.href='user-add.php'">新 增 會 員</button>
                </div>

<!--                <div class="btn-group" role="group" aria-label="Basic outlined example">-->
<!--                    <button type="button" class="btn btn-outline-warning text-white">新增會員</button>-->
<!--                    <button type="button" class="btn btn-outline-warning text-white">刪除會員</button>-->
<!--                </div>-->

                <!--                <div>--><?//=var_dump($rows)?><!--</div>-->

                <!-- 副標題 end -->
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
                                <th id="th-id">ID</th>
                                <th id="th-account">帳號</th>
                                <th>名稱</th>
                                <th id="th-created-at">建立時間</th>
                                <th id="th-dog-count">狗狗數</th>
                                <th id="th-cat-count">貓貓數</th>
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
                                <th>狗狗數</th>
                                <th>貓貓數</th>
                                <th>其他操作</th>
                            </tr>
                            </tfoot>
                            <!-- 資料欄 tbody -->
                            <tbody>
                            <?php if ($userCount > 0):
                                foreach($rows as $user):?>
                                    <tr>
                                        <td><?= $user["id"] ?></td>
                                        <td><?= $user["account"] ?></td>
                                        <td><?= $user["name"] ?></td>
                                        <td><?= $user["created_at"] ?></td>
                                        <td>
                                            <?php if(isset($user["dogs"])): ?>
                                                <img class="pet-icon me-1" src="images/dog.png" alt="">
                                                <?= $user["dogs"] ?>
                                            <?php else:?>
                                                <img class="pet-icon me-1" src="images/dog.png" alt="">
                                                0
                                            <?php endif;?>
                                        </td>
                                        <td>
                                            <?php if(isset($user["cats"])): ?>
                                                <img class="pet-icon me-1" src="images/cat.png" alt="">
                                                <?= $user["cats"] ?>
                                            <?php else:?>
                                                <img class="pet-icon me-1" src="images/cat.png" alt="">
                                                0
                                            <?php endif;?>
                                        </td>
                                        <td>
                                            <a class="btn btn-mao-primary " href="user.php?id=<?=$user["id"]?>"
                                               title="檢視此會員資料">
                                                <i class="fas fa-user"></i></a>
                                            <a class="btn btn-mao-primary" href="user-edit.php?id=<?= $user["id"] ?>"
                                            title="編輯此會員資料">
                                                <i class="fas fa-edit"></i></a>
                                            <a class="btn btn-mao-primary " href="user-order.php?id=<?=$user["id"]?>"
                                            title="會員訂單">
                                                <i class="fas fa-credit-card "></i></a>
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
