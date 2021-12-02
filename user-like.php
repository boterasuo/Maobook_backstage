<?php
require_once ("../pdo-connect.php");
$id=$_GET["id"]; //user id
$sqlUser="SELECT * FROM users WHERE id=?";
$stmtUser=$db_host->prepare($sqlUser);
try{
    $stmtUser->execute([$id]);
    $rowUser=$stmtUser->fetch();
}catch(PDOException $e){
    echo $e->getMessage();
}

$sql="SELECT user_like.user_id, products.* FROM user_like
JOIN products ON user_like.product_id = products.id
WHERE user_like.user_id=?
";
$stmt=$db_host->prepare($sql);
try{
    $stmt->execute([$id]);
    $rows=$stmt->fetchAll(PDO::FETCH_ASSOC);
}catch(PDOException $e){
    echo $e->getMessage();
}

?>
<!doctype html>
<html lang="en">
<head>
    <title>User Like</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.0.2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"  integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<body>
<div class="container">
    <h1><?=$rowUser["name"]?> 的收藏清單</h1>
    <table class="table table-bordered table-sm">
        <thead>
        <tr>
            <th>產品名稱</th>
            <th>價格</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($rows as $value): ?>
            <tr>
                <td><?=$value["name"]?></td>
                <td><?=$value["price"]?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

</body>
</html>