<?php
$title = "HIMAPTIKA FKIP ULM";


?>
<!doctype html>
<html lang="en">

<head>
    <?php require_once 'element/head.php'; ?>
</head>

<body>
    <!-- navbar -->
    <?php require_once 'element/navbar.php'; ?>
    <!-- end navbar -->
    <div style="background-color: #9c1623;">
        <!-- Banner -->
        <div style="color: #9c1623;">.</div>
        <img data-aos="zoom-in-up" data-aos-duration="700" data-aos-easing="ease-in-in" data-aos-once="true" src="<?= BASEURL ?>/Himaptika.png" class="logo mt-5 mx-auto d-block " width="150px">
        <h1 data-aos="fade-up" data-aos-duration="700" data-aos-easing="ease-in-in" data-aos-once="true" class="mt-3 text-center text" style="font-weight: bold; font-size: 70px">HIMAPTIKA</h1>
        <h4 data-aos="zoom-in-up" data-aos-duration="700" data-aos-easing="ease-in-in" data-aos-once="true" class="mt-3 text-center " style="font-weight: bold;color:white;">FAKULTAS KEGURUAN DAN ILMU PENDIDIKAN</h4>
        <h5 data-aos="zoom-in-up" data-aos-duration="700" data-aos-easing="ease-in-in" data-aos-once="true" class="mt-3 mb-3 text-center " style="font-weight: bold; color:white;">UNIVERSITAS LAMBUNG MANGKURAT</h5>
        <div style="color: #9c1623;">.</div>
    </div>
    <!-- end banner -->
    <!-- Info  -->
    <div class="container mt-5">
        <div data-aos="fade-up" data-aos-duration="700" data-aos-easing="ease-in-in" data-aos-once="true" class="section mb-4">
            <h2 class="judul" style="font-size: 25px;">INFO TERBARU</h2><i style="color:#9c1623;" class="fas fa-4x fa-newspaper icon float-end mt-2"></i>
        </div>
        <!-- card -->
        <div class="row">
            <?php
            $query = 'SELECT * FROM blog ORDER BY id DESC LIMIT 3';
            $post = mysqli_query($conn, $query);
            ?>
            <?php while ($row = mysqli_fetch_assoc($post)) : ?>
                <div data-aos="fade-up" data-aos-duration="700" data-aos-easing="ease-in-in" data-aos-once="true" class="col-sm-4">
                    <div class="card mb-4">
                        <img src="<?= BASEURL ?>/img/<?= $row["gambar"] ?>" class="card-img-top img-fluid" alt="...">
                        <div class="card-body">
                            <a href="<?= BASELINK . "blog/" . $row["url"] ?>" class="" style="text-decoration: none; color:#9c1623">
                                <h5 class="card-title" style="font-weight: bold;color:black"><?= $row["judul"] ?></h5>
                                <hr style="color: black;">
                                <p class="card-text" style="color:black"><?= $row["deskripsi"] ?></p>
                                <hr style="color: black;">
                                Selengkapnya...
                            </a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
            <div data-aos="fade-up" data-aos-duration="700" data-aos-easing="ease-in-in" data-aos-once="true" class="div mb-5" style="color: #9c1623;">
                <a href="blog" class="" style="text-decoration: none; color:#9c1623; font-size:large">Selengkapnya</a> <i style="color: #9c1623;" class="fas fa-arrow-right"></i>
            </div>


        </div>
        <!-- endcard -->
    </div>
    <!-- end info -->
    <!-- Struktur Organisasi -->
    <div data-aos="fade-up" data-aos-duration="700" data-aos-easing="ease-in-in" data-aos-once="true" class="new">
        <div class="container">
            <div class="section mb-4">
                <h2 class="judul" style="font-size: 25px;">Struktur Organisasi</h2><i style="color: white;" class="fas fa-users fa-3x float-end mt-2"></i>
            </div>
        </div>
    </div>
    <div data-aos="fade-up" data-aos-duration="700" data-aos-easing="ease-in-in" data-aos-once="true" class="container">
        <div class="card mt-5">
            <h5 class="card-header" style="background-color: #9c1623; color: white; font-weight:bolder">Kenali Kami <i class="fas fa-address-book fa-1x float-end mt-1"></i></h5>
            <div class="card-body">
                <a href="<?= BASELINK ?>blog/susunan-kepengurusan-himaptika-fkip-ulm-2022-2023" class="" style="text-decoration: none; color:#9c1623">
                    <h5 class="card-title" style="color: black;">Struktur Organisasi HIMAPTIKA FKIP ULM Periode 2022-2023</h5>
                    <p class="card-text" style="color: black;">Klik selengkapnya untuk mengetahui struktur Organisasi HIMAPTIKA FKIP ULM</p>
                    Selengkapnya
                </a><i style="color: #9c1623;" class="fas fa-arrow-right"></i>
            </div>
        </div>
    </div>
    <!-- End Struktur Organisasi -->
    <!-- Ikahimatika -->
    <div data-aos="fade-up" data-aos-duration="700" data-aos-easing="ease-in-in" data-aos-once="true" class="new mt-5">
        <div class="container">
            <div class="section mb-4">
                <h2 class="judul" style="font-size: 25px;">IKAHIMATIKA</h2><i style="color: white;" class="fas fa-history fa-3x float-end mt-2"></i>
            </div>
        </div>
    </div>
    <div data-aos="fade-up" data-aos-duration="700" data-aos-easing="ease-in-in" data-aos-once="true" class="container">
        <div class="card mt-5">
            <h5 class="card-header" style="background-color: #9c1623; color: white; font-weight:bolder">IKAHIMATIKA <i class="fas fa-landmark float-end mt-1"></i></h5>
            <div class="card-body">
                <a href="<?= BASELINK ?>blog/apa-itu-ikahimatika" class="" style="text-decoration: none; color:#9c1623">
                    <h5 class="card-title" style="color: black;">Apa itu IKAHIMAPTIKA?</h5>
                    <p class="card-text" style="color: black;">Klik selengkapnya untuk mengetahui apa itu IKAHIMATIKA</p>
                    Selengkapnya
                </a><i style="color: #9c1623;" class="fas fa-arrow-right"></i>
            </div>
        </div>
    </div>
    <!-- end Ikahimatika -->
    <!-- footer -->
    <?php require_once 'element/footer.php'; ?>
    <!-- endfooter -->





    <!-- bootsrap script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- aos script -->
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>

</html>