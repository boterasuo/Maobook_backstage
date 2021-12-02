<?php
require_once("../pdo-connect.php");
$sql="SELECT products.*, user_like.product_id,COUNT(user_like.product_id) AS product_count FROM user_like 
JOIN products ON user_like.product_id = products.id 
WHERE products.valid=1 
GROUP BY user_like.product_id
";


$stmt=$db_host->prepare($sql);
try{
    $stmt->execute();
    $rows=$stmt->fetchAll(PDO::FETCH_ASSOC);

//    $rowOrder=$stmtOrder->fetch();
}catch(PDOException $e){
    echo $e->getMessage();
};





?>


<!doctype html>
<html lang="en">
<head>
    <title>Product List Like</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.0.2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<body>

<div class="container">
    <div class="row">
        <?php foreach($rows as $value):?>
        <div class="col-lg-3">
            <div class="card">
                <h3><?=$value["name"]?></h3>
                <div>收藏數: <?=$value["product_count"]?></div>
            </div>
        </div>
        <?php endforeach;?>

    </div>
</div>
</body>
</html>