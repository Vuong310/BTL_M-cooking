<?php
    include('../../connect.php');
    $id = $_GET['id'];

    // có 3 dòng dưới là ấn xóa đc luôn cả dl cũ
    mysqli_query($conn, "DELETE FROM cong_thuc WHERE mon_an_id = $id");
    mysqli_query($conn, "DELETE FROM mon_an_nguyen_lieu WHERE mon_an_id = $id");
    mysqli_query($conn, "DELETE FROM mon_an_loai_mon WHERE mon_an_id = $id");

    mysqli_query($conn, "DELETE FROM mon_an WHERE id = $id");
    header('location: ../admin.php?page=congthuc');
?>