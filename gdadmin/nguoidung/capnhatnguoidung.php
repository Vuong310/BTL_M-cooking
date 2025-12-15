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
        $id = $_GET['id'];
        $sql = "SELECT * from nguoi_dung where id = '$id'";
        $result = mysqli_query($conn, $sql);
        $nguoiDung = mysqli_fetch_assoc($result);
    ?>
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
            $sdt = $_POST['sdt'];
            $gioiTinh = $_POST['gioi-tinh'];
            $email = $_POST['email'];
            $vaiTro = $_POST['vai-tro'];
            include('../connect.php');
            $sql = "UPDATE `nguoi_dung` SET `ten_dang_nhap`='$tenDangNhap',`mat_khau`='$matKhau',`ho_ten`='$hoTen',gioi_tinh='$gioiTinh',`email`='$email',`sdt`='$sdt',`vai_tro_id`='$vaiTro',`ngay_sinh`='$ngaySinh' WHERE id='$id'";
            mysqli_query($conn, $sql);
            header('location: admin.php?page=nguoidung');
        }
        else{
            echo "<p>Vui lòng điền đầy đủ thông tin!</p>";
        }
    ?>
    <form action="admin.php?page=capnhatnguoidung&id=<?php echo $id ?>" method="post">
        <h2>Cập nhật người dùng</h2>
        <div class="tendangnhap">
            <div>
                <p>Tên đăng nhập</p>
                <input type="text" name="ten-dang-nhap" value="<?php echo $nguoiDung['ten_dang_nhap']?>">
            </div>
            <div>
                <p>Mật khẩu</p>
                <input type="password" name="mat-khau" value="<?php echo $nguoiDung['mat_khau']?>">
            </div>
        </div>
        <div>
            <p>Họ và tên</p>
            <input type="text" name="ho-ten" value="<?php echo $nguoiDung['ho_ten']?>">
        </div>
        <div>
            <p>Giới tính</p>
            <select name="gioi-tinh">
                <option value="0">--Chọn giới tính--</option>
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
            <p>Vai trò</p>
            <select name="vai-tro" id="">
                <option value="0">--Chọn vai trò--</option>
                <?php 
                    include('../connect.php');
                    $sql_vt = "SELECT * from vai_tro";
                    $result_vt = mysqli_query($conn, $sql_vt);
                    while($row_vt = mysqli_fetch_assoc($result_vt)){
                        echo '<option value="' . $row_vt['id'] . '"' . ($nguoiDung['vai_tro_id'] == $row_vt['id']? "selected":"") . '>' . $row_vt['ten_vai_tro'] . '</option>'; 
                    }
                ?>
            </select>
        </div>
        <div>
            <input type="submit" value="Cập nhật">
        </div>

    </form>
</body>
</html>