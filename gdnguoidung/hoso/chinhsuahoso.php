<?php
    include('../connect.php');
    $username = $_SESSION['username'];
    $sql = "SELECT * from nguoi_dung where ten_dang_nhap = '$username'";
    $result = mysqli_query($conn, $sql);
    $nguoiDung = mysqli_fetch_assoc($result);
?>
<?php
    if((!empty($_POST['ten-dang-nhap'])) &&
    (!empty($_POST['ho-ten'])) &&
    (!empty($_POST['ngay-sinh'])) &&
    (!empty($_POST['gioi-tinh'])) &&
    (!empty($_POST['sdt'])) &&
    (!empty($_POST['email']))){
        $tenDangNhap = $_POST['ten-dang-nhap'];
        $hoTen = $_POST['ho-ten'];
        $ngaySinh = $_POST['ngay-sinh'];
        $sdt = $_POST['sdt'];
        $gioiTinh = $_POST['gioi-tinh'];
        $email = $_POST['email'];
        include('../connect.php');
        $sql = "UPDATE `nguoi_dung` 
                SET `ten_dang_nhap`='$tenDangNhap',`ho_ten`='$hoTen',gioi_tinh='$gioiTinh',`email`='$email',`sdt`='$sdt',`ngay_sinh`='$ngaySinh' 
                WHERE ten_dang_nhap = '$username'";
        mysqli_query($conn, $sql);
        echo "<script>window.location.href='index.php?page=hoso&tab=hosocanhan';</script>";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa hồ sơ</title>
    <link rel="stylesheet" href="style.css">
    <!-- <link rel="stylesheet" href="../btnhom/cacform.css"> -->
    <style>
        main{
            width:100%;
        }
        input, select, textarea{
            width:100%;
            font-family: 'Courier New', Courier, monospace;
            border-radius: 5px;
            border:1px solid #f1e9d2;
            padding:5px;
            /* margin:10px; */
            padding-inline-start: 0;
        }
        button{
            font-family: 'Courier New', Courier, monospace;
        }
        input[type="submit"]{
            color: #f1e9d2;
            background-color: #324f23;
            font-size: 16px;
            border-radius: 10px; 
            padding:5px 20px;
            font-weight:bold;
            cursor: pointer;/*đổi con trỏ thành hình bàn tay */
            margin-top:10px;
        }
    </style>
</head>
<body>
    <form action="index.php?page=hoso&tab=chinhsuahoso&id=<?php echo $nguoiDung['id'] ?>" method="post">
        <div>
            <p>Tên đăng nhập</p>
            <input type="text" name="ten-dang-nhap" value="<?php echo $nguoiDung['ten_dang_nhap']?>">
        </div>
            
        <div>
            <p>Họ và tên</p>
            <input type="text" name="ho-ten" value="<?php echo $nguoiDung['ho_ten']?>">
        </div>
        <div>
            <p>Giới tính</p>
            <select name="gioi-tinh">
                <!-- <option value="0">--Chọn giới tính--</option> -->
                <option value="Nam"<?php echo $nguoiDung['gioi_tinh']=="Nam" ? "selected":""?>>Nam</option>
                <option value="Nữ"<?php echo $nguoiDung['gioi_tinh']=="Nữ" ? "selected":""?>>Nữ</option>
                <option value="Khác"<?php echo $nguoiDung['gioi_tinh']=="Khác" ? "selected":""?>>Khác</option>
            </select>
        </div>
        <div>
            <p>Ngày sinh</p>
            <input type="date" name="ngay-sinh" value="<?php echo $nguoiDung['ngay_sinh']?>">
        </div>
        <div>
            <p>Số điện thoại</p>
            <input type="text" name="sdt" value="<?php echo $nguoiDung['sdt']?>">
        </div>
        <div>
            <p>Email</p>
            <input type="email" name="email" value="<?php echo $nguoiDung['email']?>">
        </div>
        <div>
            <input type="submit" value="Cập nhật">
        </div>
    </form>

</body>
</html>