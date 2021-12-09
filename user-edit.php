<?php
require_once("pdo-connect.php"); //連線到遠端資料庫
$id=$_GET["id"];
$sqlUser="SELECT * FROM users WHERE id=?";
$stmtUser=$db_host->prepare($sqlUser);
try{
    $stmtUser->execute([$id]);
    $rowUser=$stmtUser->fetch();
}catch(PDOException $e){
    echo $e->getMessage();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="Description" content="MaoBook小組專題報告"/>
    <meta name="Content-Language" content="zh-TW">
    <meta name="author" content="Team MaoBook"/>
    <!--  網站圖示  -->
    <link rel="apple-touch-icon" type="image/png" href="images/logo-nbg.png"/>
    <link rel="shortcut icon" type="image/png" href="images/logo-nbg.png"/>
    <link rel="mask-icon" type="image/png" href="images/logo-nbg.png"/>

    <title>編輯<?=$rowUser["name"]?>的個人資料</title>

<!--  板模的css、BS5、fontawesome  -->
    <?php require_once("style.php"); ?>
    <!--  板模end  -->

    <!-- 此處新增css檔 -->
    <link rel="stylesheet" href="css/ou-style.css?time=<?=time()?>">
    <!-- Css檔 end   -->


</head>
<body class="sb-nav-fixed">
<?php require_once("main-nav.php"); ?>
<!-- 主要內容 -->
<div id="layoutSidenav_content">
    <div class="container px-0">
        <main class="main px-5">
            <div class="container-fluid">
                <h1 class="mt-4">編輯<?=$rowUser["name"]?>的個人資料</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="home.php">首頁</a></li>
                    <li class="breadcrumb-item"><a href="user.php?id=<?=$rowUser["id"]?>">會員資料</a></li>
                    <li class="breadcrumb-item active">編輯會員資料</li>
                </ol>
            </div>

            <!--    本頁 內容    -->
            <form id="form" action="user-doUpdate.php" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-7 mb-3">

                        <input type="hidden" name="id" value="<?=$rowUser["id"]?>">
                        <div class="form-group row mb-1">
                            <label for="account" class="col-3 col-form-label">奴才帳號</label>
                            <div class="col-9">
                                <input id="account" name="account" type="text" class="form-control"
                                value="<?=$rowUser["account"]?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <label for="password" class="col-3 col-form-label">奴才密碼</label>
                            <div class="col-9">
                                <input id="password" name="password" type="text" class="form-control"
                                       value="<?=$rowUser["password"]?>">
                                <div id="passwordErr" class="passwordErr">  </div>
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <label for="name" class="col-3 col-form-label">奴才姓名</label>
                            <div class="col-9">
                                <input id="name" name="name" type="text" class="form-control"
                                       value="<?=$rowUser["name"]?>">
                                <div id="nameErr" class="nameErr">  </div>
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <label for="gender" class="col-3 col-form-label">奴才性別</label>
                            <div class="col-9 d-flex align-items-center">
                                <div class="form-check me-3">
                                    <input id="gender" name="gender" type="radio" class="form-check-input" value="1"
                                            <?php if ($rowUser["gender"]==1):
                                            echo "checked";
                                            endif; ?>>
                                    <label class="form-check-label" for="gender">男性</label>
                                </div>
                                <div class="form-check me-3">
                                    <input id="gender" name="gender" type="radio" class="form-check-input" value="2"
                                        <?php if ($rowUser["gender"]==2):
                                            echo "checked";
                                        endif; ?>>
                                    <label class="form-check-label" for="gender">女性</label>
                                </div>
                                <div class="form-check me-3">
                                    <input id="gender" name="gender" type="radio" class="form-check-input" value="9"
                                        <?php if ($rowUser["gender"]==9):
                                            echo "checked";
                                        endif; ?>>
                                    <label class="form-check-label" for="gender">不透漏</label>
                                </div>
                            </div>

                        </div>
                        <div class="form-group row mb-1">
                            <label for="birthday" class="col-3 col-form-label">奴才生日</label>
                            <div class="col-9">
                                <input id="birthday" name="birthday" type="date" class="form-control"
                                       value="<?=$rowUser["birthday"]?>">
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <label for="mobile" class="col-3 col-form-label">奴才手機</label>
                            <div class="col-9">
                                <input id="mobile" name="mobile" type="tel" class="form-control"
                                       value="<?=$rowUser["mobile"]?>">
                                <div id="mobileErr" class="mobileErr">  </div>
                            </div>

                        </div>
                        <div class="form-group row mb-1">
                            <label for="address" class="col-3 col-form-label">奴才地址</label>
                            <div class="col-9 address-edit">
                                <div class="row gx-0">
                                    <div class="col-6">
                                        <label for="zip" class="address1">
                                            <input id="zip" name="zip" type="text" class="form-control"
                                                   value="<?=$rowUser["zip_code"]?>">
                                        </label>
                                        <div id="zipErr" class="zipErr"></div>
                                    </div>
                                    <div class="col-6">
                                        <label for="county" class="address2">
                                        <input id="county" name="county" type="text" class="form-control"
                                               value="<?=$rowUser["county"]?>">
                                        </label>
                                    </div>
                                </div>
                                <div>
                                    <label for="address" class="address3">
                                    <input id="address" name="address" type="text" class="form-control"
                                           value="<?=$rowUser["address"]?>">
                                    </label>
                                </div>

                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <label for="valid" class="col-3 col-form-label">使用者權限</label>
                                <div class="col-9 d-flex">
                                    <div class="form-check me-3 py-2">
                                        <input id="valid" name="valid" type="radio" class="form-check-input" value="1"
                                            <?php if ($rowUser["valid"]==1):
                                                echo "checked";
                                            endif; ?>>
                                        <label class="form-check-label" for="valid">一般</label>
                                    </div>
                                    <div class="form-check me-3 py-2">
                                        <input id="valid" name="valid" type="radio" class="form-check-input" value="1"
                                            <?php if ($rowUser["valid"]==0):
                                                echo "checked";
                                            endif; ?>>
                                        <label class="form-check-label" for="valid">封鎖中</label>
                                    </div>
                                </div>
                        </div>
                        <div class="text-end">
                            <a class="btn btn-secondary" href="user.php?id=<?=$rowUser["id"]?>">放棄修改</a>
                            <button id="submitBtn" class="btn btn-mao-primary" type="submit">儲存</button>
                        </div>
                </div>
                <div class="avatar col-5">
                    <div>
                        <h4><?=$rowUser["name"]?>的大頭照</h4>
                        <figure class="user-avatar ratio ratio-1x1">
                            <?php if($rowUser["image"]!==""): ?>
                                <img class="cover-fit" src="images/<?=$rowUser["image"]?>" alt="">
                            <?php else: ?>
                                <img class="cover-fit" src="images/avatar_user.png" alt="">
                            <?php endif; ?>
                            <figure id="show" class="user-avatar ratio ratio-1x1 figure-preview">
                            </figure>
                            <div class="avatar-edit">
                                <div class="edit-font">
                                    <label for="fileUpload" class="custom-upload-btn">
                                        <input id="fileUpload" type="file" class="edit-button" name="myFile">
                                        <i class="edit-icon fas fa-edit"></i>
                                    </label>
                                </div>
                            </div>
                        </figure>

                    </div>
                </div>
            </div>
            </form>

            <!--   本頁內容 end  -->


        </main><!-- 主要內容end -->

    </div>
<!--    --><?php //require_once("footer.php"); ?>

</div>
<?php //require_once("JS.php"); ?>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script>
    let form=document.querySelector("#form"),
        password=document.querySelector("#password"),
        passwordErr=document.querySelector("#passwordErr"),
        name=document.querySelector("#name"),
        nameErr=document.querySelector("#nameErr"),
        mobile=document.querySelector("#mobile"),
        mobileErr=document.querySelector("#mobileErr"),
        zip=document.querySelector("#zip"),
        zipErr=document.querySelector("#zipErr"),
        submitBtn=document.querySelector("#submitBtn");

    const regPassword=/.*[A-Z]+.*[0-9]+.*/;
    const regMobile=/^09\d{8}$/;


        submitBtn.addEventListener("click", function(e){
            e.preventDefault();
            passwordErr.innerText=nameErr.innerText=mobileErr.innerText=zipErr.innerText="";
            password.style.border=name.style.border=mobile.style.border=zip.style.border="";
            if (password.value === ""){
                passwordErr.innerText="密碼不能留空!"
                password.style.border="1px solid red";
            } else if (!regPassword.test(password.value)){
                passwordErr.innerText="密碼請至少包含一個以上的數字和大寫字母!"
                password.style.border="1px solid red";
            }
            if (name.value === ""){
                nameErr.innerText="姓名不能留空!"
                name.style.border="1px solid red";
            }
            if (mobile.value === ""){
                mobileErr.innerText="手機號碼不能留空!"
                mobile.style.border="1px solid red";
            } else if (!regMobile.test(mobile.value)){
                mobileErr.innerText="手機號碼格式錯誤!"
                mobile.style.border="1px solid red";
            }
            if (zip.value.length!=3 && zip.value.length!=5) {
                zipErr.innerText = "郵遞區號應為3碼或5碼";
                zip.style.border="1px solid red";
            }
            if (passwordErr.innerText==="" && nameErr.innerText==="" && mobileErr.innerText==="" && zipErr.innerText===""){
                form.submit();
            }
        })
</script>
<script>
    $("#fileUpload").change(function(e){
       var fileData = e.target.files[0]
        var reader = new FileReader();
       reader.readAsDataURL(fileData);
        $("#show").empty();

       reader.addEventListener("load", function(event){
           $("#show").append(`<img class="cover-fit" src="${event.target.result}">`)
       })
    })
</script>


</body>
</html>
