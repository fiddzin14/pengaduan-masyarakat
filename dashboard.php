<?php
include "connection/connection.php";
error_reporting(0);

session_start();
if (!isset($_SESSION['log'])) {
    header("location: auth/login.php");
    exit;
}

$page = $_GET['page'];
$action = $_GET['action'];

$edit = $conn->query("SELECT * FROM petugas WHERE username='$_SESSION[username]'");
$user = $edit->fetch_assoc();

$status_blm = mysqli_query($conn, "SELECT * FROM pengaduan WHERE status = 0");
$count_baru = mysqli_num_rows($status_blm);

$masyarakat = mysqli_query($conn, "SELECT * FROM masyarakat");
$count_ms = mysqli_num_rows($masyarakat);

$status_prs = mysqli_query($conn, "SELECT * FROM pengaduan WHERE status = 1");
$count_proses = mysqli_num_rows($status_prs);

$status_sls = mysqli_query($conn, "SELECT * FROM pengaduan WHERE status = 2");
$count_selesai = mysqli_num_rows($status_sls);
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Pengaduan-masyarakat</title>

    <!-- Custom fonts for this template-->
    <link href="assets/vendor/fontawesome/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="assets/vendor/sweetalert/dist/sweetalert2.all.min.js"></script>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-keyboard"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Pengaduan</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item <?php echo $page == '' ? 'active' : '' ?>">
                <a class="nav-link" href="dashboard.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">
            <!-- Heading -->
            <div class="sidebar-heading">
                pengaduan
            </div>
            <?php if ($_SESSION['level'] == 'admin') : ?>
                <li class="nav-item <?php echo $page == 'petugas' ? 'active' : '' ?>">
                    <a class="nav-link" href="?page=petugas">
                        <i class="fas fa-fw fa-user"></i>
                        <span>Petugas</span></a>
                </li>

                <li class="nav-item <?php echo $page == 'masyarakat' ? 'active' : '' ?>">
                    <a class="nav-link" href="?page=masyarakat">
                        <i class="fas fa-fw fa-users"></i>
                        <span>Masyarakat</span></a>
                </li>
                <li class="nav-item <?php echo $page == 'pengaduan' ? 'active' : '' ?>">
                    <a class="nav-link" href="?page=pengaduan">
                        <i class="fas fa-fw fa-file-alt"></i>
                        <span>Pengaduan</span></a>
                </li>

            <?php elseif ($_SESSION['level'] == 'petugas') : ?>
                <li class="nav-item <?php echo $page == 'verifikasi' ? 'active' : '' ?>">
                    <a class="nav-link" href="?page=verifikasi">
                        <i class="fas fa-fw fa-check"></i>
                        <span>Verifikasi</span></a>
                </li>
                <li class="nav-item <?php echo $page == 'pengaduan' ? 'active' : '' ?>">
                    <a class="nav-link" href="?page=pengaduan">
                        <i class="fas fa-fw fa-file-alt"></i>
                        <span>Pengaduan</span></a>
                </li>
            <?php endif; ?>
            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            <li class="nav-item">
                <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-fw fa-sign-out-alt"></i>
                    <span>Logout</span></a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">
            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar)
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button> -->
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $user['nama_petugas']; ?></span>
                                <img class="img-profile rounded-circle" src="assets/img/profile/default.jpg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <?php
                    if ($_SESSION['level'] == 'admin') {
                        if ($page == "petugas") {
                            if ($action == "") {
                                include "petugas/petugas.php";
                            } elseif ($action == "add") {
                                include "petugas/add.php";
                            } elseif ($action == "edit") {
                                include "petugas/edit.php";
                            } elseif ($action == "delete") {
                                include "petugas/delete.php";
                            }
                        } elseif ($page == "masyarakat") {
                            if ($action == "") {
                                include "masyarakat/masyarakat.php";
                            } elseif ($action == "add") {
                                include "masyarakat/add.php";
                            } elseif ($action == "delete") {
                                include "masyarakat/delete.php";
                            } elseif ($action == "edit") {
                                include "masyarakat/edit.php";
                            }
                        } elseif ($page == "pengaduan") {
                            if ($action == "") {
                                include "pengaduan/pengaduan.php";
                            } elseif ($action == "detail") {
                                include "pengaduan/detail.php";
                            }
                        } elseif ($page == "tanggapan") {
                            if ($action == "detail") {
                                include "tanggapan/detail.php";
                            }
                        }
                    } elseif ($_SESSION['level'] == 'petugas') {
                        if ($page == "pengaduan") {
                            if ($action == "") {
                                include "pengaduan/pengaduan.php";
                            } elseif ($action == "detail") {
                                include "pengaduan/detail.php";
                            }
                        } elseif ($page == "profile") {
                            if ($action == "") {
                                include "profile/profile.php";
                            } elseif ($action == "edit") {
                                include "profile/edit.php";
                            }
                        } elseif ($page == "tanggapan") {
                            if ($action == "") {
                                include "tanggapan/tanggapan.php";
                            } elseif ($action == "detail") {
                                include "tanggapan/detail.php";
                            }
                        } elseif ($page == "verifikasi") {
                            if ($action == "") {
                                include "verifikasi/verifikasi.php";
                            } elseif ($action == "edit") {
                                include "verifikasi/edit.php";
                            }
                        }
                    }
                    ?>

                    <?php if ($page == "") : ?>
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                        </div>
                        <div class="row">
                            <!-- Earnings (Monthly) Card Example -->
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-primary shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Masyarakat</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $count_ms; ?></div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-user fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Earnings (Monthly) Card Example -->
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-info shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">pengaduan baru</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $count_baru; ?></div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-file-alt fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Earnings (Monthly) Card Example -->
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-warning shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Status Proses</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $count_proses; ?></div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-comment fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Pending Requests Card Example -->
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-success shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Status Selesai</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $count_selesai; ?></div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-comments fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Fiddzin_14 All Right Reserved 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">logout?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Apakah kamu yakin mau logout.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="auth/logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="assets/js/sb-admin-2.min.js"></script>
    <!-- Page level plugins -->
    <script src="assets/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="assets/vendor/jquery/jquery.mask.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="assets/js/demo/datatables-demo.js"></script>
    <script src="assets/js/message.js"></script>

    <script>
        $(document).ready(function() {
            $('.telp').mask('0000-0000-00000');
        });
    </script>
</body>

</html>