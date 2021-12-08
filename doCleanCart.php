<?php
session_start();
ob_start();//清空緩存必須啓動的項
$_SESSION['cart'] = array();
header("location:cart-shipping.php");
