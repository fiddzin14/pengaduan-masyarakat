<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Verifikasi Pengaduan</h6>
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
                        <th width="200">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $status = 0;
                    $no = 1;
                    $pengaduan = mysqli_query($conn, "SELECT * FROM pengaduan JOIN masyarakat ON pengaduan.nik=masyarakat.nik WHERE status=0 ORDER BY id_pengaduan DESC");
                    while ($data = $pengaduan->fetch_assoc()) {
                    ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo date("d-m-yy", $data['tgl_pengaduan']); ?></td>
                            <td><?php echo $data['nama']; ?></td>
                            <td><button type='button' style='cursor:default;' class='badge badge-danger'>0</button></td>
                            <td>
                                <a href="?page=pengaduan&action=detail&id_pengaduan=<?php echo $data['id_pengaduan']; ?>" class="btn btn-info btn-sm btn-icon-split">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-info"></i>
                                    </span>
                                    <span class="text">Detail</span>
                                </a>
                                <a href="?page=verifikasi&action=edit&id_pengaduan=<?php echo $data['id_pengaduan']; ?>" class="btn btn-primary btn-sm btn-icon-split">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-check"></i>
                                    </span>
                                    <span class="text">Konfirmasi</span>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>