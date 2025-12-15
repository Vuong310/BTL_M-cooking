<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="cacform.css">
</head>
<body>
    <?php
        if((!empty($_POST['ten-dang-nhap'])) &&
        (!empty($_POST['mat-khau'])) &&
        (!empty($_POST['ho-ten'])) &&
        (!empty($_POST['ngay-sinh'])) &&
        (!empty($_POST['gioi-tinh'])) &&
        (!empty($_POST['sdt'])) &&
        (!empty($_POST['email'])) &&
        (!empty($_POST['vai-tro']))){
            $tenDangNhap = $_POST['ten-dang-nhap'];
            $matKhau = $_POST['mat-khau'];
            $hoTen = $_POST['ho-ten'];
            $ngaySinh = $_POST['ngay-sinh'];
            $gioiTinh = $_POST['gioi-tinh'];
            $sdt = $_POST['sdt'];
            $email = $_POST['email'];
            $vaiTro = $_POST['vai-tro'];
            include('../connect.php');
            $sql = "INSERT INTO nguoi_dung(ten_dang_nhap,mat_khau,ho_ten,gioi_tinh,sdt,email,vai_tro_id,ngay_sinh) VALUES ('$tenDangNhap','$matKhau','$hoTen','$gioiTinh','$sdt','$email','$vaiTro','$ngaySinh')";
            mysqli_query($conn, $sql);
            header('location: admin.php?page=nguoidung');
        }
        else{
            echo "<p>Vui lòng điền đầy đủ thông tin!</p>";
        }
    ?>
    <form action="admin.php?page=themnguoidung" method="post">
        <h2>Thêm người dùng</h2>
        <div class="tendangnhap">
            <div>
                <p>Tên đăng nhập</p>
                <input type="text" name="ten-dang-nhap">
            </div>
            <div>
                <p>Mật khẩu</p>
                <input type="password" name="mat-khau">
            </div>
        </div>
        <div>
            <p>Họ và tên</p>
            <input type="text" name="ho-ten">
        </div>
        <div>
            <p>Giới tính</p>
            <select name="gioi-tinh">
                <option value="0">--Chọn giới tính--</option>
                <option value="Nam">Nam</option>
                <option value="Nu">Nữ</option>
                <option value="Khac">Khác</option>
            </select>
        </div>
        <div>
            <p>Ngày sinh</p>
            <input type="date" name="ngay-sinh">
        </div>
        <div>
            <p>Số điện thoại</p>
            <input type="text" name="sdt">
        </div>
        <div>
            <p>Email</p>
            <input type="email" name="email">
        </div>
        <div>
            <p>Vai trò</p>
            <select name="vai-tro">
                <option value="0">--Chọn vai trò--</option>
                <option value="1">Admin</option>
                <option value="2">Người dùng</option>
            </select>
        </div>
        <div>
            <input type="submit" value="Thêm mới">
        </div>

    </form>
</body>
</html>