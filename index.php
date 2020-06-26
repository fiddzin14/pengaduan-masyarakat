<?php
include "connection/connection.php";
error_reporting(0);
session_start();
if (isset($_SESSION['log_m'])) {
  header("location: home.php");
  exit;
}
if (isset($_SESSION['log'])) {
  header("location: dashboard.php");
  exit;
}

$pengaduan = mysqli_query($conn, "SELECT * FROM pengaduan");
$count_all = mysqli_num_rows($pengaduan);

?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- CSS -->
  <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/vendor/fontawesome/css/all.min.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <title>Pengaduan Masyarakat!</title>
</head>

<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
      <a class="navbar-brand" href="#">Pengaduan Online <i class="fas fa-comments"></i></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <div class="navbar-nav ml-auto">
          <a class="nav-item nav-link" href="auth/login.php">Login</a>
          <a class="nav-item btn btn-outline-white" href="auth/registration.php">Register</a>
        </div>
      </div>
    </div>
  </nav>

  <!-- Jumbotron -->
  <div class="jumbotron jum-header jumbotron-fluid">
    <div class="container">
      <h2>Layanan Aspirasi dan Pengaduan Online Masyarakat</h2>
      <p>Sampaikan Laporan Anda langsung kepada instansi pemerintah berwenang</p>
      <hr>
    </div>
  </div>

  <!-- Container -->
  <div class="container">
    <!-- Form panel -->
    <div class="row justify-content-center">
      <div class="col-8 form-panel">
        <form action="auth/login.php">
          <textarea name="" id="" rows="10" class="form-control" placeholder="Isi Laporan"></textarea>
          <div class="form-group">
            <input type="file" class="form-control">
          </div>
          <hr>
          <div class="form-group float-right">
            <input type="submit" value="Lapor!" class="btn btn-primary">
          </div>
        </form>
      </div>
    </div>

    <div class="row justify-content-center">
      <div class="col-lg-8 garis"></div>
    </div>

    <!-- Info Panel -->
    <div class="row justify-content-center">
      <div class="col-11">
        <div class="row">
          <div class="col-md text-center info-panel">
            <div href="#" class="btn btn-primary icon mb-2">
              <i class="fas fa-edit"></i>
            </div>
            <h4>Tulis Laporan</h4>
            <p>
              Laporan keluhan anda dengan lengkap dan jelas
            </p>
          </div>
          <div class="col-md text-center info-panel">
            <div href="#" class="btn btn-light icon mb-2">
              <i class="fas fa-share"></i>
            </div>
            <h4>Proses Verifikasi</h4>
            <p>
              Laporan anda akan diverifikasi dan di tindak lanjut oleh instansi berwenang
            </p>
          </div>
          <div class="col-md text-center info-panel">
            <div href="#" class="btn btn-light icon mb-2">
              <i class="far fa-comment-dots"></i>
            </div>
            <h4>Tanggapan</h4>
            <p>
              Laporan anda akan di tanggapi oleh instansi.
            </p>
          </div>
          <div class="col-md text-center info-panel">
            <div href="#" class="btn btn-light icon mb-2">
              <i class="fas fa-check"></i>
            </div>
            <h4>Selesai</h4>
            <p>
              Laporan pengaduan selesai.
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="jumbotron jum-info jumbotron-fluid">
    <div class="container">
      <h2 class="display-4">Jumlah Laporan Sekarang</h2>
      <p><?php echo $count_all; ?></p>
    </div>
  </div>

  <footer class="sticky-footer">
    <div class="container my-auto">
      <div class="copyright text-center my-auto">
        <span>Copyright &copy; Fiddzin_14 2020</span>
      </div>
    </div>
  </footer>
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->


  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/js/message.js"></script>
</body>

</html>