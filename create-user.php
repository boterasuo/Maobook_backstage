<!doctype html>
<html lang="en">
<head>
    <title>create user</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.0.2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        body{
            height: 100vh;
            background:url("https://cdn.cybassets.com/s/files/5770/ckeditor/pictures/content_0bbb21c8-5f36-48b7-be60-9058ef648f70.jpg") center center;
            background-size: cover;
            backdrop-filter: blur(5px);
        }
        table{
            background: linear-gradient(rgb(81,181,163),rgb(83,215,165));
            box-shadow: 2px 2px 15px grey;


        }
        .btn-fruit{
            background:linear-gradient(to right, #FF4B2B, #FF416C) ;
            color: #00fafa;
            font-weight: bold;


        }
    </style>

</head>
<body>
<div class="container">
    <div class="py-2 d-flex justify-content-end">
        <div>
            <a href="user-list.php" class="btn btn-fruit"></a>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <form action="doInsert.php" method="post">
                <div class="mb-3">
                    <label for="account">帳號</label>
                    <input type="text" id="account" name="account" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="">姓名</label>
                    <input type="text" id="name" name="name" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="">電子信箱</label>
                    <input type="email" id="email" name="email" class="form-control">
                </div>
                <button class="btn btn-primary" type="submit">送出</button>
            </form>
        </div>
    </div>
</div>

</body>
</html>