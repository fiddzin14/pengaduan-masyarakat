<?php
$cek_username = mysqli_num_rows(mysqli_query($conn, "SELECT username FROM petugas WHERE username='$_POST[username]'"));
$id_petugas = $_GET['id_petugas'];

$edit = $conn->query("SELECT * FROM petugas WHERE id_petugas='$id_petugas'");
$data = $edit->fetch_assoc();

?>
<a href="?page=petugas" class="btn btn-primary btn-icon-split mb-3 ml-1">
    <span class="icon text-white-50">
        <i class="fas fa-arrow-left"></i>
    </span>
    <span class="text">Kembali</span>
</a>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Edit data petugas</h6>
    </div>
    <div class="card-body">
        <form action="" method="POST">
            <div class="form-group">
                <label for="nama_petugas">*Nama Petugas</label>
                <input type="text" name="nama_petugas" value="<?php echo $data['nama_petugas']; ?>" id="nama_petugas" class="form-control" required>
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
                <label for="lvl">*Level</label>
                <select name="level" id="lvl" class="form-control">
                    <?php if ($data['level'] == "admin") : ?>
                        <option value="admin" selected>Admin</option>
                        <option value="petugas">Petugas</option>
                    <?php else : ?>
                        <option value="admin">Admin</option>
                        <option value="petugas" selected>Petugas</option>
                    <?php endif; ?>
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
$nama = $_POST['nama_petugas'];
$username = $_POST['username'];
$telpon = $_POST['telpon'];
$level = $_POST['level'];

$save = $_POST['save'];
if ($save) {
    $saveToDatabase = $conn->query("UPDATE petugas SET nama_petugas = '$nama',username = '$username',telpon = '$telpon',foto = '$namaGambar', level = '$level' WHERE id_petugas = '$id_petugas'");
    if ($saveToDatabase) {
?>
        <script>
            window.location.href = "?page=petugas&message=edit";
        </script>
<?php
    }
}

?>