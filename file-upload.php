<?php
require_once ("../pdo-connect.php");
if(isset($_SESSION["user"])):
    $sql="SELECT * FROM user_upload WHERE user_id =? AND valid=1 ORDER BY id DESC";
    $stmt=$db_host->prepare($sql);
    try{
        $stmt->execute([$_SESSION["user"]["id"]]);
        $rows=$stmt->fetchAll(PDO::FETCH_ASSOC);

    }catch(PDOException $e){
        echo $e->getMessage();
    }

else:
    echo "請登入之後再進入此頁";
    exit();
endif;

?>
<!doctype html>
<html lang="en">
<head>
    <title>File Upload</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.0.2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"  integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        .cover-fit{
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-8">
            <form action="doUpload.php" method="post" enctype="multipart/form-data">
                <?php if(isset($_SESSION["user"])): ?>
                    <div class="mb-2">
                        hi, <?=$_SESSION["user"]["name"]?>, your user id is <?=$_SESSION["user"]["id"]?>
                    </div>
                <?php endif; ?>
                <div class="mb-2">
                    <label for="">選擇檔案</label>
                    <input type="file" required class="form-control" name="myFile">
                </div>
                <button class="btn btn-primary" type="submit">確認</button>
            </form>
            <h2 class="mt-3">已上傳圖片</h2>
            <div class="row">
                <?php foreach($rows as $value): ?>
                    <div class="col-lg-4">
                        <div class="ratio ratio-1x1">
                            <img class="cover-fit" src="upload/<?=$value["file_name"]?>" alt="">
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
<!-- Bootstrap JavaScript Libraries -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>