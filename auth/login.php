<?php
include "../connection/connection.php";
error_reporting(0);
$message = $_GET['message'];

session_start();
if (isset($_SESSION['log'])) {
    header("location:../dashboard.php");
    exit;
}
$_SESSION['pos'] = $_POST;
$username = $_SESSION['pos']['username'];

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $result_p = mysqli_query($conn, "SELECT * FROM petugas WHERE username = '$username'");
    $result_m = mysqli_query($conn, "SELECT * FROM masyarakat WHERE username = '$username'");

    //cek username
    if (mysqli_num_rows($result_p) === 1) {
        $row_p = mysqli_fetch_assoc($result_p);
        //cek password
        if (password_verify($password, $row_p['password'])) {
            unset($_SESSION['pos']);
            $_SESSION['log'] = true;
            $_SESSION['username'] = $row_p['username'];
            $_SESSION['level'] = $row_p['level'];

            if ($row_p['level'] == "admin") {
                header("location: ../dashboard.php");
                exit;
            } else {
                header("location: ../dashboard.php");
                exit;
            }
        } else {
            $error_pass = true;
        }
    } elseif (mysqli_num_rows($result_m) === 1) {
        $row = mysqli_fetch_assoc($result_m);
        //cek password
        if (password_verify($password, $row['password'])) {
            unset($_SESSION['pos']);
            $_SESSION['log_m'] = true;
            $_SESSION['nama'] = $row['nama'];
            $_SESSION['username'] = $row['username'];
            header("location: ../home.php");
            exit;
        } else {
            $error_pass = true;
        }
    } else {
        $error_user = true;
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

    <title>Pengaduan - Login</title>

    <!-- Custom fonts for this template-->
    <link href="../assets/vendor/fontawesome/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../assets/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-lg-6">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Silakan Login!!</h1>
                                    </div>
                                    <?php if ($message == "login") { ?>
                                        <div class="alert alert-success alert-dismissable fade show" role="alert">
                                            Kamu berhasil daftar silahkan login!
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    <?php } elseif ($message == "logout") { ?>
                                        <div class="alert alert-success alert-dismissable fade show" role="alert">
                                            Silakan login kembali
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    <?php } ?>
                                    <form class="user" method="POST" action="">
                                        <div class="form-group">
                                            <input type="text" name="username" value="<?php echo $username; ?>" class="form-control form-control-user <?php echo $error_user == true ? 'is-invalid' : ''; ?>" id="username" placeholder="Masukan Username..." required <?php echo $username == '' ? 'autofocus' : ''; ?>>
                                            <?php if (isset($error_user)) : ?>
                                                <small class="text-danger ml-3">Username tidak terdaftar.</small>
                                            <?php endif; ?>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" class="form-control form-control-user <?php echo $error_pass == true ? 'is-invalid' : ''; ?>" id="password" placeholder="Password" required <?php echo $error_pass == true ? 'autofocus' : ''; ?>>
                                            <?php if (isset($error_pass)) : ?>
                                                <small class="text-danger ml-3">Password salah.</small>
                                            <?php endif; ?>
                                        </div>
                                        <button type="submit" name="login" class="btn btn-primary btn-user btn-block mb-3">
                                            Login
                                        </button>
                                    </form>
                                    <!-- <div class="text-center">
                                        <a class="small" href="forgot-password.html">Forgot Password?</a>
                                    </div> -->
                                    <div class="text-center">
                                        <a class="small" href="registration.php">Belum punya akun? daftar!</a>
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

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../assets/vendor/jquery/jquery.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../assets/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="../assets/vendor/validator/validator.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../assets/js/sb-admin-2.min.js"></script>

</body>

</html>