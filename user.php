<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
if(isset($_GET["id"])){
    $id=$_GET["id"];
}else{
    $id=0;
}
require_once ("domain-pdo-connect.php");
global $conn;
$sql="SELECT * FROM users WHERE id='$id' AND valid=1";
$result = $conn->query($sql);
$userExist=$result->num_rows;



?>

<!doctype html>
<html lang="en">
<head>
    <title>用戶資料</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <?php require_once ("style.php");?>
</head>
<body>
<?php require_once ("main-nav.php");?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8 ">
            <div class="py-2 ">
                <a href="user-list.php" class="btn btn-mao-primary"><i class="fas fa-angle-left arrow-action"></i>&ensp;回列表</a>
            </div>


            <?php if($userExist===0): ?>
                使用者不存在
            <?php else:
                $row=$result->fetch_assoc();
//                var_dump($row);
                ?>
                <table class="table table-bordered table-sm ">
                    <tr>
                        <th>id</th>
                        <td><?=$row["id"]?></td>
                    </tr>
                    <tr>
                        <th>帳號</th>
                        <td><?=$row["account"]?></td>
                    </tr>
                    <tr>
                        <th>名稱</th>
                        <td><?=$row["name"]?></td>
                    </tr>
                    <tr>
                        <th>建立時間</th>
                        <td><?=$row["created_at"]?></td>
                    </tr>
                </table>
            <?php endif; ?>
            <!--註腳-->
<!--            --><?php //require_once ("footer.php");?>

        </div>

    </div> <!--container end-->
    <?php require_once ("JS.php");?>
</body>
</html>