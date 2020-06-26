<?php
include "../connection/connection.php";
error_reporting(0);
$nik = $_POST['nik'];
$nama = $_POST['nama'];
$username = $_POST['username'];
$password = $_POST['password'];
$password2 = $_POST['password2'];
$foto = "default.jpg";
$telpon = $_POST['telpon'];

$reg = $_POST['reg'];

$cek_username = mysqli_num_rows(mysqli_query($conn, "SELECT username FROM masyarakat WHERE username='$username'"));
$cek_nik = mysqli_num_rows(mysqli_query($conn, "SELECT nik FROM masyarakat WHERE nik='$nik'"));

session_start();
if (isset($reg)) {
    $_SESSION['pos'] = $_POST;
}
if (isset($_SESSION['pos'])) {
    $nik = $_SESSION['pos']['nik'];
    $nama = $_SESSION['pos']['nama'];
    $username = $_SESSION['pos']['username'];
    $telpon = $_SESSION['pos']['telpon'];
}
if (isset($reg)) {
    if ($password == $password2) {
        $pass = password_hash($password, PASSWORD_DEFAULT);
        $saveToDatabase = $conn->query("INSERT INTO masyarakat(nik,nama,username,password,telpon,foto)VALUES('$nik','$nama','$username','$pass','$telpon','$foto')");
        if ($saveToDatabase) {
            unset($_SESSION['pos']);
?>
            <script>
                window.location.href = "login.php?message=login";
            </script>
<?php
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Pengaduan - Register</title>

    <!-- Custom fonts for this template-->
    <link href="../assets/vendor/fontawesome/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../assets/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5 col-lg-7 mx-auto">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Buat akun baru!</h1>
                            </div>
                            <form class="user" method="POST">
                                <div class="form-group">
                                    <input type="number" class="form-control form-control-user <?php echo $cek_nik == 1 ? 'is-invalid' : ''; ?>" value="<?php echo $nik ?>" id="nik" name="nik" placeholder="No NIK" required autofocus>
                                    <?php if ($cek_nik == 1) : ?>
                                        <small class="text-danger ml-3">No NIK sudah terdaftar.</small>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" value="<?php echo $nama ?>" id="nama" name="nama" placeholder="Nama lengkap" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user <?php echo $cek_username == 1 ? 'is-invalid' : ''; ?>" id="username" value="<?php echo $username ?>" name="username" placeholder="Username" required>
                                    <?php if ($cek_username == 1) : ?>
                                        <small class="text-danger ml-3">Username sudah terdaftar.</small>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user" id="repeat_pass" name="password2" placeholder="Konfirmasi Password" required>
                                    </div>
                                    <?php if ($password != $password2) : ?>
                                        <small class="text-danger ml-4">Password tidak cocok.</small>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user telp" value="<?php echo $telpon ?>" id="telpon" name="telpon" placeholder="No Telpon" required>
                                </div>
                                <button type="submit" name="reg" class="btn btn-primary btn-user btn-block mb-3">
                                    Register
                                </button>
                            </form>
                            <!-- <div class="text-center">
                                <a class="small" href="forgot-password.html">Forgot Password?</a>
                            </div> -->
                            <div class="text-center">
                                <a class="small" href="login.php">Sudah punya akun? Login!</a>
                            </div>
                            <div class="text-center">
                                <a href="../" class="small mt-3">Kembali ke index</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../assets/vendor/jquery/jquery.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../assets/js/sb-admin-2.min.js"></script>
    <script src="../assets/vendor/jquery/jquery.mask.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.telp').mask('0000-0000-00000');
        });
    </script>
</body>

</html>