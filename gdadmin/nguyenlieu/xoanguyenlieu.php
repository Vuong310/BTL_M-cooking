<?php
    include('../../connect.php');
    $id = $_GET['id'];
    $sql = "DELETE FROM nguyen_lieu where id = '$id'";
    mysqli_query($conn, $sql);
    header('location: ../admin.php?page=nguyenlieu');
?>