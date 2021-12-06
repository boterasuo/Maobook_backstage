<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="Description" content="MaoBook小組專題報告"/>
    <meta name="Content-Language" content="zh-TW">
    <meta name="author" content="Team MaoLife"/>
    <link rel="apple-touch-icon" type="image/png" href="images/logo-nbg.png"/>
    <link rel="shortcut icon" type="image/png" href="images/logo-nbg.png" />
    <link rel="mask-icon" type="image/png" href="images/logo-nbg.png"/>

    <title>麵包屑</title>

    <!--CSS-->
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet"/>
    <link href="css/styles.css" rel="stylesheet"/>
    <link href="css/mao-style.css" rel="stylesheet">

    <!--fontawesome-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"
            crossorigin="anonymous"></script>
</head>
<body class="sb-nav-fixed">
<nav class="sb-topnav navbar navbar-expand navbar-dark bg-mao-primary">
    <!-- Navbar 主圖示-->
    <a class="navbar-brand admin-logo ps-3" href="home.php" title="管理平台"><img src="mao-logo.png" alt=""></a>
    <!--  上層選單  -->
    <!-- Sidebar toggle 收拉式選單 -->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0 text-secondary" id="sidebarToggle" href="#!"><i
                class="fas fa-bars"></i></button>

    <a class="nav-link disabled text-secondary text-decoration-none  d-none d-xl-inline-flex">板模(使用請另存新檔)</a>
    <!-- nar-dropdown 01 下拉式選單-->
    <ul class="navbar-nav">
        <li class="nav-item dropdown nav-link text-secondary d-none d-lg-inline-block">
            <a class="nav-link dropdown-toggle text-secondary" href="#" id="navbarDropdownMenuLink" role="button"
               data-bs-toggle="dropdown" aria-expanded="false">
                用戶管理
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <li><a class="dropdown-item" href="#">會員列表</a></li>
                <li><a class="dropdown-item" href="#">成就系統</a></li>
                <li><a class="dropdown-item" href="#">毛孩管理</a></li>
            </ul>
        </li>
        <!-- nar-dropdown li 01 end -->
        <!-- nar-dropdown 02 -->
        <li class="nav-item dropdown nav-link text-secondary d-none d-lg-inline-block">
            <a class="nav-link dropdown-toggle text-secondary" href="#" id="navbarDropdownMenuLink" role="button"
               data-bs-toggle="dropdown" aria-expanded="false">
                商品管理
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <li><a class="dropdown-item" href="#">商品列表</a></li>
                <li><a class="dropdown-item" href="#">消費紀錄</a></li>
                <li><a class="dropdown-item" href="#">訂單管理</a></li>
                <li><a class="dropdown-item" href="#">購物車紀錄</a></li>
                <li><a class="dropdown-item" href="#">優惠方案</a></li>
            </ul>
        </li>

        <!-- nar-dropdown li 02 end -->
        <!-- nar-dropdown 03 -->
        <li class="nav-item dropdown nav-link text-secondary d-none d-lg-inline-block">
            <a class="nav-link dropdown-toggle text-secondary" href="#" id="navbarDropdownMenuLink" role="button"
               data-bs-toggle="dropdown" aria-expanded="false">
                成就系統
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <li><a class="dropdown-item" href="#">會員積分管理</a></li>
                <li><a class="dropdown-item" href="#">大富翁系統進度</a></li>
            </ul>
        </li>
        <!-- nar-dropdown li 03 end -->
        <!-- nar-dropdown 03 -->
        <li class="nav-item dropdown nav-link text-secondary d-none d-lg-inline-block">
            <a class="nav-link dropdown-toggle text-secondary" href="#" id="navbarDropdownMenuLink" role="button"
               data-bs-toggle="dropdown" aria-expanded="false">
                社群管理
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <li><a class="dropdown-item" href="#">討論板發文管理</a></li>
                <li><a class="dropdown-item" href="#">留言區列表</a></li>
                <li><a class="dropdown-item" href="#">接案訂單列表</a></li>
            </ul>
        </li>
        <!-- nar-dropdown li 03 end -->
    </ul>

    </div>
    </div>
    <!-- Navbar Search-->
    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        <div class="input-group">
            <input class="form-control bg-search-admin" type="text" placeholder="Search for..." aria-label="Search for..."
                   aria-describedby="btnNavbarSearch"/>
            <button class="btn btn-mao-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search text-dark"></i></button>
        </div>
    </form>
    <!-- Navbar-->
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-muted" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
               aria-expanded="false"><i class="fas fa-user fa-fw  "></i></a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="#!">設定</a></li>
                <li><a class="dropdown-item" href="#!">活動紀錄</a></li>
                <li>
                    <hr class="dropdown-divider"/>
                </li>
                <li><a class="dropdown-item" href="#!">登出</a></li>
            </ul>
        </li>
    </ul>
</nav>
<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">首頁</div>
                    <a class="nav-link" href="home.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        儀錶板 dashboard
                    </a>
                    <a class="nav-link" href="empty-file.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-folder-plus"></i></div>
                        板模
                    </a>

                    <!-- 側欄標題 01 -->
                    <h2 class="sb-sidenav-menu-heading">分類</h2>
                    <!--  第一層下拉式選單 01  -->
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts"
                       aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                        下拉式選單-第一層
                        <!--  arrow 箭頭  -->
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <!--  第二層下拉式選單 01-1  -->
                    <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne"
                         data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" target="_parent" href="layout-static.php">下拉式選單-第二層</a>
                            <a class="nav-link" href="layout-static.php">成就系統數據</a>
                            <a class="nav-link" href="layout-sidenav-light.php">白模式側欄</a>
                        </nav>
                    </div>
                    <!--  第一層下拉式選單 01-2  -->
                    <a class="nav-link collapsed" href="#" target="_blank" data-bs-toggle="collapse" data-bs-target="#collapseLayouts"
                       aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                        毛小孩管理
                        <!--  arrow 箭頭  -->
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <!--  第二層下拉式選單 01-2  -->
                    <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne"
                         data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="layout-static.php">毛孩資料</a>
                            <a class="nav-link" href="layout-static.php">毛孩統計數據</a>

                        </nav>
                    </div>



                    <!--  footer  -->
                    <div class="sb-sidenav-footer position-absolute bottom-0  col-12">
                        <div class="">
                            <a class="nav-link bg-mao-secondary" href="fontawesome.php" target="_blank">
                                <i class="fas fa-table sb-nav-link-icon"></i>
                                fontawesome
                            </a>
                        </div>
                        <div class="sb-sidenav-footer">
                            <div class="small">現在使用者：&ensp;&ensp; &ensp; 加菲貓</div>
                        </div>


                        <!--                        --><? //$row["user"]?>
                    </div>
        </nav>
    </div>
    <!-- 主要內容 -->
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">內容標題</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="home.php">Dashboard</a></li>
                    <li class="breadcrumb-item active">內容標題</li>
                </ol>
                <div class="card mb-4">
                    <div class="card-body">
                        <p class="mb-0">
                            此頁面是使用靜態導航的示例。通過從 中刪除 <code>.sb-nav-fixed</code> 該類  <code>body</code>，頂部導航和側邊導航將在滾動時變為靜態。向下滾動此頁面以查看示例。
                        </p>
                    </div>
                </div>

            </div>
    </div>
</div>
</main><!-- 主要內容end -->

<!--註腳-->
<footer class="py-4 bg-light mt-auto">
    <div class="container-fluid px-4">
        <div class="d-flex align-items-center justify-content-between small">
            <div class="text-muted">毛Book &copy; It's mao life!</div>
            <div>
                <a href="#">隱私政策</a>
                &middot;
                <a href="#">使用條款</a>
            </div>
        </div>
    </div>
</footer><!--註腳end-->
</div>
</div>
<!--JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
<script src="js/scripts.js"></script>
<!--圖表-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<!--面積圖-->
<script src="assets/demo/chart-area-demo.js"></script>
<!--長條圖-->
<script src="assets/demo/chart-bar-demo.js"></script>

<!--table 表格-->
<script src="assets/demo/datatables-demo.js"></script>
<script src="js/datatables-jQuery.js"></script>
<!--<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>-->
<script src="js/datatables-simple-demo.js"></script>
</body>
</html>
