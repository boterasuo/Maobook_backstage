<?php
if(isset($_GET["url"])){ //取得當前路徑，?之前，後端執行完要導回網頁，用這種寫法是因為有其他頁也需要此功能，可共用
    $a=$_GET["url"];
    if(strstr($a,'?',true)==true) { //取得?前字串
        $url = strstr($a, '?', true);
    }else{ //若沒?直接存入
        $url= $a;
    }
    echo $url;
}else{
    $url=0;
}
//刪除執行
session_start();
ob_start();//清空緩存必須啓動的項
if(isset($_SESSION['cart'])) {
    unset($_SESSION['cart']);
    header("location:$url");
}else
$cartCount = 0;
header("location:$url");

