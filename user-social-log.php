<?php
require_once("pdo-connect.php");//連線資料庫;
if(isset($_GET["id"])){
    $id=$_GET["id"];
}else{
    $id=0;
}

$sql = "SELECT * FROM social_forum WHERE valid=1";



//4.
//$sql_Category = "SELECT * FROM forum_category";
//$stmt_Category = $db_host->prepare($sql_Category);
//try {
//    $stmt_Category->execute();
//    $catTypeRows = $stmt_Category->fetchAll(PDO::FETCH_ASSOC);
//    $catTypes = array_column($catTypeRows, "name", "id");
//} catch (PDOException $e) {
//    echo "預處理陳述式執行失敗！ <br/>";
//    echo "Error: " . $e->getMessage() . "<br/>";
//    $db_host = NULL;
//    exit;
//}


// 連接users資料
//$id = $_GET["id"]; //user id
$sqlUser = "SELECT * FROM users ";
$stmtUser = $db_host->prepare($sqlUser);
try {
    $stmtUser->execute();
    $rowUser = $stmtUser->fetch();
} catch (PDOException $e) {
    echo $e->getMessage();
}

//抓取 social_forum
//$sqlSocialList = "SELECT * FROM social_forum WHERE valid=1";
//$stmtSocialList = $db_host->prepare($sqlSocialList);
//try {
//    $stmtSocialList->execute();
//    $rowSocialLists = $stmtSocialList->fetchAll(PDO::FETCH_ASSOC);
//    $socialCount = $stmtSocialList->rowCount();
//
//} catch (PDOException $e) {
//    echo $e->getMessage();
//}



//關聯式陣列
//1. 上課版本
// 連結category id->name
//$sqlCategory="SELECT * FROM forum_category";
//$resultCategory=$conn->query($sqlCategory);
////["1"=> "marvel", "2"=>"DC Comics"];
//$categoryArr=[];
//while($row=$resultCategory->fetch_assoc()){
//    $categoryArr[$row["id"]]=$row["name"];
//}


//2.
//$sql_Category="SELECT * FROM forum_category";
//$stmt_Category=$db_host->prepare($sql_Category);
//$stmt_Category->execute();
//$rows = $stmt_Category->fetchAll(PDO::FETCH_ASSOC);
//
//$article_cat=array_column($rows, 'name', 'id');



//3.
//$sql_Category="SELECT * FROM forum_category";
//$stmt_Category=$db_host->prepare($sql_Category);
//$stmt_Category->execute();
//$categoryArr=[];
//while ($row_Category=$stmt_Category->fetch()){
//    $categoryArr[$row_Category["id"]]=$row_Category["name"];
//}



//抓user_id的名稱
//$sql = "SELECT  social_forum.user_id, social_forum.id, users.name FROM  users JOIN social_forum ON social_forum.user_id = users.id";
//$stmtSocialUser = $db_host->prepare($sql);
//try {
//    $stmtSocialUser->execute();
//    $socialUserRows = $stmtSocialUser->fetchAll(PDO::FETCH_ASSOC);
//    $socailName = array_column($socialUserRows, "name", "user_id");
//
//} catch (PDOException $e) {
//    echo "取得訂單細節錯誤<br>";
//    echo $e->getMessage();
//}



$result = $conn->query($sql);
$articleCount = $result->num_rows;


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

    <title><?=$rowUser["name"]?>的社群紀錄</title>

    <?php require_once("style.php"); ?>

</head>
<body class="sb-nav-fixed">
<?php require_once("main-nav.php"); ?>

<!-- 主要內容 -->
<div id="layoutSidenav_content">


    <div class="container px-0">
        <main class="main px-5">
            <div class="container-fluid px-4">
                <h1 class="mt-4"><?=$rowUser["name"]?>的社群紀錄</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="home.php">首頁</a></li>
                    <li class="breadcrumb-item active"><a href="user.php?id=1"><?=$rowUser["name"]?></a>的文章列表</li>
                </ol>


                <!-- 副標題 end -->
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        社群文章列表
                    </div>

                    <!-- 表格區塊 -->
                    <div class="card-body">
                        <div>
                            <a class="btn btn-primary" href="user-social-insert.php">新增文章</a>
                        </div>

                        <table id="datatablesSimple">
                            <!-- 標題欄 -->
                            <thead>
                            <tr>
                                <!-- 表格註腳 thead -->
<!--                                <th>id</th>-->
                                <th>標題</th>
                                <th>內容</th>
                                <th>類別</th>
                                <th>建立時間</th>
                                <th>編輯</th>
                                <th>刪除</th>
                            </tr>
                            </thead>


                            <!-- 資料欄 tbody -->
                            <tbody>
                            <?php if($articleCount>0 ):
                                while ($row = $result->fetch_assoc()): //關聯式陣列
                                    ?>


                                    <tr>
<!--                                        <td>--><?//=$row["id"]?><!--</td>-->
                                        <td><?=$row["title"]?></td>
                                        <td><?=$row["content"]?></td>
                                        <td><?=$row["category"]?></td>
<!--                                        <td title='文章類別:  --><?//= $value["category"] ?><!-- '>-->
<!--                                            <a class="">--><?//= $catTypes[$value["category"]] ?><!--</a>-->
<!--                                        </td>-->
                                        <td><?=$row["created_at"]?></td>


                                        <td><!--編輯 -->
                                            <a class="btn btn-mao-primary "
                                               href="user-social-edit.php?id=<?=$row["id"] ?>">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </td>
                                        <td><!--刪除 -->
                                            <a class="btn btn-mao-primary "
                                               href="social-doDelete.php?id=<?=$row["id"]?>">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
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
    <?php require_once("footer.php"); ?>
</div>
</div>
<?php require_once("JS.php"); ?>
</body>
</html>
