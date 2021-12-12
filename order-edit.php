<?php
//require_once ("domain-pdo-connect.php");
require_once("pdo-connect.php");
if (isset($_GET["id"])):
    $id = $_GET["id"]; //order id
    $sqlOrder = "SELECT * FROM user_order WHERE id=? ";//從訂單抓資料
    $stmtOrder = $db_host->prepare($sqlOrder);
    try {
        $stmtOrder->execute([$id]);
        $rowOrder = $stmtOrder->fetch(); //訂單資料
        $rowOrders = $stmtOrder->fetchAll(); //訂單資料
        $rowOrderArr = array_column($rowOrders, "name", "id");
//echo $rowOrder["user_id"];

    } catch (PDOException $e) {
        echo "取得訂單資訊錯誤<br>";
        echo $e->getMessage();
    }
//    order
    $order_id = $id;
    $sqlOrderDetail = "SELECT * FROM order_detail WHERE order_id=? ";//從訂單抓資料
    $stmtOrderDetail = $db_host->prepare($sqlOrderDetail);
    try {
        $stmtOrderDetail->execute([$order_id]);
        $rowOrderDetails = $stmtOrderDetail->fetchAll(); //訂單資料
//        $rowOrderDetail = $stmtOrderDetail->fetch(); //訂單資料
        $rowOrderDetailArr = array_column($rowOrderDetails, "product_id", "order_id");


//        var_dump($rowOrderDetails);


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
        $statusTypeRow = $stmtStatusType->fetch(PDO::FETCH_ASSOC);
        $statusTypes = array_column($statusTypeRows, "order_id", "id");
    } catch (PDOException $e) {
        echo "預處理陳述式執行失敗！ <br/>";
        echo "Error: " . $e->getMessage() . "<br/>";
        $db_host = NULL;
        exit;
    }

// 抓取 users 會員資料表
    $id = $_GET["id"]; //user id
    $sqlUser = "SELECT * FROM users WHERE id=?";
    $stmtUser = $db_host->prepare($sqlUser);
    try {
        $stmtUser->execute([$id]);
        $rowUser = $stmtUser->fetch();//會員資料
    } catch (PDOException $e) {
        echo $e->getMessage();
    }


//選擇訂單總金額、產品名稱、產品價格、產品圖片從[order-detail]加入到[products]參考ON在order_detail.product_id = products.id
    $sql = "SELECT order_detail.id, order_detail.amount, order_detail.product_id, products.name, products.price, products.img FROM order_detail JOIN products ON order_detail.product_id = products.id
WHERE order_detail.order_id = ?";
    $stmt = $db_host->prepare($sql);
    try {
        $stmt->execute([$id]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
//        var_dump(count($rows));

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
session_start();
//var_dump($rowOrderList);
//echo $statusRows;
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

    <title>修改訂單(id: <?= $id ?>)</title>

    <!--  板模的css、BS5、fontawesome  -->
    <?php require_once("style.php"); ?>
    <!--  板模end  -->
    <!-- 此處新增css檔 -->
    <link rel="stylesheet" href="css/anun-style.css">
    <!-- Css檔 end   -->
    <style>
        #showarea2 {
            width: 100vw;
            height: 100vh;
            background: rgba(0, 0, 0, 0.678);
            z-index: 9999;
            visibility: hidden;
            position: fixed;
            top: 0;
            left: 0;
        }

        #showBox2 {
            width: 300px;
            max-height: 300px;
            background: white;
            border-radius: 10px;
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: end;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);

        }

        .text {
            font-weight: 600;
            margin-bottom: 15px;
        }

        /*訂購人資訊 頭像*/
        .avatar {
            width: 60px;
        }

    </style>


</head>
<body class="sb-nav-fixed">
<?php require_once("main-nav.php"); ?>
<!-- 主要內容 -->
<div id="layoutSidenav_content">
    <div class="container px-0">
        <main class="main px-5">
            <ol class="breadcrumb mb-2 mt-2">
                <li class="breadcrumb-item"><a href="home.php">首頁</a></li>
                <li class="breadcrumb-item "><a href="order-detail.php?id=<?= $id ?>">訂單管理</a></li>
                <li class="breadcrumb-item active">修改訂單</li>
            </ol>
            <h3 class="h2 mb-3 d-inline-block me-2">修改訂單</h3>
            <small class="text-muted me-2 d-inline-block" title="訂單編號：<?= $id ?>">( 訂單編號：<?= $id ?> )</small>
            <!--    本頁 內容    -->

            <!--   row    -->
            <div class="row ">
                <!-- 左側col -->
                <div class="col-8 d-inline-block ">
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between" title="訂單編號： <?= $id ?>">
                            <a class="text-muted"><i class="fas fa-table me-1 end-0"></i>
                                訂單內容</a>

                        </div>
                        <div class="card-body">
                            <!--    本頁 內容    -->
                            <form id="form-order-detail" action="order-detail-doUpdate.php" method="post"
                                  enctype="multipart/form-data">
                                <!--表格-->
                                <table class="table table-bordered table-sm"><!-- id="datatablesSimple" -->
                                    <thead>
                                    <tr>
                                        <th>產品名稱</th>
                                        <th width="40%">產品名稱</th>
                                        <th>單價</th>
                                        <th width="15%">數量</th>
                                        <th>小計</th>
                                        <th>刪除</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $total = 0;
                                    $orderDetailsCount = count($rows);
                                    $_SESSION["orderDetailsCount"] = $orderDetailsCount;
                                    for ($i = 0; $i < count($rows); $i++): ?>
                                        <tr>
                                            <td>
                                                <a href="http://localhost/pj_maobook/cart-product-detial.php?name=
                                                <?= $rows[$i]["name"] ?>"
                                                   title="<?= $rows[$i]["name"] ?>">
                                                    <img src="images/product_images/<?= $rows[$i]["img"] ?>" alt=""
                                                         width="100px"></a>
                                            </td><!-- 商品圖片 -->
                                            <td><?= $rows[$i]["name"] ?></td> <!-- 商品名稱 -->
                                            <input type="hidden" name="price" value="<?= $rows[$i]["img"] ?>">

                                            <td class="text-end"><?= $rows[$i]["price"] ?>
                                                <input type="hidden" name="price" value="<?= $rows[$i]["price"] ?>">
                                            </td>
                                            <td class="text-center"><input name="amount<?= $i ?>" type="number"
                                                                           class="= my-0 col-5"
                                                                           value="<?= $rows[$i]["amount"] ?>">
                                            </td>
                                            <td class="text-end">
                                                <?php
                                                $subtotal = $rows[$i]["amount"] * $rows[$i]["price"];
                                                echo $subtotal;
                                                //                            $total=$total+$subtotal;
                                                $total += $subtotal;

                                                ?>
                                                <!-- 小計 -->
                                                <input type="hidden" name value="<?= $subtotal ?>">
                                            </td>
                                            <!-- 刪除按鈕-->
                                            <td class="text-center">
                                                <a href="order-detail-event-doDelete.php?
                                                        order_id=<?=$id?>&
                                                        order_detail_id=<?=$rows[$i]["id"]?>"
                                                   onClick="return checkDel()">
                                                    <i class="fas fa-trash-alt"></i></a></td>
                                        </tr>
                                        <!-- POST-->
                                        <!-- 1.product_id 商品編號-->
                                        <!--                                        <td><input type="hidden" name="product_id" value="-->
                                        <!--                                        --><? //= $rows[$i]["product_id"] ?><!--">-->
                                        <!--                                        </td>-->
                                        <!-- 2.訂單細節編號 -->
                                        <td>
                                            <input type="hidden" name="order_detail_id<?= $i ?>" value="
                                            <?= $rows[$i]["id"] ?>">
                                        </td>
                                        <!-- 3.user_id 訂購人ID -->
                                        <!--                                        <td>-->
                                        <!--                                            <input type="hidden" name="order_id" value="-->
                                        <!--                                            --><? //= $rowOrder["user_id"] ?><!--">-->
                                        <!--                                        </td>-->
                                        <!--4.order_detail.order_id = user_order.id-->
                                        <td><input type="hidden" name="id" value="<?= $id ?>"></td>
                                    <?php endfor; ?>

                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <td class="text-end h3 bg-mao-primary" colspan="12">總計: <?= $total ?></td>
                                    </tr>
                                    </tfoot>
                                </table>
                                <!--表格end-->

                                <div class="text-end">
                                    <a href="order-detail.php?id=<?= $rowOrder["user_id"] ?>" onClick="return checkLeave()" class="btn btn-secondary">放棄修改</a>
                                    <button id="submitBtn" onClick="return checkSave()" href="order-detail-doUpdate.php" class="btn btn-warning"
                                            type="submit">儲存
                                    </button>
                                </div>
                        </div>
                        </form>
                    </div>
                </div>
                <!-- 左側col end -->


                <!-- 右側col -->
                <div class="col-4  d-inline-block">
                    <!--  user_order修改   -->
                    <div>
                        <form id="form-user-order" action="order-status-doUpdate.php" method="post"
                              enctype="multipart/form-data">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between">
                                    <a><i class="fas fa-link me-1 end-0"></i>訂單狀態 (<?= $statusRow["name"] ?>)</a>
                                </div>
                                <div class="card-body mb-2">

                                    <!--1.訂單編號ID-->
                                    <input type="hidden" name="id" value="<?= $id ?>">
                                    <!-- 2.userID -->
                                    <input type="hidden" name="user_id" value="<?= $rowOrder["user_id"] ?>">
                                    <!--訂單狀態-->
                                    <div class="form-group row mb-1 ">
                                        <label for="status" class="col-3">訂單狀態 </label>
                                        <div class="col-8">
                                            <!-- 3.status-->
                                            <select name="status" id="status" class="align-bottom"
                                                    form="form-user-order">
                                                <option class="text-muted" value='<?= $statusRow["status"]; ?>'
                                                ><?= $statusRow["name"] ?></option>
                                                <option value="1">訂單成立</option>
                                                <option value="2">已結帳</option>
                                                <option value="3">已出貨</option>
                                                <option value="4">已領貨</option>
                                                <!--                                                <option value="5">已取消</option>-->
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-1">
                                        <label for="order_time" class="col-3">建立時間</label>
                                        <div class="col-9">

                                            <input id="order_time" type="text" readonly class="form-control" title=""
                                                   value='<?= date($rowOrder["order_time"]) ?>'>
                                            <!-- 4.order_time-->
                                            <input type="hidden" name="order_time" value="<?= date('Y-m-d H:i:s') ?>">
                                        </div>
                                    </div>
                                    <div class="text-end">
                                        <button id="statusSubmitBtn" class="btn mt-2 text-end btn-info" type="submit">
                                            儲存
                                        </button>
                                        <?php if ($statusRow["status"] != 5): ?>
                                            <div id="showBtn2" class="d-inline-block cursor-pointer">
                                                <a href="#" class="btn mt-2 text-end btn btn-secondary">
                                                    取消訂單
                                                </a>
                                            </div>
                                        <?php elseif ($statusRow["status"] == 5): ?>
                                            <div id="showBtn2" class="d-inline-block cursor-pointer">
                                                <a href="#" class="btn mt-2 text-end btn btn-danger">
                                                    刪除訂單
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                        </form>
                    </div>
                </div>
                <!--訂單狀態end-->
                <br>
                <!--  user_order  end  -->
                <!--  客戶資訊   -->
                <div>
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <a><i class="fas fa-user-edit me-1 end-0"></i>買家資訊</a>
                            <!--                            <a href="user-edit.php?id=-->
                            <? //= $rowOrder["user_id"] ?><!--">-->
                            <!--                                <i class="fas fa-edit me-1 end-0 text-muted" title="編輯會員資料"></i>-->
                            <!--                            </a>-->
                        </div>
                        <div class="card-body ">
                            <!--頭貼-->
                            <?php if ($rowUser != NULL): ?>
                                <a href="user.php?id=<?= $rowOrder["user_id"] ?>" title="檢視買家">
                                    <img class="avatar rounded-circle float-start me-2"
                                         href="user.php?id=<?= $rowOrder["user_id"] ?>"
                                         src="images/<?= $rowUser["image"] ?>" alt=""></a>
                            <?php else: ?>
                                <a href="user.php?id=<?= $rowOrder["user_id"] ?>" title="檢視買家">
                                    <img class="avatar rounded-circle float-start me-2"

                                         src="images/default_avatar.png"
                                         alt=""></a>
                            <?php endif; ?>
                            訂購人: <a href="user.php?id=<?= $rowOrder["user_id"] ?>">
                                <?= $orderUserRow["name"] ?>
                            </a>
                            <p><?php if ($rowUser != NULL): ?>
                                    <?= $rowUser["mailing_email"] ?><?php else:{
                                } endif; ?></p>
                            <br>
                        </div>
                    </div>
                    <!--  客戶資訊  end  -->
                    <br>
                    <!--  宅配地址   -->
                    <div>
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <a><i class="fas fa-truck me-1 end-0"></i>宅配資訊</a>
                                <!--                                <a href="user-edit.php?id=--><? //= $id ?><!--">-->
                                <!--                                    <i class="fas fa-edit me-1 end-0 text-muted"></i>-->
                                <!--                                </a>-->
                            </div>
                            <div class="card-body ">
                                <p>
                                    <?php if ($rowUser != NULL): ?>
                                    收件人:　<?= $rowUser["mailing_name"] ?><br>
                                    地址：　<?= $rowUser["mailing_address"] ?><br>
                                    手機：　<?= $rowUser["mailing_phone"] ?><br>
                                    信箱：　<?= $rowUser["mailing_email"] ?></p>
                                <?php else:{
                                    echo "未登錄資訊";
                                }
                                endif; ?>
                            </div>
                        </div>
                        <!--  宅配地址  end  -->
                        <!-- 右側col end -->
                    </div>
                    <!--   本頁內容 end  -->
                </div>
            </div>
            <?php if ($statusRow["status"] != 5): ?>
                <!--取消訂單-->
                <div id="showarea2">
                    <div id="showBox2">
                        <div class="text">確認取消該筆訂單?</div>
                        <div>
                            <a href="order-doCancel.php?id=<?= $statusRow["id"] ?>"
                               class=" btn btn-success d-inline-flex">確定</a>
                            <a id="closeBtn2"
                               class="btn btn-secondary d-inline-flex ">取消</a>
                        </div>
                    </div>
                </div>
                <!--取消訂單 end-->
            <?php elseif ($statusRow["status"] == 5): ?>
                <!--刪除訂單-->
                <div id="showarea2">
                    <div id="showBox2">
                        <div class="text">確認刪除該筆訂單?<br>此操作將
                            <mark>無法恢復</mark>
                            已刪除資料。
                        </div>
                        <div>
                            <a href="order-doDelete.php?id=<?= $statusRow["id"] ?>"
                               class=" btn btn-danger d-inline-flex">確定</a>
                            <a id="closeBtn2"
                               class="btn btn-secondary d-inline-flex ">取消</a>
                        </div>
                    </div>
                </div>
                <!--刪除訂單 end-->
            <?php endif; ?>
            <!--   本頁內容 end  -->
        </main><!-- 主要內容end -->

    </div>
    <!--    --><?php //require_once("footer.php");
    ?>
</div>
<?php require_once("JS.php"); ?>
<script>
    // function checkCancel() {
    //     if (!confirm('確認取消該筆訂單嗎 ?')) {
    //         return false;
    //     }
    // }
    let showbtn = document.querySelector("#showBtn2");
    let closebtn = document.querySelector("#closeBtn2");
    var Box = document.querySelector('#showarea2');
    showbtn.onclick = function () {
        Box.style.visibility = "visible";
    }
    closebtn.onclick = function () {
        Box.style.visibility = "hidden";
    }

    function checkDel(){
        if(!confirm('確認刪除該項產品?')){
            return false;
        }
    }
    function checkLeave(){
        if(!confirm('放棄所有變更?')){
            return false;
        }
    }
    function checkSave() {
        if (!confirm('確定儲存變更 ?')) {
            return false;
        }
    }
</script>


</body>
</html>
