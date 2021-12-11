<!doctype html>
<html lang="en">
  <head>
    <title>註冊會員 sign-up</title>

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
  <body class="d-flex justify-content-center align-items-center vh-200">
        <div class="login-panel text-center">
            <form class="needs-validation" action="doSignUp.php" method="post"  novalidate >
                <div class="form-group"></div>
                <img class="logo" src="images/logo.png" alt="">
                <div class="progress mb-3">
                    <div class="progress-bar bg-warning " role="progressbar" style="width: 100%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                </div>

                    <div class="form-floating input mb-3">
                        <input type="text" class="form-control" id="validationDefault01" placeholder="name" name="name" required>
                        <label for="validationDefault01">姓名</label>
                        <div class="col-auto">
    <span id="passwordHelpInline" class="form-text">
      請輸入您的中文姓名
    </span>
                        </div>
                    </div>


                <div class="form-floating input mb-3">
                        <input id="validationCustom02" type="text" name="account" class="form-control"  placeholder="account" pattern="^(?=.*\d)(?=.*[a-zA-Z]).{6,}$" required>
                        <label for="validationCustom02">帳號</label>
                    <div class="col-auto">
    <span id="passwordHelpInline" class="form-text">
      請設置至少六個字元的帳號，需要包含字母與數字
    </span>
                    </div>

                    </div>
                    <div class="form-floating input mb-3">
                        <input type="email" class="form-control" id="validationCustom03" placeholder="name@example.com" name="email" pattern="/^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/">
                        <label for="validationCustom03">信箱</label>
                        <div class="col-auto">
    <span id="passwordHelpInline" class="form-text">
      請輸入有效的電子信箱
    </span>
                        </div>
                    </div>
                    <div class="form-floating input mb-3">
                        <input type="tel" class="form-control" id="validationCustom04" placeholder="mobile" name="mobile" pattern="^09\d{2}-\d{3}-\d{3}$">
                        <label for="validationCustom04">手機</label>
                        <div class="col-auto">
    <span id="passwordHelpInline" class="form-text">
      請輸入正確的手機格式九碼，如0900-000-000
    </span>
                        </div>
                    </div>



                <div class="form-floating input mb-3">
                    <input type="password" class="form-control" id="validationCustom05"  name="password" placeholder="設定密碼" pattern="^(?=.*\d)(?=.*[a-zA-Z]).{6,}$"  >
                    <label for="validationCustom05">密碼</label>
                    <div class="col-auto">
    <span id="passwordHelpInline" class="form-text">
      請輸入至少六個字元，需要包含字母與數字
    </span>
                    </div>
                </div>

                <div class="form-floating input mb-3">
                    <input id="validationCustom06" name="RePassword" class="form-control" type="password" placeholder="確認密碼" data-match="#inputPassword" data-error="密碼未吻合！" required="required">
                    <label for="validationCustom06">確認密碼</label>
                    <div class="col-auto">
    <span id="passwordHelpInline" class="form-text">
      需與上述密碼相同，請注意大小寫
    </span>
                    </div>
                </div>

                <div class="col-12 mb-5 mt-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="invalidCheck2" required>
                        <label class="form-check-label" for="invalidCheck2">
                            Agree to terms and conditions
                        </label>
                    </div>

                <div class="mb-3">
                    <input id="valid" type="hidden" name="valid" class="form-control" >
                </div>
                  <div class="d-grid gap-2 mb-5 mt-3">
                      <div class="help-block with-errors"></div>

                      <button class="btn btn-warning text-white" type="submit">開始書寫 &nbsp; 屬於您和毛孩的爪爪日記</button>
                  </div>
                  <div class="text-muted">© maobook 2021</div>
            </div>


            </form>


        </div>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

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
