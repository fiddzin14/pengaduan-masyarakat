<?php
$nik = $_POST['nik'];
$nama = $_POST['nama'];
$username = $_POST['username'];
$password = $_POST['password'];
$password2 = $_POST['password2'];
$telpon = $_POST['telpon'];
$foto = "default.jpg";

$save = $_POST['save'];

$cek_username = mysqli_num_rows(mysqli_query($conn, "SELECT username FROM masyarakat WHERE username='$username'"));
$cek_nik = mysqli_num_rows(mysqli_query($conn, "SELECT nik FROM masyarakat WHERE nik='$nik'"));

session_start();
if (isset($save)) {
    $_SESSION['pos'] = $_POST;
}
if (isset($_SESSION['pos'])) {
    $nik = $_SESSION['pos']['nik'];
    $nama = $_SESSION['pos']['nama'];
    $username = $_SESSION['pos']['username'];
    $telpon = $_SESSION['pos']['telpon'];
}
?>
<a href="?page=masyarakat" class="btn btn-primary btn-icon-split mb-3 ml-1">
    <span class="icon text-white-50">
        <i class="fas fa-arrow-left"></i>
    </span>
    <span class="text">Kembali</span>
</a>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Tambah data masyarakat</h6>
    </div>
    <div class="card-body">
        <form action="" method="POST">
            <div class="form-group">
                <label for="nik">*NIK</label>
                <input type="text" name="nik" value="<?php echo $nik; ?>" id="nik" class="form-control <?php echo $cek_nik == 1 ? 'is-invalid' : ''; ?>" required>
                <?php if ($cek_nik == 1) : ?>
                    <small class="text-danger">No NIK sudah terdaftar.</small>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="nama">*Nama</label>
                <input type="text" name="nama" value="<?php echo $nama; ?>" id="nama" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="username">*Username</label>
                <input type="text" name="username" value="<?php echo $username ?>" id="username" class="form-control <?php echo $cek_username == 1 ? 'is-invalid' : ''; ?>" required>
                <?php if ($cek_username == 1) : ?>
                    <small class="text-danger">Username sudah terdaftar.</small>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="password">*Password</label>
                <input type="password" name="password" minlength="4" id="password" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password2">*Konfirmasi Password</label>
                <input type="password" name="password2" id="password2" class="form-control" required>
                <?php if ($password != $password2) : ?>
                    <small class="text-danger">Password tidak cocok.</small>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="telpon">*No Telpon</label>
                <input type="text" name="telpon" value="<?php echo $telpon ?>" id="telpon" class="form-control telp" required>
            </div>
            <div class="form-group">
                <input type="submit" value="Simpan" name="save" class="btn btn-success">
            </div>
        </form>
    </div>
    <div class="card-footer">
        <small>(*) Harus diisi</small>
    </div>
</div>
<?php
if ($save) {
    if ($password == $password2) {
        $pass = password_hash($password, PASSWORD_DEFAULT);
        $saveToDatabase = $conn->query("INSERT INTO masyarakat(nik,nama,username,password,telpon,foto)VALUES('$nik','$nama','$username','$pass','$telpon','$foto')");
        if ($saveToDatabase) {
            unset($_SESSION['pos']);
?>
            <script>
                window.location.href = "?page=masyarakat&message=add";
            </script>
<?php
        }
    }
}
?>