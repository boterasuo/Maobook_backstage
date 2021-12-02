<?php
require_once ("../db-connect.php");

if(isset($_GET["content"])){
    $content=$_GET["content"];
}else{
    $content="";
}
//$sql="SELECT * FROM user_hobby WHERE name = '$content'";
//$sqlUser="SELECT * FROM users WHERE id='user_id'"

$sql="SELECT users.*, user_hobby.user_id FROM user_hobby 
JOIN users ON user_hobby.user_id = users.id
WHERE user_hobby.name = '$content' 
";
$result=$conn->query($sql);
$userCount=$result->num_rows;

?>
<!doctype html>
<html lang="en">
<head>
    <title><?=$content?></title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.0.2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"  integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="py-2">
                <a href="user-list.php" class="btn btn-primary">回列表</a>
            </div>
            <h1>嗜好是 <?=$content?> 的使用者有: </h1>
            <table class="table table-bordered table-sm">
                <thead>
                <tr>
                    <th>id</th>
                    <th>帳號</th>
                    <th>名稱</th>
                    <th>建立時間</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php if($userCount>0 ):
                    while($row=$result->fetch_assoc()): //關聯式陣列
                        ?>
                        <tr>
                            <td><?=$row["id"]?></td>
                            <td><?=$row["account"]?></td>
                            <td><?=$row["name"]?></td>
                            <td><?=$row["created_at"]?></td>
                            <td>
                                <a class="btn btn-primary" href="user.php?id=<?=$row["id"]?>">內容</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4">沒有資料</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>