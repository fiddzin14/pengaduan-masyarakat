<?php
session_start();
if ($_SESSION['level'] != "admin") {
    header("location:../auth/login.php");
    exit;
}
$conn = new mysqli("localhost", "root", "", "db_pengaduan");
$namafile = "laporan_masyarakat " . date('m-yy') . ".xls";

header("content-disposition: attechment; filename=$namafile");
header("content-type: application/vdn.ms-exel");
?>

<h2>Laporan data masyarakat</h2>

<table border="1">
    <tr>
        <th style="background: green;color:white;">No</th>
        <th style="background: green;color:white;">NIK</th>
        <th style="background: green;color:white;">Nama</th>
        <th style="background: green;color:white;">Username</th>
        <th style="background: green;color:white;">No Telpon</th>
    </tr>
    <?php
    $no = 1;
    $masyarakat = mysqli_query($conn, "SELECT * FROM masyarakat");

    while ($data = $masyarakat->fetch_assoc()) {

    ?>
        <tr>
            <td><?php echo $no++ ?></td>
            <td><?php echo $data['nik'] ?></td>
            <td><?php echo $data['nama'] ?></td>
            <td><?php echo $data['username'] ?></td>
            <td><?php echo $data['telpon'] ?></td>
        </tr>
    <?php } ?>
</table>