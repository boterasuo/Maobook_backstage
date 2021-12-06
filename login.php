<!doctype html>
<html lang="en">
<head>
    <title>Sign in</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.0.2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"  integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        body{
            background: radial-gradient(#CCC,#EEEEF1);
            background-size: cover;
        }
        .logo{
            width: 70%;
        }
        .login-panel{
            width: 300px;
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
        .submit{
            background: rgba(78,170,233);

        }
        .register{
            background: rgba(251,164,127);
        }
        .card{
            width: 400px;
        }
    </style>
</head>
<body >

<div class="d-flex justify-content-center align-items-center vh-100">
<div class="card align-items-center ">
    <div class="login-panel  text-center">
    <form action="doLogin.php" method="post">
        <div class="">
            <img class="logo" src="images/logo.png" alt="">
            <h1 class="h3 pt-4 mb-3">Please sign in</h1>
            <div class="form-floating input-up">
                <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="email" required>
                <label for="floatingInput">Email address</label>
            </div>
            <div class="form-floating input-bottom">
                <input type="password" class="form-control" id="password" placeholder="name@example.com" name="password" required>
                <label for="password">Password</label>
            </div>
            <div class="d-grid gap-2 mb-5 mt-3">
                <button class="btn submit btn-info text-white" type="submit">Sign in</button>
                <button class="btn register btn-info text-white" type="submit">Sign in</button>
            </div>
            <div class="text-muted">© 2017–2021</div>
        </div>
    </form>
</div>
</div>
</div>
</body>
</html>