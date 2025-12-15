<?php
    include('../../connect.php');
    $id = $_GET['id'];
    $sql = "DELETE FROM loai_mon where id = '$id'";
    mysqli_query($conn, $sql);
    header('location: ../admin.php?page=loaimon');
?>