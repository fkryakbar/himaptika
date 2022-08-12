<?php
session_start();
// require_once "../variable/absolute.php";
if (!$_SESSION["login"] == "islogin") {
    header("Location:../login");
    exit;
}
$id = (int) $url["1"];
$query = "SELECT * FROM blog WHERE id = $id";
$datas = mysqli_query($conn, $query);
if (mysqli_num_rows($datas) > 0) {
    $datas = mysqli_fetch_assoc($datas);
} else {
    echo "Blog tidak ditemukan";
    header("Location:" . BASELINK);
    exit;
}
// simpan
if (isset($_POST["simpan"])) {
    $url = $datas["url"];
    $newurl = $_POST["url"];
    $id = (int)$_POST["id"];
    $judul = $_POST["judul"];
    $content = $_POST["content"];
    $content = str_ireplace("'", "", $content);
    $deskripsi = $_POST["deskripsi"];
    // waktu
    date_default_timezone_set('Asia/Kuala_Lumpur');
    $waktu = date("Y-m-d H:i:s");
    // file
    $filename = $_FILES["cover"]["name"];
    $errorfile = $_FILES["cover"]["error"];
    $tmpname = $_FILES["cover"]["tmp_name"];
    $size = $_FILES["cover"]["size"];
    $extention = explode(".", $filename);
    $extention = strtolower(end($extention));
    $filename = $url . "." . $extention;
    if ($errorfile == 4) {
        $query = "UPDATE blog SET url='$newurl', judul = '$judul', id = $id, deskripsi = '$deskripsi', isi = '$content', edit = '$waktu' WHERE url='$url'";
        $cek =  mysqli_query($conn, $query);
        $error1 =  "Error : " . mysqli_error($conn);
        $_SESSION["operation"] = "simpan";
        header("Location:" . BASELINK . "dashboard/main/blog.php");
    } elseif ($extention == "png" || $extention == "jpg" || $extention == "jpeg") {
        // cek ukuran files
        if ($size < 500000) {
            $query = "UPDATE blog SET url='$newurl', judul = '$judul', id = $id, gambar = '$filename',deskripsi = '$deskripsi', isi = '$content', edit = '$waktu' WHERE url='$url'";
            $cek =  mysqli_query($conn, $query);
            $error1 = "Error : " . mysqli_error($conn);
            move_uploaded_file($tmpname, "public/img/" . $url . "." . $extention);
            $_SESSION["operation"] = "simpan";
            header("Location:" . BASELINK . "dashboard/main/blog.php");
        } else {
            $error1 = "ukuran file lebih dari 500kb";
        }
    } else {
        $error1 = "file bukan gambar";
    }
}
// hapus
if (isset($_POST["hapus"])) {
    $filename = $datas['gambar'];
    $url = $datas["url"];
    $query = "DELETE FROM blog WHERE url = '$url'";
    $data = mysqli_query($conn, $query);
    unlink("public/img/" . $filename);
    header("Location:" . BASELINK . "dashboard/main/blog.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://kit.fontawesome.com/d697347471.js" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/d697347471.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tiny.cloud/1/hltrq97ncna67f37e2nndkn4ngyd95k8dqggumzbxgoyyekj/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#mytextarea'
        });
    </script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="sweetalert2.min.css">
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
        <form method="POST" action="" enctype="multipart/form-data">
            <h4 class="mt-3 me-2" style="display: inline-block;">Edit Blog</h4>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">URL</label>
                <input class="form-control" name="url" value="<?= $datas["url"] ?>" id="exampleInputEmail1" aria-describedby="emailHelp" required>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">id</label>
                <input class="form-control" name="id" value="<?= $datas["id"] ?>" id="exampleInputEmail1" aria-describedby="emailHelp" required>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Judul</label>
                <input class="form-control" name="judul" value="<?= $datas["judul"] ?>" id="exampleInputPassword1" required>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Deskripsi</label>
                <input class="form-control" name="deskripsi" value="<?= $datas["deskripsi"] ?>" id="exampleInputPassword1" required>
            </div>
            <div class="mb-3">
                <label for="formFile" class="form-label">Cover <span class="text-muted  ms-2">Image selected : <?= $datas["gambar"] ?></span>
                    <div style="display: inline-block;" class="text-muted"> - max 500kb</div>
                </label>
                <input class="form-control" name="cover" type="file" id="formFile">
            </div>

            <textarea style="height:fit-content;" name="content" id="mytextarea" required>
                <?= $datas["isi"] ?>
        </textarea>

            <button type="submit" name="simpan" class="btn btn-primary mt-3">Simpan</button>


        </form>




        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script>
            <?php if (isset($error1)) : ?>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: '<?= $error1 ?>',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Ok',
                    showConfirmButton: true,
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = window.location.href;
                    }
                })
            <?php endif; ?>
        </script>
</body>

</html>