<?php

$nik = $_GET['nik'];
$conn->query("DELETE FROM masyarakat WHERE nik='$nik'");

?>
<script>
    window.location.href = "?page=masyarakat&message=delete";
</script>