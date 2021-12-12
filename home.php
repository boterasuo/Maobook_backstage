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
    <style>
        .home-page-img{
            width: 480px;
            margin: 0 auto;

        }
        .home-page-img img{
            width: 100%;

        }
    </style>

</head>
<body class="sb-nav-fixed">
<?php require_once("main-nav.php"); ?>
<!-- 主要內容 -->
<div id="layoutSidenav_content">
    <div class="container px-0">
        <main class="main px-5">
            <div class="container-fluid px-4">
<!--                <h1 class="mt-4">Welcome!</h1>-->
<!--                <ol class="breadcrumb mb-4">-->
<!--                    <li class="breadcrumb-item active">首頁</li>-->
<!--                </ol>-->

            <!-- 副標題 end -->
            <div class="home-page-img">
                <img src="images/maobook%20logo.png" alt="爪爪日記">
            </div>

        </main><!-- 主要內容end -->

    </div>
<!--    --><?php //require_once("footer.php"); ?>
<!--</div>-->
</div>
<?php require_once("JS.php"); ?>
</body>
</html>
