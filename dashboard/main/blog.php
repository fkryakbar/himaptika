<?php
require_once "../../variable/absolute.php";
session_start();
if (!$_SESSION["login"] == "islogin") {
    header("Location:" . BASELINK . "login");
    exit;
}
$blog = query("SELECT * FROM blog ORDER BY id DESC");

if (isset($_POST["submit"])) {
    $url = $_POST["url"];
    // apakah ada url yang sama
    $query = "SELECT * FROM blog WHERE url='$url'";
    if (mysqli_num_rows(mysqli_query($conn, $query)) == 0) {
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

        // cek ukuran file
        if ($size <= 500000) {
            // query
            if ($extention == "png" || $extention == "jpg" || $extention == "jpeg") {
                $query = "INSERT INTO blog VALUES (0, '$url', '$judul', '$filename','$deskripsi' ,'$content', '$waktu','$waktu')";
                $success = mysqli_query($conn, $query);
                $error = "Error : " . mysqli_error($conn);
                echo $error;
                $_SESSION["operation"] = "error";
                // pindahkan file
                move_uploaded_file($tmpname, "../../public/img/" . $url . "." . $extention);
                $_SESSION["operation"] = "submit";
                require 'sitemap.php';
            }
        } else {
            $error = "ukuran file lebih dari 500kb";
            $_SESSION["operation"] = "error";
        }
    } else {
        $error = 'url sudah digunakan';
        $_SESSION["operation"] = "error";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once "element/head.php" ?>
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full" data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar" data-navbarbg="skin6">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <div class="navbar-header" data-logobg="skin6">
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <a class="navbar-brand" href="index.html">
                        <!-- Logo icon -->
                        <b class="logo-icon">
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon -->
                            <img src="../assets/images/logo-icon.png" alt="homepage" class="dark-logo" />
                            <!-- Light Logo icon -->
                            <img src="../assets/images/logo-light-icon.png" alt="homepage" class="light-logo" />
                        </b>
                        <!--End Logo icon -->
                        <!-- Logo text -->
                        <span class="logo-text">
                            <!-- dark Logo text -->
                            <img src="../assets/images/logo-text.png" alt="homepage" class="dark-logo" />
                            <!-- Light Logo text -->
                            <img src="../assets/images/logo-light-text.png" class="light-logo" alt="homepage" />
                        </span>
                    </a>
                    <!-- ============================================================== -->
                    <!-- End Logo -->
                    <!-- ============================================================== -->
                    <!-- This is for the sidebar toggle which is visible on mobile only -->
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="mdi mdi-menu"></i></a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->

                    <!-- ============================================================== -->
                    <!-- Right side toggle and nav items -->
                    <!-- ============================================================== -->
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->


        <?php require_once "element/sidebar.php" ?>

        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row align-items-center">
                    <div class="col-6">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 d-flex align-items-center">
                                <li class="breadcrumb-item"><a href="index.html" class="link"><i class="mdi mdi-home-outline fs-4"></i></a></li>
                                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                            </ol>
                        </nav>
                        <h1 class="mb-0 fw-bold">Blog</h1>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Sales chart -->
                <!-- ============================================================== -->
                <div class="card" style="padding: 30px;">
                    <form method="POST" action="" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">URL</label>
                            <input class="form-control" name="url" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Judul</label>
                            <input class="form-control" name="judul" id="exampleInputPassword1" required>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Deskripsi</label>
                            <input class="form-control" name="deskripsi" id="exampleInputPassword1" required>
                        </div>
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Cover</label>
                            <div style="display: inline-block;" class="text-muted">max 500kb</div>
                            <input class="form-control" name="cover" type="file" id="formFile" required>
                        </div>

                        <textarea style="height:fit-content;" name="content" id="mytextarea"></textarea>

                        <button type="submit" name="submit" class="btn btn-primary mt-3">Submit</button>


                    </form>
                </div>
                <div class="row">
                    <!-- column -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <!-- title -->
                                <div class="d-md-flex">
                                    <div>
                                        <h4 class="card-title">Blog</h4>
                                        <h5 class="card-subtitle">Blog Himaptika</h5>
                                    </div>
                                </div>
                                <!-- title -->
                                <div class="table-responsive">
                                    <table class="table mb-0 table-hover align-middle text-nowrap">
                                        <thead>
                                            <tr>
                                                <th class="border-top-0">Id</th>
                                                <th class="border-top-0">Url</th>
                                                <th class="border-top-0">Judul</th>
                                                <th class="border-top-0">Gambar</th>
                                                <th class="border-top-0">Waktu</th>
                                                <th class="border-top-0">Edit</th>
                                                <th class="border-top-0">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php while ($row = mysqli_fetch_assoc($blog)) : ?>
                                                <tr>
                                                    <td>
                                                        <?= $row["id"] ?>
                                                    </td>
                                                    <td>
                                                        <?= $row["url"] ?>
                                                    </td>
                                                    <td>
                                                        <?= $row["judul"] ?>
                                                    </td>
                                                    <td>
                                                        <?= $row["gambar"] ?>
                                                    </td>
                                                    <td>
                                                        <?= $row["waktu"] ?>
                                                    </td>
                                                    <td>
                                                        <?= $row["edit"] ?>
                                                    </td>
                                                    <td>
                                                        <a href="<?= BASELINK . "edit/" . $row['id'] ?>" class="btn badge bg-primary">Edit</a> <button onclick="index('<?= $row['url'] ?>')" class="btn badge bg-success ">Index</button> <button onclick="hapus(<?= $row['id'] ?>)" class="btn badge bg-danger">Delete</button>
                                                    </td>

                                                </tr>
                                            <?php endwhile; ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                ...
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer text-center">
                All Rights Reserved by Flexy Admin. Designed and Developed by <a href="https://www.wrappixel.com">WrapPixel</a>.
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../dist/js/app-style-switcher.js"></script>
    <!--Wave Effects -->
    <script src="../dist/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="../dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="../dist/js/custom.js"></script>
    <!--This page JavaScript -->
    <!--chartis chart-->
    <script src="../assets/libs/chartist/dist/chartist.min.js"></script>
    <script src="../assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>
    <script src="../dist/js/pages/dashboards/dashboard1.js"></script>
    <script>
        <?php if ($_SESSION["operation"] == "simpan") : ?>
            Swal.fire({
                icon: 'success',
                title: 'Blog berhasil disimpan',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Ok',
                showConfirmButton: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = window.location.href;
                }
            })
            <?php $_SESSION["operation"] = "login"; ?>
        <?php endif; ?>

        <?php if ($_SESSION["operation"] == "submit") : ?>
            Swal.fire({
                icon: 'success',
                title: 'Blog berhasil disubmit',
                text: "<?= $error ?>",
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Ok',
                showConfirmButton: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = window.location.href;
                }
            })
            <?php $_SESSION["operation"] = "login"; ?>
        <?php endif; ?>

        <?php if ($_SESSION["operation"] == "error") : ?>
            <?php $_SESSION["operation"] = "login"; ?>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '<?= $error ?>',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Ok',
                showConfirmButton: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = window.location.href;
                }
            })

        <?php endif; ?>

        function ajax(id, op) {
            const ajax = new XMLHttpRequest()
            ajax.onreadystatechange = function() {
                if (ajax.readyState == 4 && ajax.status == 200) {
                    Swal.fire({
                        text: "Blog Berhasil Dihapus",
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Ok'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = window.location.href;
                        }
                    })
                }
            }
            ajax.open("get", `admin.php?${op}=${id}`)
            ajax.send()
        }

        function hapus(id) {
            Swal.fire({
                title: 'Yakin mau mengahapus?',
                text: "Blog tidak dapat dikembalikan",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    ajax(id, "hapus")
                }
            })
        }

        function index(url) {
            const ajax = new XMLHttpRequest()
            ajax.onreadystatechange = function() {
                if (ajax.response == 200) {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })

                    Toast.fire({
                        icon: 'success',
                        title: 'Link Berhasil di Index'
                    })

                } else if (ajax.response == 400) {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })

                    Toast.fire({
                        icon: 'error',
                        title: 'Link Gagal di Index'
                    })

                }
            }
            ajax.open('get', `admin.php?index=${url}`)
            ajax.send()
        }
    </script>
</body>

</html>