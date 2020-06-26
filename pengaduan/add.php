<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Buat laporan pengaduan</h6>
    </div>
    <div class="card-body">
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="lap">*Isi Laporan</label>
                <textarea name="isi_laporan" id="lap" class="form-control" rows="5" required></textarea>
            </div>
            <div class="form-group">
                <label for="image">Foto</label>
                <input type="file" name="image" id="image" class="form-control" required>
                <?php if ($error_img == true) : ?>
                    <small class="text-danger">File yang di upload bukan gambar!.</small>
                <?php endif; ?>
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
$tgl_pengaduan = time();
$nik = $user_m['nik'];
$isi_laporan = $_POST['isi_laporan'];
$status = 0;

$save = $_POST['save'];

if ($save) {
    $namaFile = $_FILES['image']['name'];
    $ukuran = $_FILES['image']['size'];
    $error = $_FILES['image']['error'];
    $tmpName = $_FILES['image']['tmp_name'];

    if ($error != 4) {
        $formatValid = ['jpg', 'jpeg', 'bmp', 'png'];
        $format = explode('.', $namaFile);
        $format = strtolower(end($format));

        if (!in_array($format, $formatValid)) {
            $error_img = true;
        } else {
            $namaGambar = uniqid();
            $namaGambar .= '.';
            $namaGambar .= $format;

            move_uploaded_file($tmpName, 'assets/img/upload/' . $namaGambar);
        }
    }
}

if ($save) {
    if ($error_img != true) {
        $saveToDatabase = $conn->query("INSERT INTO pengaduan(tgl_pengaduan,nik,isi_laporan,img,status)VALUES('$tgl_pengaduan','$nik','$isi_laporan','$namaGambar','$status')");
        if ($saveToDatabase) {
?>
            <script>
                window.location.href = "?page=pengaduan&message=add";
            </script>
<?php
        }
    }
}
?>