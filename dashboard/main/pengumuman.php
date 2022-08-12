<?php
require_once "../../variable/absolute.php";
session_start();
if (!$_SESSION["login"] == "islogin") {
    header("Location:" . BASELINK . "login");
    exit;
}



$pengumuman = query("SELECT * FROM sosial");


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
                        <h1 class="mb-0 fw-bold">Pengumuman</h1>
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
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card p-4">
                            <div class="card-body">
                                <h4 class="card-title">Pengumuman</h4>
                            </div>
                            <div class="table-responsive">
                                <table class="table mb-0 table-hover align-middle text-nowrap">
                                    <thead>
                                        <tr>
                                            <th class="border-top-0">Id</th>
                                            <th class="border-top-0">Judul</th>
                                            <th class="border-top-0">Link</th>
                                            <th class="border-top-0">Kategori</th>
                                            <th class="border-top-0">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($row = mysqli_fetch_assoc($pengumuman)) : ?>
                                            <tr>
                                                <td>
                                                    <?= $row["id"] ?>
                                                </td>
                                                <td>
                                                    <?= $row["judul"] ?>
                                                </td>
                                                <td>
                                                    <?= $row["link"] ?>
                                                </td>
                                                <td>
                                                    <?= $row["kategori"] ?>
                                                </td>
                                                <td>
                                                    <button data-bs-toggle="modal" data-id="<?= $row["id"] ?>" data-bs-target="#exampleModal" class="btn badge bg-primary edit">Edit</button> <button onclick="hapus(<?= $row['id'] ?>)" class="btn badge bg-danger">Delete</button>
                                                </td>

                                            </tr>
                                        <?php endwhile; ?>

                                    </tbody>
                                </table>
                                <div class="row mt-4">
                                    <div class="col-4">
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput1" class="form-label">Judul</label>
                                            <input type="email" id="judul" class="form-control" value="" id="exampleFormControlInput1">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput1" class="form-label">Link</label>
                                            <input type="email" id="link" class="form-control" value="" id="exampleFormControlInput1">
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput1" class="form-label">Kategori</label>
                                            <input type="email" id="kategori" class="form-control" value="" id="exampleFormControlInput1">
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <label for="exampleFormControlInput1" class="form-label">Submit</label><br>
                                        <button type="submit" name="submit" id="submit" class="btn badge bg-primary">Submit</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit Pengumuman</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Judul</label>
                                    <input type="email" id="editjudul" class="form-control" value="" id="exampleFormControlInput1">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Link</label>
                                    <input type="email" id="editlink" class="form-control" value="" id="exampleFormControlInput1">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlTextarea1" class="form-label">Kategori</label>
                                    <textarea class="form-control" id="editkategori" id="exampleFormControlTextarea1" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <a type="button" onclick="simpan()" class="btn btn-primary">Save changes</a>
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
        const submit = document.querySelector("#submit")
        submit.addEventListener("click", function() {
            const ajax = new XMLHttpRequest()
            const judul = document.querySelector("#judul").value
            const link = document.querySelector("#link").value
            const kategori = document.querySelector("#kategori").value
            ajax.onreadystatechange = function() {
                if (ajax.readyState == 4 && ajax.status == 200) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Pengumuman berhasil ditambahkan',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Ok',
                        showConfirmButton: true,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = window.location.href;
                        }
                    })
                }
            }
            ajax.open("get", `admin.php?judul=${judul}&link=${link}&kategori=${kategori}`)
            ajax.send()
        })

        function hapus(id) {
            Swal.fire({
                title: 'Yakin mau mengahapus?',
                text: "Pengumuman tidak dapat dikembalikan",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    const ajax = new XMLHttpRequest()
                    ajax.onreadystatechange = function() {
                        if (ajax.readyState == 4 && ajax.status == 200) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Pengumuman berhasil dihapus',
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'Ok',
                                showConfirmButton: true,
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = window.location.href;
                                }
                            })
                        }
                    }
                    ajax.open("get", `admin.php?hapuspengumuman=${id}`)
                    ajax.send()
                }
            })

        }

        const editmodal = document.querySelectorAll(".edit")
        editmodal.forEach(function(btn) {
            btn.addEventListener("click", function() {
                const ajax = new XMLHttpRequest()
                ajax.onreadystatechange = function() {
                    if (ajax.readyState == 4 && ajax.status == 200) {
                        const modalcontent = document.querySelector(".modal-content")
                        modalcontent.innerHTML = ajax.response
                    }
                }
                ajax.open("get", `admin.php?getpengumuman=${btn.dataset.id}`)
                ajax.send()
            })
        })

        function simpan(id) {
            const editjudul = document.querySelector("#editjudul").value
            const editlink = document.querySelector("#editlink").value
            const editkategori = document.querySelector("#editkategori").value
            const ajax = new XMLHttpRequest()
            ajax.onreadystatechange = function() {
                if (ajax.readyState == 4 && ajax.status == 200) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Pengumuman berhasil disimpan',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Ok',
                        showConfirmButton: true,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = window.location.href;
                        }
                    })
                }
            }
            ajax.open("get", `admin.php?id=${id}&editjudul=${editjudul}&editlink=${editlink}&editkategori=${editkategori}`)
            ajax.send()
        }
    </script>
</body>

</html>