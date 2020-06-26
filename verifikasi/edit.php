<?php
$id = $_GET['id_pengaduan'];
$status = 1;
$conn->query("UPDATE pengaduan SET status='$status' WHERE id_pengaduan='$id'");
?>
<script>
    window.location.href = "?page=verifikasi&message=verif";
</script>