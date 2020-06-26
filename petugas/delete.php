<?php

$id_petugas = $_GET['id_petugas'];
$conn->query("DELETE FROM petugas WHERE id_petugas='$id_petugas'");

?>
<script>
    window.location.href = "?page=petugas&message=delete";
</script>