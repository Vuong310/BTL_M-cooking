<?php
    include __DIR__ . '/../../../connect.php';
    $id = (int)$_GET['id'];
    mysqli_query($conn, "DELETE FROM lich_su WHERE id = $id");
    header('location: ../../index.php?page=hoso&tab=lichsu');
    exit;
?> 