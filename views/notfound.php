<?php
$title = "Page Not Found";


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once 'element/head.php'; ?>
</head>

<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                Page not found
            </div>
            <div class="card-body">
                <h5 class="card-title">Halaman tidak tersedia</h5>
                <p class="card-text">Halaman yang anda cari tidak tersedia atau sedang terjadi kesalahan. silahkan kembali ke <a style="text-decoration: none;" href="<?= BASELINK ?>home">Home</a> atau hubungi administrator.</p>
            </div>
        </div>
    </div>
</body>

</html>