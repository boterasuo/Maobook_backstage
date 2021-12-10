
<nav class="sb-topnav navbar navbar-expand navbar-mao bg-main-cat ">
    <!-- Navbar 主圖示-->
    <div class="box-shift">
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0  sidebarToggle text-dark" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <a class="navbar-brand admin-logo ps-0" href="home.php" title="首頁"><img src="images/admin-logo.png" alt=""></a>
    </div>
    <!--  上層選單  -->
    <!-- Sidebar toggle 收拉式選單 -->


    <!-- nar-dropdown 01 下拉式選單-->
    <ul class="navbar-nav">
        <li class="nav-item dropdown nav-link text-secondary d-none d-lg-inline-block">
    </ul>

    <!-- Navbar Search-->
    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        <div class="input-group">

        </div>
    </form>
    <!-- Navbar 使用者選單(人像圖示)-->
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-muted start-0 " id="navbarDropdown" href="#" role="button"
               data-bs-toggle="dropdown"
               aria-expanded="false"><i class="fas fa-user fa-fw  "></i>使用者</a>
            <ul class="dropdown-menu dropdown-menu-end mt-2 " aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="#!">使用者設定</a></li>
                <li>
                    <hr class="dropdown-divider"/>
                </li>
                <li><a class="dropdown-item" href="fontawesome.php">FontAwesome</a></li>
                <li><a class="dropdown-item" href="empty-file.php">板模</a></li>
                <li>
                    <hr class="dropdown-divider"/>
                </li>
                <li><a class="dropdown-item" href="#!">說明文件</a></li>
                <li><a class="dropdown-item" href="#!">活動紀錄</a></li>
                <li>
                    <hr class="dropdown-divider"/>
                </li>
                <li><a class="dropdown-item" href="logOut.php">登出</a></li>
            </ul>
        </li>
    </ul>
</nav>
<!--使用者選單 end-->
<!--側欄-->
<div id="layoutSidenav" >
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-mao " id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav mt-3">
                    <a class="nav-link" href="home.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-home" title="home.php"></i></div>
                        首頁
                    </a>
                    <div class="sb-sidenav-menu-heading">電子商務</div>
                    <!--  第一層下拉式選單 訂單管理  -->
                    <a class="nav-link collapsed" href="#" target="_blank" data-bs-toggle="collapse"
                       data-bs-target="#tab1"
                       aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fas fa-scroll"></i></div>
                        訂單管理
                        <!--  arrow 箭頭  -->
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <!--  第二層下拉式選單 訂單管理  -->
                    <div class="collapse" id="tab1" aria-labelledby="headingOne"
                         data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="order-list.php"  title="oder-list.php">訂單查詢</a>
                            <a class="nav-link" href="lost-cart.php" title="lost-cart.php">新增訂單</a>

                        </nav>
                    </div>
                    <!--  第一層下拉式選單 訂單管理 end  -->
                    <!--  第一層下拉式選單 商品管理  -->
                    <a class="nav-link collapsed" href="#" target="_blank" data-bs-toggle="collapse"
                       data-bs-target="#tab2"
                       aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fas fa-box"></i></div>
                        商品管理
                        <!--  arrow 箭頭  -->
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <!--  第二層下拉式選單 商品管理  -->
                    <div class="collapse" id="tab2" aria-labelledby="headingOne"
                         data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="product_manage.php" title="product_manage.php">商品資料管理</a>
                            <a class="nav-link" href="product_add.php" title="product_add.php">新增商品</a>
<!--                    <a class="nav-link" href="product-inventory.php" title="product-inventory.php">庫存管理</a>-->
<!--                    <a class="nav-link" href="product-detail.php" title="product-detail.php">商品描述模板</a>-->
                            <a class="nav-link" href="product-category.php" title="product-category.php">分類管理</a>

                        </nav>
                    </div>
                    <!--  第一層下拉式選單 商品管理 end  -->
                    <!--  購物車  -->
                    <a class="nav-link" href="cart-product-list.php" tittle="cart-product-list.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-shopping-cart"></i></div>
                        購物車
                    </a>
                    <!--  購物車 end -->

                    <div class="sb-sidenav-menu-heading">用戶管理</div>
                    <!--  頁面鏈結 會員管理  -->
                    <a class="nav-link" href="user-list.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                        會員管理
                    </a>
                    <!--  頁面鏈結 會員管理 end -->
                    <!--  頁面鏈結 毛孩管理  -->
                    <a class="nav-link" href="pets-list.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
                        毛孩管理
                    </a>
                    <!--  頁面鏈結 毛孩管理 end -->
                    <!--  第一層下拉式選單 會員購買紀錄  -->
                    <a class="nav-link collapsed" href="#" target="_blank" data-bs-toggle="collapse"
                       data-bs-target="#Tab4"
                       aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fas fa-shopping-bag"></i></div>
                        會員購買紀錄
                        <!--  arrow 箭頭  -->
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <!--  第二層下拉式選單 01-2  -->
                    <div class="collapse" id="Tab4" aria-labelledby="headingOne"
                         data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="order-analysis.php" title="order-analysis.php">會員消費分析</a>
                            <a class="nav-link" href="user-order.php" title="user-order.php">會員個人消費紀錄</a>
                        </nav>
                    </div>
                    <!--  第一層下拉式選單 會員購買紀錄 end  -->
                    <!--  第一層下拉式選單 毛孩管理  -->
                    <a class="nav-link" href="user-social-log.php" title="user-social-log.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
                        會員社群紀錄
                    </a>
                    <!--  第一層下拉式選單 毛孩管理 end -->


        </nav>
    </div>
