<?php
//require_once("domain-db-connect.php");//連線到遠端資料庫 domain-pdo-connect.php;
require_once("db-connect.php");
//$sql = "SELECT * FROM user_oder WHERE status=1";
$sql = "SELECT id, user_id, order_time, status FROM user_order";

$result = $conn->query($sql);
$orderCount = $result->num_rows;

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

    <title>訂單管理</title>

    <?php require_once("style.php"); ?>

</head>
<body class="sb-nav-fixed">
<?php require_once("main-nav.php"); ?>
<!-- 主要內容 -->
<div id="layoutSidenav_content">
    <div class="container px-0">
        <main class="main px-5">
            <div class="container-fluid px-4">
                <h1 class="mt-4">訂單管理</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="home.php">首頁</a></li>
                    <li class="breadcrumb-item active">訂單管理</li>
                </ol>

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
                                <th><input type="checkbox">全選</th>
                                <th>訂單編號</th>
                                <th>訂單日期</th>
                                <th>客戶姓名</th>
                                <th>付款狀態</th>
                                <th>出貨狀態</th>
                                <th>總金額</th>
                            </tr>
                            </thead>
                            <!-- 總結資訊 tfoot -->
                            <tfoot>
                            <tr>
                                <th><input type="checkbox">   ˋ全選</th>
                                <th>訂單編號</th>
                                <th>訂單日期</th>
                                <th>客戶姓名</th>
                                <th>付款狀態</th>
                                <th>出貨狀態</th>
                                <th>總金額</th>
                            </tr>
                            </tfoot>
                            <!-- 資料欄 tbody -->
                            <tbody>
                            <?php if ($orderCount > 0):
                                while ($row = $result->fetch_assoc()): //關聯式陣列
//                                    var_dump($row);
                                    ?>
                                    <tr>
                                        <td class="w-10"><input type="checkbox"></td>
                                        <td class="fst-italic" title="訂單編號: <?= $row["id"] ?>"><a href="order-detail.php?id=<?= $row["id"] ?>">#<?= $row["id"] ?></a></td>
                                        <td><?= $row["order_time"] ?></td>
                                        <td><?= $row["user_id"] ?></td>
                                        <td><?= $row["status"] ?></td>
                                        <td><?= $row["status"] ?></td>
                                        <td><?= $row["status"] ?></td>
                                    </tr>

                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="12">沒有資料</td>
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