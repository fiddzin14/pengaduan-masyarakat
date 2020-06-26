<?php

$cek_username = mysqli_num_rows(mysqli_query($conn, "SELECT username FROM masyarakat WHERE username='$_POST[username]'"));

$nik = $_GET['nik'];

$edit = $conn->query("SELECT * FROM masyarakat WHERE nik='$nik'");
$data = $edit->fetch_assoc();

?>
<a href="?page=masyarakat" class="btn btn-primary mb-3 ml-1"><i class="fas fa-arrow-left"></i> Kembali</a>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Edit data masyarakat</h6>
    </div>
    <div class="card-body">
        <form action="" id="validateForm" method="POST">
            <div class="form-group">
                <label for="nama">*Nama</label>
                <input type="text" name="nama" value="<?php echo $data['nama']; ?>" id="nama" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="username">*Username</label>
                <input type="text" name="username" value="<?php echo $data['username'] ?>" id="username" class="form-control <?php echo $cek_username == 1 ? 'is-invalid' : ''; ?>" required>
                <?php if ($cek_username == 1) : ?>
                    <small class="text-danger">Username sudah terdaftar.</small>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="telpon">*No Telpon</label>
                <input type="text" name="telpon" value="<?php echo $data['telpon'] ?>" id="telpon" class="form-control telp" required>
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
$nama = $_POST['nama'];
$username = $_POST['username'];
$telpon = $_POST['telpon'];

$save = $_POST['save'];
if ($save) {
    $saveToDatabase = $conn->query("UPDATE masyarakat SET nama = '$nama',username = '$username',telpon = '$telpon' WHERE nik = '$nik'");
    if ($saveToDatabase) {
?>
        <script>
            window.location.href = "?page=masyarakat&message=edit";
        </script>
<?php
    }
}

?>