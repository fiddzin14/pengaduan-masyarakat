<?php
$id_pengaduan = $_GET['id_pengaduan'];

$edit = $conn->query("SELECT * FROM pengaduan JOIN masyarakat ON pengaduan.nik=masyarakat.nik  AND id_pengaduan='$id_pengaduan'");
$data = $edit->fetch_assoc();

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
                <img src="assets/img/upload/<?php echo $data['img'] ?>" width="300" alt="gambar">
            </div>
            <div class="col-md-8">
                <table class="table table-hover">
                    <tr>
                        <th width="250">Tanggal Pengaduan</th>
                        <td><?php echo date("d-m-yy", $data['tgl_pengaduan']); ?></td>
                    </tr>
                    <tr>
                        <th>Nama Pengadu</th>
                        <td><?php echo $data['nama']; ?></td>
                    </tr>
                    <tr>
                        <th>Isi Laporan</th>
                        <td><?php echo $data['isi_laporan']; ?></td>
                    </tr>
                    <tr>
                        <th>Tanggapan</th>
                        <td>-</td>
                    </tr>
                    <tr>
                        <th>Tanggal Tanggapan</th>
                        <td>-</td>
                    </tr>
                    <tr>
                        <th>Petugas</th>
                        <td>-</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            <?php
                            switch ($data['status']) {
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
                <?php if ($_SESSION['level'] == "petugas") : ?>
                    <?php if ($data['status'] == 0) : ?>
                        <a href="?page=verifikasi&action=edit&id_pengaduan=<?php echo $id_pengaduan ?>" class="btn btn-primary btn-sm btn-icon-split mt-3">
                            <span class="icon text-white-50">
                                <i class="fas fa-check"></i>
                            </span>
                            <span class="text">Konfirmasi</span>
                        </a>
                    <?php elseif ($data['status'] == 1) : ?>
                        <a href="?page=tanggapan&id_pengaduan=<?php echo $id_pengaduan ?>" class="btn btn-primary btn-sm btn-icon-split mt-3">
                            <span class="icon text-white-50">
                                <i class="fas fa-pencil-alt"></i>
                            </span>
                            <span class="text">Tanggapi</span>
                        </a>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>