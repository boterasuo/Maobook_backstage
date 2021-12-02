<?php
require_once ("pdo-connect.php");

?>
<nav class="sb-topnav navbar navbar-expand navbar-dark bg-mao-primary ">
    <!-- Navbar 主圖示-->
    <a class="navbar-brand admin-logo ps-3" href="index.php" title="管理平台"><img src="mao-logo.png" alt=""></a>
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
        <!-- nar-dropdown 04 -->
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
        <!-- nar-dropdown li 05 end -->
        <!-- nar-dropdown 05 -->
        <li class="nav-item dropdown nav-link text-secondary d-none d-lg-inline-block">
            <a class="nav-link dropdown-toggle text-secondary" href="#" id="navbarDropdownMenuLink" role="button"
               data-bs-toggle="dropdown" aria-expanded="false">
                其他頁面
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <li><a class="dropdown-item" href="/mao_life/mao-life-project-admin/login.php" target="_blank">登入</a></li>
                <li><a class="dropdown-item" href="/mao_life/mao-life-project-admin/register.php" target="_blank">註冊</a></li>
                <li><a class="dropdown-item" href="/mao_life/mao-life-project-admin/auth-error.php" target="_blank">auth error</a></li>

                <li><a class="dropdown-item" href="/mao_life/mao-life-project-admin/401.html" target="_blank">401</a></li>
                <li><a class="dropdown-item" href="/mao_life/mao-life-project-admin/404.html" target="_blank">404</a></li>
                <li><a class="dropdown-item" href="/mao_life/mao-life-project-admin/500.html" target="_blank">500</a></li>

            </ul>
        </li>
        <!-- nar-dropdown li 05 end -->
    </ul>

    </div>
    </div>
    <!-- Navbar Search-->
    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        <div class="input-group">
            <input class="form-control bg-search-admin" type="text" placeholder="Search for..."
                   aria-label="Search for..."
                   aria-describedby="btnNavbarSearch"/>
            <button class="btn btn-mao-primary" id="btnNavbarSearch" type="button"><i
                    class="fas fa-search text-dark"></i></button>
        </div>
    </form>
    <!-- Navbar 使用者操作(人像圖示)-->
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-muted" id="navbarDropdown" href="#" role="button"
               data-bs-toggle="dropdown"
               aria-expanded="false"><i class="fas fa-user fa-fw  "></i>使用者</a>
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
                    <a class="nav-link" href="index.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        儀錶板 dashboard
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
                    <a class="nav-link collapsed" href="#" target="_blank" data-bs-toggle="collapse"
                       data-bs-target="#collapseLayouts2"
                       aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                        毛小孩管理
                        <!--  arrow 箭頭  -->
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <!--  第二層下拉式選單 01-2  -->
                    <div class="collapse" id="collapseLayouts2" aria-labelledby="headingOne"
                         data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="layout-static.php">毛孩資料</a>
                            <a class="nav-link" href="layout-static.php">毛孩統計數據</a>

                        </nav>
                    </div>
                    <!--  side-nav-footer  側欄選單-->
                    <div class="sb-sidenav-footer position-absolute bottom-0  col-12">
                        <div class="">
                            <a class="nav-link bg-mao-secondary" href="fontawesome.php" target="_blank">
                                <i class="fas fa-table sb-nav-link-icon"></i>
                                fontawesome
                            </a>
                        </div>
                        <div class="">
                            <a class="nav-link mt-1 bg-mao-secondary" href="empty-file.php" target="_blank">
                                <i class="fas fa-table sb-nav-link-icon"></i>
                                板模
                            </a>
                        </div>
                        <!-- 社群 icon -->
                        <div class="Text-muted text-center">
                            <a class="nav-link  d-inline-block " target="_blank" href="#"><i class="fab fa-facebook"></i></a>
                            <a class="nav-link  d-inline-block" target="_blank" href="#"><i class="fab fa-github "></i></a>
                            <a class="nav-link  d-inline-block" target="_blank" href="#"><i class="fab fa-apple"></i></a>

                        </div>


        </nav>
    </div>