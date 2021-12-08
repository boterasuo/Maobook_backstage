<?php
session_start();
ob_start();//清空緩存必須啓動的項
if(isset($_SESSION['cart'])) {
    unset($_SESSION['cart']);
    header("location:cart-shipping.php");
}else
$cartCount = 0;
header("location:cart-shipping.php");
?>
