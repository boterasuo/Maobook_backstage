<?php
//require_once ("domain-pdo-connect.php");
require_once("pdo-connect.php");
if (isset($_GET["id"])):
$id = $_GET["id"]; //order id
$sqlOrder = "SELECT * FROM user_order WHERE id=?";//從訂單抓資料
$stmtOrder = $db_host->prepare($sqlOrder);
try {
    $stmtOrder->execute([$id]);
    $rowOrder = $stmtOrder->fetch(); //訂單資料

} catch (PDOException $e) {
    echo "取得訂單資訊錯誤<br>";
    echo $e->getMessage();
}

//status
$sqlStatusType = "SELECT * FROM order_status";
$stmtStatusType = $db_host->prepare($sqlStatusType);
try {
    $stmtStatusType->execute();
    $statusTypeRows = $stmtStatusType->fetchAll(PDO::FETCH_ASSOC);
    $statusTypes = array_column($statusTypeRows, "name", "id");
} catch (PDOException $e) {
    echo "預處理陳述式執行失敗！ <br/>";
    echo "Error: " . $e->getMessage() . "<br/>";
    $db_host = NULL;
    exit;
}

// 抓取 users 會員資料表
$id=$_GET["id"]; //user id
$sqlUser="SELECT * FROM users WHERE id=?";
$stmtUser=$db_host->prepare($sqlUser);
try{
    $stmtUser->execute([$id]);
    $rowUser=$stmtUser->fetch();//會員資料
}catch(PDOException $e){
    echo $e->getMessage();
}


//抓取 user_order
$sqlOrderList = "SELECT * FROM user_order WHERE user_id=?";
$stmtOrderList = $db_host->prepare($sqlOrderList);
try {
    $stmtOrderList->execute([$id]);
    $rowOrderList = $stmtOrderList->fetchAll(PDO::FETCH_ASSOC);
    $orderCount = $stmtOrderList->rowCount();
} catch (PDOException $e) {
    echo $e->getMessage();
}


//選擇訂單總金額、產品名稱、產品價格、產品圖片從[order-detail]加入到[products]參考ON在order_detail.product_id = products.id
$sql = "SELECT order_detail.amount, products.name, products.price, products.img FROM order_detail
JOIN products ON order_detail.product_id = products.id
WHERE order_detail.order_id = ?";
$stmt = $db_host->prepare($sql);
try {
    $stmt->execute([$id]);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
//    $rowOrder=$stmtOrder->fetch();
} catch (PDOException $e) {
    echo "取得訂單細節錯誤<br>";
    echo $e->getMessage();
}

//抓status的名稱
$sql = "SELECT order_status.name,order_status.id, user_order.status, user_order.id FROM user_order JOIN order_status ON user_order.status = order_status.id
WHERE user_order.id = ?";
$stmtOrderStatus = $db_host->prepare($sql);
try {
    $stmtOrderStatus->execute([$id]);
    $statusRow = $stmtOrderStatus->fetch(PDO::FETCH_ASSOC);
    $statusRows = $stmtOrderStatus->fetchAll(PDO::FETCH_ASSOC);
//    $rowOrder=$stmtOrder->fetch();
} catch (PDOException $e) {
    echo "取得訂單細節錯誤<br>";
    echo $e->getMessage();
}

//抓user_id的名稱
$sql = "SELECT  user_order.user_id, user_order.id, users.name FROM user_order JOIN users ON user_order.user_id = users.id
WHERE user_order.id = ?";
$stmtOrderUser = $db_host->prepare($sql);
try {
    $stmtOrderUser->execute([$id]);
    $orderUserRow = $stmtOrderUser->fetch(PDO::FETCH_ASSOC);
//    $rowOrder=$stmtOrder->fetch();
} catch (PDOException $e) {
    echo "取得訂單細節錯誤<br>";
    echo $e->getMessage();
}

endif;
//if結束
?>
<!doctype html>
<html lang="en">
<head>
    <title><?= $rowUser["name"] ?> 訂單列表</title>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.0.2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <?php require_once("style.php") ?>
    <style>
        #showarea{
            width: 100vw;
            height: 100vh;
            background: rgba(0, 0, 0, 0.678);
            visibility:hidden;
            position: absolute;
            top:0;
            left: 0;
            z-index: 99999;
        }
        #showBox{
            width: 300px;
            max-height: 300px;
            background:white;
            border-radius: 10px;
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content:end;
            position: absolute;
            top:50%;
            left: 50%;
            transform: translate(-50%, -50%);


        }
        .text{
            font-weight: 600;
            margin-bottom: 15px;
        }
        .closeBtn{
            width: 60px;
            height: 30px;
            /*background:rgb(255, 217, 0);*/
            /*color: white;*/
            font-size: 14pt;
            text-align:  center;
            line-height:  30px;
            cursor: pointer;
            transition: .4s;

        }

    </style>

</head>
<body>
    <?php require_once("main-nav.php") ?>
    <?php if (isset($_GET["id"])):?>
    <div id="layoutSidenav_content">
        <div class="container px-0">
            <main class="main px-5">
                <div class="container-fluid px-0">
                    <h1 class="mt-4"><?= $rowUser["name"] ?> 的訂單列表</h1>
                    <ol class="breadcrumb my-4 ">
                        <li class="breadcrumb-item"><a href="home.php">首頁</a></li>
                        <li class="breadcrumb-item"><a href="order-list.php">所有訂單</a></li>
                        <li class="breadcrumb-item active"><?= $rowUser["name"] ?>的訂單列表</li>
                    </ol>
                </div>



                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        <?= $rowUser["name"] ?> 的訂單列表
                    </div>
                    <div class="card-body">
                        <div class="py-2 d-flex justify-content-between">
                            <!--        <div>-->
                            <!--            共 --><? //=$orderCount?><!-- 筆-->
                            <!--        </div>-->
                            <form action="user-order.php" method="get">
                                <div class="d-flex align-items-center">
                                    <input type="hidden" name="id" value="<?= $id ?>">
                                    <!--                時間範圍-->
                                    <!--                <input type="date" class="form-control me-2" name="start"-->
                                    <!--                       value="-->
                                    <?php //if(isset($start))echo $start; ?><!--">-->
                                    <!--                <div class="me-2">~</div>-->
                                    <!--                <input type="date" class="form-control me-2" name="end"-->
                                    <!--                       value="--><?php //if(isset($end))echo $end; ?><!--">-->
                                    <!--                時間範圍end-->
                                    <!--                篩選-->
                                    <!--                <button type="submit" class="btn btn-primary text-nowrap">篩選</button>-->
                                    <!--                篩選end-->

                                </div>
                            </form>
                        </div>
                        <table id="datatablesSimple" class="table table-bordered table-sm">
                            <thead>
                            <tr>
                                <th>編號</th>
                                <th>訂購時間</th>
                                <th>狀態</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if ($orderCount > 0):
                                foreach ($rowOrderList as $value):
                                    ?>
                                    <tr>
                                        <td><a href="order-detail.php?id=<?= $value["id"] ?>"><b># <?= $value["id"] ?></b></a>
                                        </td>
                                        <td><?=$value["order_time"] ?></td>
                                        <td title="狀態代碼: ( <?= $value["status"] ?> )"><?=$statusTypes[$value["status"]]?></td>
                                    </tr>
                                <?php
                                endforeach;
                            else: ?>
                                <tr>
                                    <td colspan="12">尚未有訂單</td>
                                </tr>

                            <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
        </div>
        <?php require_once("JS.php") ?>
    </div>
</div>
<?php else:?>
<!--        <script>alert("請選擇要查看的會員")</script>-->


        <div id="showarea" style="visibility: visible">


            <div id="showBox">
                <div class="text">請先選擇會員，再檢視相關內容。</div>
                <div  onclick="openWindow()"  class="btn-secondary rounded closeBtn" title="前往會員管理中心~">好的</div>
            </div>
        </div>
        <div class="inline-block container text-center">
    <img src="https://cdn.dribbble.com/users/6620596/screenshots/14792345/media/af61fa935b055891cb800a9e41ebb747.gif" height="300px"  alt="">
            <img src="https://i.pinimg.com/originals/f3/c6/35/f3c6352193fef0bfc80744b7e71fd693.gif"   height="300px" alt="">
            <img src="https://i.pinimg.com/originals/24/b4/64/24b4648fb7e2fadb24ee392f35d09a64.gif"   height="300px" alt="">
            <img src="https://c.tenor.com/TjoYVFvlODoAAAAC/typing-type.gif"   height="300px" alt="">
            <img src="https://c.tenor.com/0rd4t7lbGi8AAAAC/dog-working.gif"   height="300px" alt="">
        </div>
        <script>


            $("#showArea").attr("style","visibility:visible");

            function openWindow() {
                window.open("http://localhost/pj_maobook/user-list.php","_self");

            }
        </script>
       <?php
    endif; ?>
</body>
</html>