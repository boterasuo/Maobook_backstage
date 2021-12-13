<?php
if(isset($_GET["id"])){
    $id=$_GET["id"];
}else{
    $id=0;
}
require_once ("pdo-connect.php");
$sql="SELECT * FROM social_forum ";
$result=$conn->query($sql);
$userExist=$result->num_rows;

require_once("style.php");
require_once("main-nav.php");
?>

<!doctype html>
<html lang="en">
<head>
    <title>新增文章</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.0.2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"  integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<body>
<div class="container">
    <h1>新增文章</h1>

    <div class="py-2 d-flex justify-content-end">
        <div>
            <a class="btn btn-primary" href="user-social-log.php">返回列表</a>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <?php if($userExist===0): ?>
                使用者不存在
            <?php else:
                $row=$result->fetch_assoc();
                ?>

                <form action="social-doInsert.php" method="post">
                    <input type="hidden" name="id" value="<?=$row["id"]?>">

                    <div class="mb-3">
                        <label for="title">標題</label>
                        <input id="title" type="text" name="title" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="content">內文</label>
                        <textarea id="content" type="text" name="content" class="form-control"  rows="6"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="category">類別</label>
                        <select class="form-select" aria-label="Default select example" name="category" id="article_cate" required>
                            <option selected>請選擇文章類別</option>
                            <option value="1" >飲食保健</option>
                            <option value="2" >醫療症狀</option>
                            <option value="3" >生活分享</option>
                            <option value="4" >其他</option>
                        </select>
                    </div>


                <!--------------- 新增文章圖片 ----------------->
<!--                    <div class="mb-3">-->
<!--                        <label for="formFileMultiple" class="form-label">上傳圖片</label>-->
<!--                        <input class="form-control" type="file" id="formFileMultiple" multiple>-->
<!--                    </div>-->


<!--        BUTTON            -->
                    <div>
                        <button class="btn btn-primary" type="submit">新增</button>
                        <input class="btn btn-primary" type="reset">
                    </div>

                </form>
            <?php endif; ?>
        </div>
    </div>
</div>
</body>

</html>