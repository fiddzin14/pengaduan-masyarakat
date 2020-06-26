<a href="?page=petugas&action=add" class="btn btn-primary btn-icon-split mb-3 ml-1">
    <span class="icon text-white-50">
        <i class="fas fa-plus"></i>
    </span>
    <span class="text">Tambah data petugas</span>
</a>
<a href="./laporan/petugas_excel.php" class="btn btn-success btn-icon-split mb-3 ml-1">
    <span class="icon text-white-50">
        <i class="fas fa-download"></i>
    </span>
    <span class="text">Export ke excel</span>
</a>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Petugas</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Petugas</th>
                        <th>Username</th>
                        <th>No Telpon</th>
                        <th>Level</th>
                        <th width="150">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $petugas = mysqli_query($conn, "SELECT * FROM petugas");
                    while ($data = $petugas->fetch_assoc()) {
                    ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $data['nama_petugas']; ?></td>
                            <td><?php echo $data['username'] ?></td>
                            <td><?php echo $data['telpon'] ?></td>
                            <td><?php echo $data['level'] ?></td>
                            <td>
                                <a href="?page=petugas&action=edit&id_petugas=<?php echo $data['id_petugas']; ?>" class="btn btn-sm btn-primary btn-icon-split">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-pencil-alt"></i>
                                    </span>
                                    <span class="text">Edit</span>
                                </a>
                                <a href="?page=petugas&action=delete&id_petugas=<?php echo $data['id_petugas']; ?>" class="btn btn-delete btn-sm btn-danger btn-icon-split">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-trash"></i>
                                    </span>
                                    <span class="text">Hapus</span>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>