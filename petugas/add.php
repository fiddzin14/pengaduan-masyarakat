<?php

$nama = $_POST['nama_petugas'];
$username = $_POST['username'];
$password = $_POST['password'];
$password2 = $_POST['password2'];
$telpon = $_POST['telpon'];
$level = $_POST['level'];
$foto = "default.jpg";

$save = $_POST['save'];

$cek_username = mysqli_num_rows(mysqli_query($conn, "SELECT username FROM petugas WHERE username='$username'"));

if (isset($save)) {
    $_SESSION['pos'] = $_POST;
    $nama_petugas = $_SESSION['pos']['nama_petugas'];
    $username = $_SESSION['pos']['username'];
    $telpon = $_SESSION['pos']['telpon'];
}
?>
<a href="?page=petugas" class="btn btn-primary btn-icon-split mb-3 ml-1">
    <span class="icon text-white-50">
        <i class="fas fa-arrow-left"></i>
    </span>
    <span class="text">Kembali</span>
</a>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Tambah data petugas</h6>
    </div>
    <div class="card-body">
        <form action="" id="validateForm" method="POST">
            <div class="form-group">
                <label for="nama_petugas">*Nama Petugas</label>
                <input type="text" name="nama_petugas" value="<?php echo $nama_petugas; ?>" id="nama_petugas" class="form-control" required>
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
                <label for="level">*Level</label>
                <select name="level" id="level" class="form-control">
                    <option value="admin">Admin</option>
                    <option value="petugas">Petugas</option>
                </select>
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
        $saveToDatabase = $conn->query("INSERT INTO petugas(nama_petugas,username,password,telpon,foto,level)VALUES('$nama','$username','$pass','$telpon','$foto','$level')");
        if ($saveToDatabase) {
            unset($_SESSION['pos']);
?>
            <script>
                window.location.href = "?page=petugas&message=add";
            </script>
<?php
        }
    }
}
?>