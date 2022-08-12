<?php
$title = "Media Sosial";
$query = "SELECT * FROM sosial";
$data = query("SELECT * FROM sosial");
$deskripsi = 'Media sosial dan pengumuman-pengumuman yang ada di HIMAPTIKA FKIP ULM';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once 'element/head.php'; ?>
</head>

<body>
    <!-- navbar -->
    <?php require_once 'element/navbar.php'; ?>
    <!-- end navbar -->
    <div class="container sosial mt-5">
        <div class="card" data-aos="fade-up" data-aos-duration="700" data-aos-easing="ease-in-in" data-aos-once="true">
            <div class="card-header" style="background-color: #9c1623; color:white">
                <i class="fa-solid fa-envelope me-2"></i>Media Sosial HIMAPTIKA FKIP ULM
            </div>
            <div class="card-body">
                <a style="text-decoration: none; color:black" href="<?= $instagram ?>" target="_blank"><i class="fab fa-instagram me-2 mt-1 fa-1x"></i>Instagram </a>
                <hr>
                <a style="text-decoration: none; color:black" href="<?= $tiktok ?>" target="_blank"><i class="fab fa-tiktok me-2 mt-1 fa-1x"></i>Tiktok </a>
                <hr>
                <a style="text-decoration: none; color:black" href="<?= $youtubelink ?>" target="_blank"><i class="fab fa-youtube me-2 mt-1 fa-1x"></i>Youtube </a>
                <hr>
                <a style="text-decoration: none; color:black" href="<?= $website ?>"><i class="fas fa-home me-2 mt-1 fa-1x"></i>Website </a>
                <hr>
                <a style="text-decoration: none; color:black" href="<?= $aspirasi ?>"><i class="fa-solid fa-paper-plane me-2 mt-1"></i></i>Layanan Aspirasi Mahasiswa </a>
            </div>
        </div>
        <div class="card mt-5" data-aos="fade-up" data-aos-duration="700" data-aos-easing="ease-in-in" data-aos-once="true">
            <div class="card-header" style="background-color: #9c1623; color:white">
                <i class="fa-solid fa-circle-info me-2"></i>Pengumuman
            </div>
            <div class="card-body">
                <?php while ($row = mysqli_fetch_assoc($data)) : ?>
                    <a href="<?= $row["link"] ?>" style="text-decoration: none; color:black"><?= $row["judul"] ?></a>
                    <hr>
                <?php endwhile; ?>
            </div>
        </div>

    </div>


    <!-- footer -->
    <?php require_once 'element/footer.php'; ?>
    <!-- endfooter -->






    <!-- boostrap script -->
    <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <!-- aos script -->
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>

</html>