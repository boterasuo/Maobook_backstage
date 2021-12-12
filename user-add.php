<?php

require_once("style.php");
require_once("main-nav.php");

?>

<!doctype html>
<html lang="en">
<head>
    <title>user-add</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.0.2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"  integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


    <style>
        body{
            background: #FFF center center;
            background-size: cover;
        }
        .logo{
            width: 400px;
            display:block;
            margin:auto;
        }
        .login-panel{
            width: 400px;
        }
        .form-control{
            position: relative;
        }
        .form-control:focus{
            z-index: 1;
        }
        .form-floating>label{
            z-index: 2;
        }
        .input-up .form-control{
            border-radius: .25rem .25rem 0 0;
        }
        .input-bottom .form-control{
            border-top: none;
            border-radius: 0 0 .25rem .25rem ;
        }
    </style>
</head>
<body>
    <div class="container col-lg-8">

    <div class="container">
        <div class="py-3 d-flex justify-content-end" >
            <button class="col-auto col-2 btn btn-warning text-white" role="button" onclick="window.location.href='user-list.php'">會 員 列 表</button>
        </div>
        <div class="justify-content">
            <form action="doUserAdd.php" method="post" class="needs-validation" novalidate >
            <div class="form-group"></div>
            <div class="progress mb-3">
                <div class="progress-bar bg-warning " role="progressbar" style="width: 100%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
            </div>

    <div class="col-12 form-floating input mb-2">
    <div class="form-floating input mb-3">
    <input type="text" class="form-control" id="validationDefault01" placeholder="name" name="name" required>
    <label for="validationDefault01">姓名</label>
    <div class="col-auto">
    <span id="passwordHelpInline" class="form-text">新增會員姓名</span>
    </div>
    </div>


    <div class="form-floating input mb-3">
        <input id="validationCustom02" type="text" name="account" class="form-control"  placeholder="account" pattern="^(?=.*\d)(?=.*[a-zA-Z]).{6,}$" required>
        <label for="validationCustom02">帳號</label>
    <div class="col-auto">
        <span id="passwordHelpInline" class="form-text">
      新增會員密碼，至少六個字元的帳號，需要包含字母與數字</span>
    </div>
    </div>
                <div class="form-floating input mb-3">
                    <input type="email" class="form-control" id="validationCustom03" placeholder="name@example.com" name="email" pattern="/^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/">
                    <label for="validationCustom03">信箱</label>
                    <div class="col-auto">
    <span id="passwordHelpInline" class="form-text">
      新增會員信箱，請輸入正確的信箱格式
    </span>
                    </div>
                </div>
                <div class="form-floating input mb-3">
                    <input type="tel" class="form-control" id="validationCustom04" placeholder="mobile" name="mobile" pattern="^09\d{2}-\d{3}-\d{3}$">
                    <label for="validationCustom04">手機</label>
                    <div class="col-auto">
    <span id="passwordHelpInline" class="form-text">
      新增會員手機，請輸入正確的手機格式九碼，如0900-000-000
    </span>
                    </div>
                </div>
                <div class="form-floating input mb-3">
                    <input type="password" class="form-control" id="validationCustom05"  name="password" placeholder="設定密碼" pattern="^(?=.*\d)(?=.*[a-zA-Z]).{6,}$"  >
                    <label for="validationCustom05">密碼</label>
                    <div class="col-auto">
    <span id="passwordHelpInline" class="form-text">
      設置會員密碼，請輸入至少六個字元，需要包含字母與數字
    </span>
                    </div>
                </div>

        <div class="form-floating input mb-3">
            <input id="validationCustom06" type="datetime" name="birthday" class="form-control"  placeholder="birthday" pattern="^\d{4}\-\d{1,2}\-\d{1,2}$" required>
            <label for="validationCustom06">生日</label>
            <div class="col-auto">
        <span id="passwordHelpInline" class="form-text">
      請輸入會員生日，如1992-04-16</span>
            </div>
        </div>

        <div class="form-floating input mb-3">

        <div class="form-check">
            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" value="1">
            <label class="form-check-label" for="flexRadioDefault1" >
                男性
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" value="3" checked>
            <label class="form-check-label" for="flexRadioDefault2">
                女性
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" value="3" checked>
            <label class="form-check-label" for="flexRadioDefault2">
                不透露
            </label>
        </div>
        <div class="col-auto">
        <span id="passwordHelpInline" class="form-text">
      請選取會員性別</span>
        </div>
    </div>

        <div class="form-floating input mb-3">
            <textarea type="text" class="form-control" id="tip"  name="tip" style="height: 100px" ></textarea>
            <label class="form-check-label" for="tip">會員備註</label>
        </div>
        <div class="mb-3">
            <input id="valid" type="hidden" name="valid" class="form-control" >
        </div>
        <div class="d-grid gap-2 mb-5 mt-3">
            <div class="help-block with-errors"></div>

            <button class="btn btn-warning text-white" type="submit">新 增 會 員</button>
        </div>

        </div>
    </div>
</div>
</div>

    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function () {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.prototype.slice.call(forms)
                .forEach(function (form) {
                    form.addEventListener('submit', function (event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false)
                })
        })()
    </script>
</body>
</html>