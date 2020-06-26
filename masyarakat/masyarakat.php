<a href="?page=masyarakat&action=add" class="btn btn-primary btn-icon-split mb-3 ml-1">
    <span class="icon text-white-50">
        <i class="fas fa-plus"></i>
    </span>
    <span class="text">Tambah data masyarakat</span>
</a>
<a href="./laporan/masyarakat_excel.php" class="btn btn-success btn-icon-split mb-3 ml-1">
    <span class="icon text-white-50">
        <i class="fas fa-download"></i>
    </span>
    <span class="text">Export ke excel</span>
</a>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Masyarakat</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>No Telpon</th>
                        <th width="150">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $masyarakat = mysqli_query($conn, "SELECT * FROM masyarakat");
                    while ($data = $masyarakat->fetch_assoc()) {
                    ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $data['nik'] ?></td>
                            <td><?php echo $data['nama']; ?></td>
                            <td><?php echo $data['username'] ?></td>
                            <td><?php echo $data['telpon'] ?></td>
                            <td>
                                <a href="?page=masyarakat&action=edit&nik=<?php echo $data['nik']; ?>" class="btn btn-sm btn-primary btn-icon-split">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-pencil-alt"></i>
                                    </span>
                                    <span class="text">Edit</span>
                                </a>
                                <a href="?page=masyarakat&action=delete&nik=<?php echo $data['nik']; ?>" class="btn btn-sm btn-danger btn-delete btn-icon-split">
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