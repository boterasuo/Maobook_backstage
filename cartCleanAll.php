<?php
if(isset($_GET["url"])){ //判斷路徑
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

