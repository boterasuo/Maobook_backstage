<?php
require_once("db-connect.php");//連線資料庫;
if(isset($_GET["id"])){
    $id=$_GET["id"];
}else{
    $id=0;
}

$sql = "SELECT * FROM social_forum WHERE valid=1";


//關聯式資料庫 連結forum_category 和 social_forum/category
$sqlCategory="SELECT * FROM forum_category";
$resultCategory=$conn->query($sqlCategory);
//["1"=> "marvel", "2"=>"DC Comics"];
$categoryArr=[];
while($row=$resultCategory->fetch_assoc()){
    $categoryArr[$row["id"]]=$row["name"];
}


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

    <title><?=$rowUser["name"]?> 貓貓的社群紀錄</title>

    <?php require_once("style.php"); ?>

</head>
<body class="sb-nav-fixed">
<?php require_once("main-nav.php"); ?>

<!-- 主要內容 -->
<div id="layoutSidenav_content">


    <div class="container px-0">
        <main class="main px-5">
            <div class="container-fluid px-4">
                <h1 class="mt-4"><?=$rowUser["name"]?> 貓貓的社群紀錄</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="home.php">首頁</a></li>
                    <li class="breadcrumb-item active">文章列表</li>
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
                                <th>id</th>
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
                                        <td><?=$row["id"]?></td>
                                        <td><?=$row["title"]?></td>
                                        <td><?=$row["content"]?></td>
                                        <td><?=$row["category"]?></td>
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
