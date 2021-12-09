
<?php
if(isset($_GET["id"])){
    $id=$_GET["id"];
}else{
    $id=0;
}
require_once ("db-connect.php");
$sql="SELECT * FROM social_forum WHERE id='$id' AND valid=1";
$result=$conn->query($sql);
$userExist=$result->num_rows;


?>

<!doctype html>
<html lang="en">
<head>
    <title>修改文章</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.0.2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"  integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<body>
<div class="container">
    <h1>修改文章</h1>

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

                <form action="social-doUpdate.php" method="post">
                    <input type="hidden" name="id" value="<?=$row["id"]?>">

                    <div class="mb-3">
                        <label for="article_title">標題</label>
                        <input id="article_title" type="text" name="article_title" class="form-control" value="<?=$row["article_title"]?>">
                    </div>

                    <div class="mb-3">
                        <label for="article_content">內文</label>
                        <textarea id="article_content" type="text" name="article_content" class="form-control"  rows="6"><?=$row["article_content"]?></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="article_cate">類別</label>
<!--                        <input id="article_cate" type="text" name="article_cate" class="form-control" value="--><?//=$row["article_cate"]?><!--">-->
                        <select class="form-select" aria-label="Default select example"  name="article_cate" id="article_cate" required>
                            <option value="飲食保健" <?php if($row["article_cate"] == '飲食保健') echo"selected"; ?>>飲食保健</option>
                            <option value="醫療症狀" <?php if($row["article_cate"] == '醫療症狀') echo"selected"; ?>>醫療症狀</option>
                            <option value="生活分享" <?php if($row["article_cate"] == '生活分享') echo"selected"; ?>>生活分享</option>
                            <option value="其他" <?php if($row["article_cate"] == '其他') echo"selected"; ?>>其他</option>
                        </select>
                    </div>

<!--        BUTTON            -->
                    <div>
                        <button class="btn btn-primary" type="submit">修改</button>
                        <input class="btn btn-primary" type="reset">
                    </div>

                </form>
            <?php endif; ?>
        </div>
    </div>
</div>
</body>

</html>