<?php
if(isset($_GET["id"])){
    $id=$_GET["id"];
}else{
    $id=0;
}
require_once ("../db-connect.php");
$sql="SELECT * FROM users WHERE id='$id' AND valid=1";
$result=$conn->query($sql);
$userExist=$result->num_rows;
?>
<!doctype html>
<html lang="en">
<head>
    <title>Edit User</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.0.2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"  integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<body>
<div class="container">
    <div class="py-2 d-flex justify-content-end">
        <div>
            <a class="btn btn-primary" href="user-list.php">使用者列表</a>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <?php if($userExist===0): ?>
                使用者不存在
            <?php else:
                $row=$result->fetch_assoc();
                ?>
                <form action="doUpdate.php" method="post">
                    <input type="hidden" name="id" value="<?=$row["id"]?>">
                    <div class="mb-3">
                        <label for="account">帳號</label>
                        <input id="account" type="text" name="account" class="form-control-plaintext" value="<?=$row["account"]?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="name">姓名</label>
                        <input id="name" type="text" name="name" class="form-control" value="<?=$row["name"]?>">
                    </div>
                    <div class="mb-3">
                        <label for="name">email</label>
                        <input id="email" type="email" name="email" class="form-control" value="<?=$row["email"]?>">
                    </div>
                    <button class="btn btn-primary" type="submit">送出</button>
                    <a href="doDelete.php?id=<?=$row["id"]?>" class="btn btn-danger">刪除</a>
                </form>
            <?php endif; ?>
        </div>
    </div>
</div>
</body>
</html>