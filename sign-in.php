<?php
session_start();
if (isset($_SESSION["user"])) {
    header("location:dashboard.php");
}
?>
<!doctype html>
<html lang="en">
<head>
    <title>Sign in</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.0.2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        body {
            background: url("images/cloud.jpg") center center;
            background-size: cover;
        }

        .logo {
            width: 64px;
        }

        .login-panel {
            width: 300px;
        }

        .form-control {
            position: relative;
        }

        .form-control:focus {
            z-index: 1;
        }

        .form-floating > label {
            z-index: 2;
        }

        .input-up .form-control {
            border-radius: .25rem .25rem 0 0;
        }

        .input-bottom .form-control {
            border-top: none;
            border-radius: 0 0 .25rem .25rem;
        }
    </style>
</head>
<body class="d-flex justify-content-center align-items-center vh-100">
<?php $maxErrorTimes = 6; ?>

<div class="login-panel text-center">
    <form action="doLogin.php" method="post">
        <div class="">
            <img class="logo" src="images/bootstrap-logo.svg" alt="">
            <?php if (isset($_SESSION["error_times"]) && $_SESSION["error_times"] >= $maxErrorTimes): ?>
                <h2>登入錯誤次數太多, 請稍後再嘗試</h2>
            <?php else: ?>
                <h1 class="h3 pt-4 mb-3">Please sign in</h1>
                <div class="form-floating input-up">
                    <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com"
                           name="email" required>
                    <label for="floatingInput">Email address</label>
                </div>
                <div class="form-floating input-bottom">
                    <input type="password" class="form-control" id="password" placeholder="name@example.com"
                           name="password" required>
                    <label for="password">Password</label>
                </div>
                <?php if (isset($_SESSION["error_msg"])): ?>
                    <div class="text-danger"><?= $_SESSION["error_msg"] ?><br>您還可以嘗試登入 <?php
                        $canError = $maxErrorTimes - $_SESSION["error_times"];
                        echo $canError;
                        ?> 次
                    </div>
                    <?php
                    unset($_SESSION["error_msg"]);
                endif; ?>
                <div class="d-grid gap-2 mb-5 mt-3">
                    <button class="btn btn-info text-white" type="submit">Sign in</button>
                </div>
                <div class="text-muted">© 2017–2021</div>
            <?php endif; ?>
        </div>
    </form>
</div>
<!-- Bootstrap JavaScript Libraries -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
        crossorigin="anonymous"></script>
</body>
</html>