<?php
$judul = "Informasi";
// $waktu = "Informasi terbaru HIMAPTIKA";
$youtube = 'https://www.googleapis.com/youtube/v3/search?key=AIzaSyBaGbmB-4iq7hgRiAw2Ammrd2lBtM_jkeo&channelId=UCyH0YbfXsGONS1qxVLnkUMA&maxResults=1&order=date&part=snippet';
$title = "INFORMASI HIMAPTIKA";
function curl($url)
{
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $res = curl_exec($curl);
    curl_close($curl);
    return json_decode($res, 1);
}
$video = curl($youtube);

if (isset($video["items"][0]['id']['videoId'])) {
    $videoid = $video["items"][0]['id']['videoId'];
} else {
    $videoid = 'pdyaUJPcK_Q';
}
// saring pagination
$i = 1;
$query = 'SELECT * FROM blog';
$jumlahdataperhalaman = 5;
$jumlahsemuadata = mysqli_num_rows(mysqli_query($conn, $query));
$jumlahhalaman = ceil($jumlahsemuadata / $jumlahdataperhalaman);
$halamanaktif = 1;
$awalidex = ($jumlahdataperhalaman * $halamanaktif) - $jumlahdataperhalaman;
$prev = $halamanaktif - 1;
if ($prev == 0) {
    $prev = 1;
}
$next = $halamanaktif + 1;
if ($next > $halamanaktif) {
    $next = $next;
}
// $jumlahhalaman = 20;
if ($jumlahhalaman > 10) {
    $jumlahhalaman = 10;
}

if (isset($url[1])) {
    if ($url[1] == 'page') {
        if (isset($url[2])) {
            $halamanaktif =  $url[2];
            $startpagination = 1;
        }
        $awalidex = ($jumlahdataperhalaman * $halamanaktif) - $jumlahdataperhalaman;
        $prev = $halamanaktif - 1;
        if ($prev == 0) {
            $prev = 1;
        }
        $next = $halamanaktif + 1;
        if ($next > $halamanaktif) {
            $next = $next;
        }
        $query = "SELECT * from blog ORDER BY id DESC LIMIT $awalidex, $jumlahdataperhalaman";
        $datass = mysqli_query($conn, $query);
        $deskripsi = 'Informasi terkini yang ada di HIMAPTIKA FKIP ULM';
    } else {
        $query = "SELECT * from blog WHERE url = '$url[1]'";
        if (mysqli_num_rows(mysqli_query($conn, $query)) > 0) {
            $datas = mysqli_fetch_assoc(mysqli_query($conn, $query));
            $judul = $datas["judul"];
            $title = $datas["judul"];
            $deskripsi = $datas['deskripsi'];
            $gambar = $datas["gambar"];
            $waktu = $datas["waktu"];
            $isi = $datas["isi"];
            $startcomment = 1;
        } else {
            $isi = '<div class="alert alert-danger" role="alert">
                            Halaman tidak ditemukan
                        </div>';
        }
    }
} else {
    $query = "SELECT * from blog ORDER BY id DESC LIMIT $awalidex, $jumlahdataperhalaman";
    $startpagination = 1;
    $prev = $halamanaktif - 1;
    if ($prev == 0) {
        $prev = 1;
    }
    $next = $halamanaktif + 1;
    if ($next > $halamanaktif) {
        $next = $next;
    }
    $datass = mysqli_query($conn, $query);
    $deskripsi = 'Informasi terkini yang ada di HIMAPTIKA FKIP ULM';
}
// submit komentar
if (isset($_POST["submitkomen"])) {
    $nama = htmlspecialchars($_POST["nama"]);
    $komen = htmlspecialchars($_POST["komen"]);
    $link = $url[1];
    date_default_timezone_set('Asia/Kuala_Lumpur');
    $waktu = date("Y-m-d H:i:s");
    $query = "INSERT INTO komentar VALUES (0, '$nama', '$komen', '$waktu','$link') ";
    mysqli_query($conn, $query);
    // echo "Error : " . mysqli_error($conn);
}

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
        <div data-aos="fade-up" data-aos-duration="700" data-aos-easing="ease-in-in" data-aos-once="true" class="container">
            <div style="color: #9c1623;">.</div>
            <div class="row">
                <div class="col-lg-6">
                    <h1 id="judulcontent" class="mt-3 text" style="font-weight: bolder; font-size: 50px"><?= $judul ?></h1>
                    <?php if (isset($waktu)) : ?>
                        <p style="color: white;"><i class="fa-solid fa-calendar-check me-2"></i>Published : <?= $waktu ?></p>
                    <?php endif; ?>
                    <?php if (!isset($waktu)) : ?>
                        <p style="color: white;"><i class="fa-solid fa-calendar-check me-2"></i>Informasi Terkini yang Ada di HIMAPTIKA FKIP ULM</p>
                    <?php endif; ?>
                </div>
                <div class="col-lg-6 hide">
                    <!-- <i style="color: white;" class="fas fa-users fa-7x float-end mt-3"></i> -->
                    <i style="color: white;" class="fas fa-7x fa-newspaper icon hiden float-end mt-4"></i>
                </div>
            </div>

            <div style="color: #9c1623;">.</div>
        </div>
    </div>
    <!-- end banner -->
    <!-- content -->

    <div class="cont container">
        <div class="content container-lg">
            <div class="row">
                <div data-aos="fade-up" data-aos-duration="700" data-aos-easing="ease-in-in" data-aos-once="true" class="col-lg-9 p-4">
                    <?php if (isset($gambar)) {
                        echo '<img class="img-thumbnail rounded mx-auto d-block mb-5" width="500px" src="' . BASEURL . '/img/' . $gambar . '">';
                    }  ?>
                    <!-- content -->
                    <?php if (isset($datass)) : ?>
                        <?php if (mysqli_num_rows($datass) > 0) : ?>
                            <span class="badge bg-danger mb-4" style="background-color: #9c1623; font-size:large"><i class="fa-solid fa-1x fa-file-lines me-2"></i>Berita Terkini</span>
                            <p class="float-end text-muted">Page <?= $halamanaktif  ?> of <?= $jumlahhalaman  ?></p>
                            <?php while ($row = mysqli_fetch_assoc($datass)) : ?>
                                <div data-aos="fade-up" data-aos-duration="700" data-aos-easing="ease-in-in" data-aos-once="true" style="box-shadow: none;" class="card mb-3" style="max-width: 100%;">
                                    <div class="row ">
                                        <div class="col-md-2">
                                            <img style="object-fit: cover; width:100%" src="<?= BASEURL . '/img/' . $row["gambar"]  ?>" class="img-fluid rounded-start mb-2" alt="...">
                                        </div>
                                        <div class="col-md-10">
                                            <div class="card-body">
                                                <a href="<?= BASELINK ?>blog/<?= $row["url"] ?>" style="text-decoration: none; color:black">
                                                    <h5 style="font-size: 20px; font-weight: bold;" class="card-title"><?= $row["judul"] ?></h5>
                                                    <hr>
                                                    <p class="card-text"><?= $row["deskripsi"] ?></p>
                                                    <p class="card-text"><span class="badge bg-secondary me-2"><i class="fa-solid me-2 fa-clipboard"></i>Published : <?= $row["waktu"] ?></span><span class="badge mt-2 bg-secondary"><i class="fa-solid fa-pen-to-square me-2"></i>Updated : <?= $row["edit"] ?></span></p>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                            <?php endwhile ?>
                        <?php endif; ?>
                    <?php endif; ?>
                    <?php if (isset($isi)) : ?>
                        <?= $isi ?>
                    <?php endif; ?>
                    <?php if (isset($startpagination)) : ?>
                        <!-- pagination -->
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-center">
                                <li class="page-item <?php if ($prev == 1) {
                                                            echo "disabled";
                                                        } ?>">
                                    <a class="page-link" style="color: #9c1623;" href="<?= BASELINK . 'blog/page/' . $prev ?>">
                                        << </a>
                                </li>
                                <?php while ($i < $jumlahhalaman + 1) : ?>
                                    <li class="page-item"><a class="page-link" <?php if ($i != $halamanaktif) {
                                                                                    echo 'style="color: #9c1623;"';
                                                                                } ?> href="<?= BASELINK . 'blog/page/' . $i ?>"><?= $i ?></a></li>
                                    <?php $i++ ?>
                                <?php endwhile; ?>
                                <li class="page-item <?php if ($next > $jumlahhalaman) {
                                                            echo "disabled";
                                                        } ?>">
                                    <a class="page-link " style="color: #9c1623;" href="<?= BASELINK . 'blog/page/' . $next ?>">>></a>
                                </li>
                            </ul>
                        </nav>
                        <!-- endpagination -->
                    <?php endif; ?>
                    <?php if (isset($startcomment)) : ?>
                        <!-- komentar -->
                        <hr>
                        <span class="badge bg-danger mb-4" style="background-color: #9c1623; font-size:large"><i class="fa-solid fa-1x fa-comment me-2"></i>Tinggalkan Tanggapan</span>
                        <?php
                        $link = $url["1"];
                        $query = "SELECT * FROM komentar WHERE link = '$link' ORDER BY id ASC LIMIT 5";
                        $komen = mysqli_query($conn, $query);
                        ?>
                        <?php if (mysqli_num_rows($komen) > 0) : ?>
                            <?php while ($kom = mysqli_fetch_assoc($komen)) : ?>
                                <div class="card mb-3" style="box-shadow: none; border-style:solid;border-width:1px;border-color:#eeeeee">
                                    <h5 class="card-header"><?= $kom["nama"] ?><span class=" ms-2 text-muted float-end"><?= $kom["waktu"] ?></span></h5>
                                    <div class="card-body">
                                        <p class="card-text"><?= $kom["komen"] ?></p>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        <?php endif; ?>
                        <div style="padding: 8px; background-color:#eeeeee; border-radius:3px" class="wrapper">
                            <form method="POST" action="">
                                <div class="form-floating mb-3">
                                    <input type="name" class="form-control" name="nama" id="floatingInput" placeholder="name@example.com" required>
                                    <label for="floatingInput">Nama</label>
                                </div>
                                <div class="form-floating">
                                    <textarea class="form-control" name="komen" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px" required></textarea>
                                    <label for="floatingTextarea2">Komentar...</label>
                                </div>
                                <button type="submit" name="submitkomen" style="background-color: #9c1623; border-color:#9c1623" class="btn btn-primary btn-sm mt-3">Submit</button>
                            </form>
                        </div>
                        <!-- endkomentar -->
                    <?php endif; ?>
                </div>
                <div data-aos="fade-up" data-aos-duration="700" data-aos-easing="ease-in-in" data-aos-once="true" class="col-lg-3 p-4">
                    <div class="div">
                        <span class="badge bg-danger mb-4" style="background-color: #9c1623; font-size:large"><i class="fa-brands fa-youtube me-2 fa-1x"></i>Video Terbaru</span>
                    </div>
                    <iframe class="" allowfullscreen="allowfullscreen" mozallowfullscreen="mozallowfullscreen" msallowfullscreen="msallowfullscreen" oallowfullscreen="oallowfullscreen" webkitallowfullscreen="webkitallowfullscreen" width="100%" style="max-width: 325px;" src="https://www.youtube.com/embed/<?= $videoid ?>?rel=0"></iframe>
                    <?php
                    $query = 'SELECT * FROM blog ORDER BY id DESC LIMIT 3';
                    $post = mysqli_query($conn, $query);
                    ?>
                    <div class="div">
                        <span class="badge bg-danger mb-4 mt-4" style="background-color: #9c1623; font-size:large"><i class="fa-solid me-2 fa-clipboard fa-1x"></i>Post Lainnya</span>
                        <?php
                        $query = 'SELECT * FROM blog ORDER BY RAND() LIMIT 3';
                        $post = mysqli_query($conn, $query);
                        ?>
                        <?php while ($row = mysqli_fetch_assoc($post)) : ?>
                            <a href="<?= BASELINK ?>blog/<?= $row["url"] ?>" style="text-decoration: none; color:black">
                                <h4 style="font-weight: bold;"><?= $row["judul"] ?></h4>
                                <p class="card-text"> <?= $row["deskripsi"] ?></p>
                                <hr>
                            </a>
                        <?php endwhile; ?>
                    </div>
                </div>
            </div>



        </div>
    </div>


    <!-- endcontent -->

    <!-- footer -->
    <?php require_once 'element/footer.php'; ?>
    <!-- endfooter -->






    <!-- boostrap script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- aos script -->
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>

</html>