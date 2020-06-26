<?php
$id_tanggapan = $_GET['id_tanggapan'];

$edit = $conn->query("SELECT * FROM tanggapan JOIN petugas ON tanggapan.id_petugas=petugas.id_petugas WHERE id_tanggapan='$id_tanggapan'");
$data = $edit->fetch_assoc();

$edit_t = $conn->query("SELECT * FROM pengaduan JOIN tanggapan ON pengaduan.id_pengaduan=tanggapan.id_pengaduan JOIN masyarakat ON pengaduan.nik=masyarakat.nik AND id_tanggapan='$id_tanggapan'");
$data_t = $edit_t->fetch_assoc();

?>
<a href="javascript:history.back()" class="btn btn-primary btn-icon-split mb-3 ml-1">
    <span class="icon text-white-50">
        <i class="fas fa-arrow-left"></i>
    </span>
    <span class="text">Kembali</span>
</a>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Detail Pengaduan</h6>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <img src="assets/img/upload/<?php echo $data_t['img'] ?>" width="300" alt="gambar">
            </div>
            <div class="col-md-8">
                <table class="table table-hover">
                    <tr>
                        <th width="300">Tanggal Pengaduan</th>
                        <td><?php echo date("d-m-yy", $data_t['tgl_pengaduan']); ?></td>
                    </tr>
                    <tr>
                        <th>Nama Pengadu</th>
                        <td><?php echo $data_t['nama']; ?></td>
                    </tr>
                    <tr>
                        <th>Isi Laporan</th>
                        <td><?php echo $data_t['isi_laporan']; ?></td>
                    </tr>
                    <tr>
                        <th>Tanggapan</th>
                        <td><?php echo $data['tanggapan']; ?></td>
                    </tr>
                    <tr>
                        <th>Tanggal Tanggapan</th>
                        <td><?php echo date("d-m-yy", $data['tgl_tanggapan']); ?></td>
                    </tr>
                    <tr>
                        <th>Petugas</th>
                        <td><?php echo $data['nama_petugas']; ?></td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            <?php
                            switch ($data_t['status']) {
                                case '1':
                                    echo "<button type='button' style='cursor:default;' class='badge badge-warning'>Proses</button>";
                                    break;
                                case '2':
                                    echo "<button type='button' style='cursor:default;' class='badge badge-success'>Selesai</button>";
                                    break;
                                default:
                                    echo "<button type='button' style='cursor:default;' class='badge badge-danger'>0</button>";
                                    break;
                            }
                            ?>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>