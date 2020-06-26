<?php
session_start();
if ($_SESSION['level'] != "admin") {
    header("location:../auth/login.php");
    exit;
}
$conn = new mysqli("localhost", "root", "", "db_pengaduan");
$namafile = "laporan_pengaduan " . date('m-yy') . ".xls";

header("content-disposition: attechment; filename=$namafile");
header("content-type: application/vdn.ms-exel");
?>

<h2>Laporan data pengaduan</h2>

<table border="1">
    <tr>
        <th style="background: green;color:white;">No</th>
        <th style="background: green;color:white;">Tanggal Pengaduan</th>
        <th style="background: green;color:white;">Nama Pengadu</th>
        <th style="background: green;color:white;">Isi Laporan</th>
        <th style="background: green;color:white;">Tanggapan</th>
        <th style="background: green;color:white;">Tanggal Tanggapan</th>
        <th style="background: green;color:white;">Petugas</th>
        <th style="background: green;color:white;">Status</th>
    </tr>
    <?php
    $no = 1;
    $pengaduan = mysqli_query($conn, "SELECT * FROM tanggapan RIGHT JOIN pengaduan ON pengaduan.id_pengaduan=tanggapan.id_pengaduan JOIN masyarakat ON pengaduan.nik=masyarakat.nik LEFT JOIN petugas ON petugas.id_petugas=tanggapan.id_petugas");

    while ($data = $pengaduan->fetch_assoc()) {

    ?>
        <tr>
            <td><?php echo $no++ ?></td>
            <td><?php echo date("d-m-yy", $data['tgl_pengaduan']); ?></td>
            <td><?php echo $data['nama']; ?></td>
            <td><?php echo $data['isi_laporan']; ?></td>
            <td>
                <?php
                if ($data['tanggapan'] == "") {
                    echo "-";
                } else {
                    echo $data['tanggapan'];
                }
                ?>
            </td>
            <td>
                <?php
                if ($data['tgl_tanggapan'] == "") {
                    echo "-";
                } else {
                    echo date("d-m-yy", $data['tgl_tanggapan']);
                }
                ?>
            </td>
            <td>
                <?php
                if ($data['nama_petugas'] == "") {
                    echo "-";
                } else {
                    echo $data['nama_petugas'];
                }
                ?>
            </td>
            <td><?php
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
    <?php } ?>
</table>