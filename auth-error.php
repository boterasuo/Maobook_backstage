<!--  登入&錯誤頁面    -->
<a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages"
   aria-expanded="false" aria-controls="collapsePages">
    <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
    登入&錯誤頁面
    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
</a>
<div class="collapse" id="collapsePages" aria-labelledby="headingTwo"
     data-bs-parent="#sidenavAccordion">
    <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
           data-bs-target="#pagesCollapseAuth" aria-expanded="false"
           aria-controls="pagesCollapseAuth">
            驗證欄位 Authentication
            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
        </a>
        <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne"
             data-bs-parent="#sidenavAccordionPages">
            <nav class="sb-sidenav-menu-nested nav">
                <a class="nav-link" href="login.php">Login</a>
                <a class="nav-link" href="register.php">Register</a>
                <a class="nav-link" href="password.php">Forgot Password</a>
            </nav>
        </div>
        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
           data-bs-target="#pagesCollapseError" aria-expanded="false"
           aria-controls="pagesCollapseError">
            錯誤頁面 Error
            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
        </a>
        <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne"
             data-bs-parent="#sidenavAccordionPages">
            <nav class="sb-sidenav-menu-nested nav">
                <a class="nav-link" href="401.html">401 Page</a>
                <a class="nav-link" href="404.html">404 Page</a>
                <a class="nav-link" href="500.html">500 Page</a>
            </nav>
        </div>
    </nav>
</div>


<!-- 側欄標題 02 -->
<h2 class="sb-sidenav-menu-heading">毛孩管理</h2>
<!--  第一層下拉式選單 02  -->
<a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts"
   aria-expanded="false" aria-controls="collapseLayouts">
    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
    會員資料管理
    <!--  arrow 箭頭  -->
    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
</a>
<!--  第二層下拉式選單 02  -->
<div class="collapse" id="collapseLayouts" aria-labelledby="headingOne"
     data-bs-parent="#sidenavAccordion">
    <nav class="sb-sidenav-menu-nested nav">
        <a class="nav-link" href="layout-static.php">用戶登錄資料</a>
        <a class="nav-link" href="layout-static.php">成就系統數據</a>
        <a class="nav-link" href="layout-static.php">毛孩資料</a>
        <a class="nav-link" href="layout-sidenav-light.php">白模式側欄</a>
    </nav>
</div>

<?php
