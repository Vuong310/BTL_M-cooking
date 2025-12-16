<?php
    session_start();
    include ('../../connect.php');
    // echo $_SESSION['username'];
    if(!isset($_SESSION['username'])){
        header('location:../../login/login.php');
    }
    $idMonAn = $_GET['id'];
    $username = $_SESSION['username'];
    $vaiTro = $_SESSION['vaitro'];
    $sql = "SELECT nd.* from nguoi_dung nd join mon_an ma 
            on ma.nguoi_dang_id = nd.id where ma.id='$idMonAn'";
    $row = mysqli_fetch_assoc(mysqli_query($conn, $sql));
    if($row['ten_dang_nhap'] == $username || $vaiTro === 'admin'){
        $sql="DELETE FROM mon_an WHERE id = '$idMonAn'";
        mysqli_query($conn, $sql);
        if($row['ten_dang_nhap'] == $username){
            header('location: ../../gdnguoidung/index.php?page=hoso&tab=dadang');
        }
        else{
            header('location: ../admin.php?page=monan');
        }
    }
    
?>