<?php
    include('../connect.php');
    $id = $_GET['id'];
    $sql = "DELETE FROM nguoi_dung where id = '$id'";
    mysqli_query($conn, $sql);
    header('location: ../admin.php?page=nguoidung');
?>