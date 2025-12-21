<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .luachon p{
            font-weight:normal;
        }
    </style>
</head>
<body>
    <?php
        include('../connect.php');
        $saiMK = False;
        if((!empty($_POST['tentk']))&&
        (!empty($_POST['firstname']))&&
        (!empty($_POST['lastname']))&&
        (!empty($_POST['ngay']))&&
        (!empty($_POST['thang']))&&
        (!empty($_POST['nam']))&&
        (!empty($_POST['chon']))&&
        (!empty($_POST['sdt'])) && 
        (!empty($_POST['email']))&&
        (!empty($_POST['matkhau'])) &&
        (!empty($_POST['xacminhmk']))
        ){
            $tenTK = $_POST['tentk'];

            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $hoTen = $lastname . " " . $firstname;

            $ngay = $_POST['ngay'];
            $thang = $_POST['thang'];
            $nam = $_POST['nam'];
            $ngaySinh = $nam . "-" . $thang . "-" . $ngay;

            $gioiTinh = $_POST['chon'];
            $sdt = $_POST['sdt'];
            $email = $_POST['email'];
            $matKhau = $_POST['matkhau'];
            $xacMinhMK = $_POST['xacminhmk'];
            if($matKhau === $xacMinhMK){
                $sql = "INSERT INTO `nguoi_dung`(`ten_dang_nhap`, `mat_khau`, `ho_ten`, `gioi_tinh`, `email`, `sdt`, `vai_tro_id`, `ngay_sinh`) VALUES ('$tenTK','$matKhau','$hoTen','$gioiTinh','$email','$sdt','2','$ngaySinh')";
                mysqli_query($conn, $sql);
                header('location:../login.php');
            }
            else{
                $saiMK = True;
            }
            
        }
        else{
            $warning = True;
        }
    ?>
    <header>
        <h1>Đăng ký</h1>
    </header>

    <main>
        <div class="hang1">
            <h2>Tạo một tài khoản mới</h2>
            <p>Nhanh chóng và dễ dàng</p>
            <hr>
        </div>
        <form action="signup.php" method="post" class="dangky">
            <div>
                <p style="text-align:left; margin-left:10px;">Tên tài khoản</p>
                <input type="text" name="tentk" placeholder="Nhập tên tài khoản của bạn">
            </div>
            <p style="text-align:left; margin-left:10px;">Tên người dùng</p>
            <div class="name">
                <input type="text" name="lastname" placeholder="Họ">
                <input type="text" name="firstname" placeholder="Tên">
            </div>
            <div class="birth">
                <p>Ngày sinh</p>
                <div class="ngaythangnamsinh">
                    <select name="ngay">
                        <?php
                            for($i = 1; $i<=30; $i++){
                                echo "<option value='$i'>$i</option>";
                            }
                        ?>
                    </select>
                    <select name="thang">
                        <?php
                            for($i = 1; $i<=12; $i++){
                                echo "<option value='$i'>$i</option>";
                            }
                        ?>
                    </select>
                    <select name="nam">
                        <?php
                            for($i = 1970; $i<=2025; $i++){
                                echo "<option value='$i'>$i</option>";
                            }
                        ?>
                    </select>
                </div>
            </div>
            <div class="gender">
                <p style="margin-left:5px;">Giới tính</p>
                <div class="luachon">
                    <div class="vien">
                        <p>Nữ:</p>
                        <input type="radio" name="chon" value="Nữ">
                    </div> 
                    <div class="vien">
                        <p>Nam:</p>
                        <input type="radio" name="chon" value="Nam">
                    </div>
                    <div class="vien">
                        <p>Khác:</p>
                        <input type="radio" name="chon" value="Khác">
                    </div>
                </div>
            </div>
            <div class="nhap">
                <input type="tel" name="sdt" placeholder="Số điện thoại">
                <input type="email" name="email" placeholder="Email">
                <input type="password" name="matkhau" placeholder="Mật khẩu mới">
                <input type="password" name="xacminhmk" placeholder="Nhập lại mật khẩu mới">
                <?php
                    if($saiMK == True){
                        echo "<p class='warning'>Mật khẩu không khớp. Vui lòng nhập lại mật khẩu mới khớp với mật khẩu bạn đã đặt!</p>";
                    }
                ?>
            </div>
            <input class="nut" type="submit" value="Đăng ký">
        </form>
        <div style="margin:10px;">
            <a style="text-decoration: none;color:white;" href="../login/login.php">Bạn đã có tài khoản? <b>Đăng nhập</b></a>
        </div>
    </main>
    <?php 
        if($warning == True){
            echo "<br><h2 class='warning'>Vui lòng nhập đầy đủ thông tin!</h2>";
        }
    ?>
</body>
</html>