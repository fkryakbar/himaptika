<?php
session_start();
if (isset($_POST["login"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];
    if ($email == "himaptikafkipunlam2015@gmail.com" && $password == "infokom2022") {
        $_SESSION["login"] = "islogin";
        $_SESSION["operation"] = "login";
        header("Location:" . BASELINK . "dashboard/main");
    } else {
        echo "Login Gagal";
    }
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://kit.fontawesome.com/d697347471.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.ckeditor.com/ckeditor5/32.0.0/classic/ckeditor.js"></script>
    <!-- <script src="https://cdn.ckeditor.com/ckeditor5/32.0.0/decoupled-document/ckeditor.js"></script> -->

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= BASEURL ?>/style.css">
    <title>Admin</title>
</head>

<body>
    <div class="container mt-5" style="border-radius: 10px; box-shadow: 1px 0px 13px 4px rgba(0, 0, 0, 0.19);-webkit-box-shadow: 1px 0px 13px 4px rgba(0, 0, 0, 0.19);-moz-box-shadow: 1px 0px 13px 4px rgba(0, 0, 0, 0.19); padding : 20px">
        <h3 class="mt-3" style="font-weight: bolder;">Content Manager</h3>
    </div>
    <div class="container mt-5" style="border-radius: 10px; box-shadow: 1px 0px 13px 4px rgba(0, 0, 0, 0.19);-webkit-box-shadow: 1px 0px 13px 4px rgba(0, 0, 0, 0.19);-moz-box-shadow: 1px 0px 13px 4px rgba(0, 0, 0, 0.19); padding : 20px">
        <h4 class="mt-3">Login Page</h4>
        <form method="POST" action="">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="exampleInputPassword1">
            </div>

            <button type="login" name="login" class="btn btn-primary">Login</button>
        </form>
    </div>
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>