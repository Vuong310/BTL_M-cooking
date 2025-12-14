<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BTL</title>
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <?php
        session_start();
        if(!isset($_SESSION['username'])){
            header('location:login.php');
        }
        include('connect.php');
    ?>
    <header class="dautrang">
        <div class="dautrang1">
            <img src="img/logo.png">
            <nav class="header">
                <ul>
                    <li><a href="admin.php?page=trangchu">Trang chủ</a></li>
                    <li><a href="admin.php?page=nguoidung">Người dùng</a></li>
                    <li><a href="admin.php?page=monan">Món ăn</a></li>
                    <li><a href="admin.php?page=nguyenlieu">Nguyên liệu</a></li>
                    <li><a href="admin.php?page=loaimon">Loại món</a></li>
                    <li><a href="admin.php?page=congthuc">Công thức</a></li>
                </ul>
            </nav>
            <div class="dangnhap">
                <p style="font-weight:bold; color:#f1e9d2"><?php echo "Xin chào " . $_SESSION['username'];?></p>
                <button><a href="login.php" style="text-decoration:none; color:#f1e9d2; font-weight:bold;">Đăng xuất</a></button>
            </div>
        </div>
    </header>
    <main>
        <?php
            if(isset($_GET['page'])){
                switch ($_GET['page']) {
                    case 'trangchu':
                        include "trangchu.php";
                        break;
                    case 'nguoidung':
                        include "nguoidung/nguoidung.php";
                        break;
                    case 'themnguoidung':
                        include "nguoidung/themnguoidung.php";
                        break;
                    case 'capnhatnguoidung':
                        include "nguoidung/capnhatnguoidung.php";
                        break;
                    case 'xoanguoidung':
                        include "nguoidung/xoanguoidung.php";
                        break;

                    case 'monan':
                        include "monan/monan.php";
                        break;
                    case 'themmonan':
                        include "monan/themmonan.php";
                        break;
                    case 'capnhatmonan':
                        include "monan/capnhatmonan.php";
                        break;
                    case 'xoamonan':
                        include "monan/xoamonan.php";
                        break;

                    case 'nguyenlieu':
                        include "nguyenlieu/nguyenlieu.php";
                        break;
                    case 'themnguyenlieu':
                        include "nguyenlieu/themnguyenlieu.php";
                        break;
                    case 'capnhatnguyenlieu':
                        include "nguyenlieu/capnhatnguyenlieu.php";
                        break;
                    case 'xoanguyenlieu':
                        include "nguyenlieu/xoanguyenlieu.php";
                        break;

                    case 'loaimon':
                        include "loaimon/loaimon.php";
                        break;
                    case 'themloaimon':
                        include "loaimon/themloaimon.php";
                        break;
                    case 'capnhatloaimon':
                        include "loaimon/capnhatloaimon.php";
                        break;
                    case 'xoaloaimon':
                        include "loaimon/xoaloaimon.php";
                        break;

                    case 'congthuc':
                        include "congthuc/congthuc.php";
                        break;
                    case 'capnhatcongthuc':
                        include "congthuc/capnhatcongthuc.php";
                        break;
                    case 'themcongthuc':
                        include "congthuc/themcongthuc.php";
                        break;
                    case 'xoacongthuc':
                        include "congthuc/xoacongthuc.php";
                        break;

                    
                    // case 'dangxuat':
                    //     include "login.php";
                    //     break;
                    
                    default:
                        # code...
                        break;
                }
            }
        ?>
    </main>
    
</body>
</html>