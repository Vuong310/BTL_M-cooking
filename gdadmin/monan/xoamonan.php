<?php
    include ('../../connect.php');
    $id = $_GET['id'];
    $sql="DELETE FROM mon_an WHERE id = '$id'";
    mysqli_query($conn, $sql);
    header('location: ../admin.php?page=monan');
?>