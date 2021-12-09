<!doctype html>
<html lang="en">
  <head>
    <title>Sign in</title>
      <script src='//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js'></script>
      <!--引用 jQuery + Bootstrap-->
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
            <form action="mao-doInsert.php" method="post" id="register_form" role="form" data-toggle="validator">
            <div class="form-group">
                <img class="logo" src="/images/logo.png" alt="">
                <div class="progress mb-3">
                    <div class="progress-bar bg-warning " role="progressbar" style="width: 100%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                </div>

                    <div class="form-floating input mb-2">
                        <input type="text" class="form-control" id="name" placeholder="name" name="name" required>
                        <label for="name">姓名</label>
                    </div>
                    <div class="form-floating input mb-2">
                        <input type="email" class="form-control" id="email" placeholder="name@example.com" name="email" data-error="郵件格式錯誤" required="required">
                        <label for="email">信箱</label>
                    </div>

                    <div class="form-floating input mb-2">
                        <input type="int" class="form-control" id="mobile" placeholder="mobile" name="mobile" required>
                        <label for="mobile">手機</label>

                    </div>

                <div class="form-floating input mb-2">
                    <input type="password" class="form-control" id="password"  name="password" placeholder="設定密碼" pattern="^(?=.*\d)(?=.*[a-zA-Z]).{6,}$" data-error="請輸入含有英文字母及數字的密碼，至少六個字元。" required="required">
                    <label for="password">密碼</label>
                </div>

                <div class="form-floating input mb-2">
                    <input id="inputConfirmPassword" name="ConfirmPassword" class="form-control" type="password" placeholder="確認密碼" data-match="#inputPassword" data-error="密碼未吻合！" required="required">
                    <label for="password">確認密碼</label>
                    <div class="help-block with-errors"></div>
                </div>

            </div>

                  <div class="d-grid gap-2 mb-5 mt-3">
                    <button class="btn btn-warning text-white" type="submit">開始書寫 &nbsp; 屬於您和毛孩的爪爪日記</button>
                  </div>
                  <div class="text-muted">© moebook 2021</div>
            </div>
            </form>
        </div>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>



        <!--引用 Validator-->
<!--        <script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.min.js"></script>-->
<!---->
        <!--執行 Validator-->
<!--        <script>-->
<!--            $('#register_form').validator().on('submit', function(e) {-->
<!--                if (e.isDefaultPrevented()) { // 未驗證通過則不處理-->
<!--                    return;-->
<!--                } else { // 通過後，送出表單-->
<!--                    alert("已送出表單");-->
<!--                }-->
<!--                e.preventDefault(); // 防止原始 form 提交表單-->
<!--            });-->
<!--        </script>-->




  </body>
</html>