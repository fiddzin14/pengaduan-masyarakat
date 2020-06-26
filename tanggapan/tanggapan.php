<?php
$id_pengaduan = $_GET['id_pengaduan'];
?>
<a href="?page=pengaduan" class="btn btn-primary btn-icon-split mb-3 ml-1">
    <span class="icon text-white-50">
        <i class="fas fa-arrow-left"></i>
    </span>
    <span class="text">Kembali</span>
</a>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Tanggapan</h6>
    </div>
    <div class="card-body">
        <form action="" method="POST">
            <div class="form-group">
                <label for="lap">*Isi Tanggapan</label>
                <textarea name="tanggapan" id="lap" class="form-control" rows="5" required></textarea>
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
$tgl_tanggapan = time();
$tanggapan = $_POST['tanggapan'];
$id_petugas = $user['id_petugas'];
$status = 2;

$save = $_POST['save'];

if ($save) {
    $saveToDatabase = $conn->query("INSERT INTO tanggapan(id_pengaduan,tgl_tanggapan,tanggapan,id_petugas)VALUES('$id_pengaduan','$tgl_tanggapan','$tanggapan','$id_petugas')");
    $saveToDatabas = $conn->query("UPDATE pengaduan SET status = '$status' WHERE id_pengaduan = '$id_pengaduan'");
    if ($saveToDatabase) {
?>
        <script>
            window.location.href = "?page=pengaduan&message=tanggapan";
        </script>
<?php
    }
}
?>