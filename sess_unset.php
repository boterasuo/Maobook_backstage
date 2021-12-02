<?php
session_start();
//解除登入錯誤狀態
unset($_SESSION["error_times"]);
unset($_SESSION["error_msg"]);

//正式上線時這個檔案要刪除，不然會被發現~