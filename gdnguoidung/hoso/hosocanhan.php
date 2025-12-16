<?php
    if(!isset($_SESSION["username"])){
        header('location: ../login/login.php');
    }
    $username = $_SESSION["username"];
    include('../connect.php');
    $sql = "SELECT * from nguoi_dung where ten_dang_nhap = '$username'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hồ sơ cá nhân</title>
    <link rel="stylesheet" href="../style.css">
    <style>
        .form{
            border-bottom:2px solid #324f23;
        }
    </style>
</head>
<body>
    <div>
        <div class="form">
            <h3>Tên tài khoản: <?php echo $row['ten_dang_nhap']?></h3>
        </div>
        <div class="form">
            <h3>Tên người dùng: <?php echo $row['ho_ten']?></h3>
        </div>
        <div class="form">
            <h3>Ngày sinh: <?php echo $row['ngay_sinh']?></h3>
        </div>
        <div class="form">
            <h3>Giới tính: <?php echo $row['gioi_tinh']?></h3>
        </div>
        <div class="form">
            <h3>Số điện thoại: <?php echo $row['sdt']?></h3>
        </div>
        <div class="form">
            <h3>Email: <?php echo $row['email']?></h3>
        </div>
    </div>
</body>
</html>