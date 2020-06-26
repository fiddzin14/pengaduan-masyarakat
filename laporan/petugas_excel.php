<?php
session_start();
if ($_SESSION['level'] != "admin") {
    header("location:../auth/login.php");
    exit;
}
$conn = new mysqli("localhost", "root", "", "db_pengaduan");
$namafile = "laporan_petugas " . date('m-yy') . ".xls";

header("content-disposition: attechment; filename=$namafile");
header("content-type: application/vdn.ms-exel");
?>

<h2>Laporan data petugas</h2>

<table border="1">
    <tr>
        <th style="background: green;color:white;">No</th>
        <th style="background: green;color:white;">Nama Petugas</th>
        <th style="background: green;color:white;">Username</th>
        <th style="background: green;color:white;">No Telpon</th>
        <th style="background: green;color:white;">Level</th>
    </tr>
    <?php
    $no = 1;
    $petugas = mysqli_query($conn, "SELECT * FROM petugas");

    while ($data = $petugas->fetch_assoc()) {

    ?>
        <tr>
            <td><?php echo $no++ ?></td>
            <td><?php echo $data['nama_petugas'] ?></td>
            <td><?php echo $data['username'] ?></td>
            <td><?php echo $data['telpon'] ?></td>
            <td><?php echo $data['level'] ?></td>
        </tr>
    <?php } ?>
</table>