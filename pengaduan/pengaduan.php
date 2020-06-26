<?php if ($_SESSION['level'] == 'admin') : ?>
    <a href="./laporan/pengaduan_excel.php" class="btn btn-success btn-icon-split mb-3 ml-1">
        <span class="icon text-white-50">
            <i class="fas fa-download"></i>
        </span>
        <span class="text">Export to excel</span>
    </a>
<?php endif; ?>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Pengaduan</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tanggal Pengaduan</th>
                        <th>Nama Pegadu</th>
                        <th>Status</th>
                        <th width="170">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    if ($_SESSION['level'] == "petugas") {
                        $pengaduan = mysqli_query($conn, "SELECT * FROM tanggapan RIGHT JOIN pengaduan ON pengaduan.id_pengaduan=tanggapan.id_pengaduan JOIN masyarakat ON pengaduan.nik=masyarakat.nik WHERE pengaduan.status!=0 ORDER BY id_tanggapan ASC");
                    } else {
                        $pengaduan = mysqli_query($conn, "SELECT * FROM tanggapan RIGHT JOIN pengaduan ON pengaduan.id_pengaduan=tanggapan.id_pengaduan JOIN masyarakat ON pengaduan.nik=masyarakat.nik ORDER BY status ASC");
                    }
                    while ($data = $pengaduan->fetch_assoc()) {
                    ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo date("d-m-yy", $data['tgl_pengaduan']); ?></td>
                            <td><?php echo $data['nama']; ?></td>
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
                            <td>
                                <?php if ($_SESSION['level'] == "petugas") : ?>
                                    <?php if ($data['status'] == 1) : ?>
                                        <a href="?page=pengaduan&action=detail&id_pengaduan=<?php echo $data['id_pengaduan']; ?>" class="btn btn-info btn-sm btn-icon-split">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-info"></i>
                                            </span>
                                            <span class="text">Detail</span>
                                        </a>
                                        <a href="?page=tanggapan&id_pengaduan=<?php echo $data['id_pengaduan']; ?>" class="btn btn-primary btn-sm btn-icon-split">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-pencil-alt"></i>
                                            </span>
                                            <span class="text">Tanggapi</span>
                                        </a>
                                    <?php elseif ($data['status'] == 2) : ?>
                                        <a href="?page=tanggapan&action=detail&id_tanggapan=<?php echo $data['id_tanggapan']; ?>" class="btn btn-info btn-sm btn-icon-split">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-info"></i>
                                            </span>
                                            <span class="text">Detail</span>
                                        </a>
                                    <?php else : ?>
                                        <a href="?page=pengaduan&action=detail&id_pengaduan=<?php echo $data['id_pengaduan']; ?>" class="btn btn-info btn-sm btn-icon-split">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-info"></i>
                                            </span>
                                            <span class="text">Detail</span>
                                        </a>
                                    <?php endif; ?>
                                <?php elseif ($data['status'] == 2) : ?>
                                    <a href="?page=tanggapan&action=detail&id_tanggapan=<?php echo $data['id_tanggapan']; ?>" class="btn btn-info btn-sm btn-icon-split">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-info"></i>
                                        </span>
                                        <span class="text">Detail</span>
                                    </a>
                                <?php else : ?>
                                    <a href="?page=pengaduan&action=detail&id_pengaduan=<?php echo $data['id_pengaduan']; ?>" class="btn btn-info btn-sm btn-icon-split">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-info"></i>
                                        </span>
                                        <span class="text">Detail</span>
                                    </a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>