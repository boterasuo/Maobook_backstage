<?php
session_start();
if (isset($_GET["id"])) {
    $id = $_GET["id"];
} else {
    $id = 0;
}

ob_start();//清空緩存必須啓動的項
unset($_SESSION["cart"][$id]);
header("location:cart-shipping.php");