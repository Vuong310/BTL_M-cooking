<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BTL</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        li{
            padding-inline-start: 0;
            font-size: 15px !important;
        }
        .chon:hover{
            border-bottom: 2px solid white;
        }
        form.nostyle{
            all:unset;
            display:flex;
            align-items:center;
            gap:5px;
        }
        .timkiem::placeholder {
            color: #324f23;
        }
        .chan1{
            background-color: #9ab25d; 
            color: white; 
            border-top-left-radius: 10px ;
            border-top-right-radius: 10px ;
        }
    </style>
</head>
<body>
    <?php
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    ?>
    
    <div style="display: flex; flex-direction: column; min-height: 100vh;">
        <header class="dautrang">
            <div class="dautrang1">
                <img src="../img/logo.png">
                <form class="nostyle" method="GET" action="index.php">
                    <i class="fa fa-search" aria-hidden="true"></i>
                    <input type="search" name="search" class="timkiem" placeholder="Search..." required>
                    <input type="hidden" name="page" value="trangchu">

                </form>
                <nav class="header">
                    <ul>
                        <li class="chon"><a href="index.php?page=trangchu">Trang chủ</a></li>
                        <li class="chon"><a href="index.php?page=hoso&tab=hosocanhan">Hồ sơ</a></li>
                        <li class="chon"><a href="index.php?page=themcongthuc">Thêm công thức</a></li>
                        <li class="chon"><a href="index.php?page=loc">Lọc</a></li>
                    </ul>
                </nav>
                <div class="dangnhap">
                    <button style="background-color: #f1e9d2; color: #324f23; font-weight: bold; font-family: 'Courier New', Courier, monospace;" onclick="doiNen()">Đổi nền</button>
                    <?php
                        if(!empty($_SESSION["username"])):
                    ?>
                        <div class="dangnhap" style="background-color: #ffffff33;border-radius:50px;">
                            <img src="../img/logo_nho.jpg" style="border-radius:50px; height:50px;">
                            <p style="font-weight:bold;margin:auto 10px;"><?php
                                echo $_SESSION["username"];
                            ?></p>
                        </div>
                        
                        <button><a style="text-decoration: none; color:#f1e9d2; font-weight: bold;" href="../login/login.php">Đăng xuất</a></button>
                    <?php else: ?>
                        <button><a style="text-decoration: none; color:#f1e9d2; font-weight: bold;" href="../login/login.php">Đăng nhập</a></button>
                        <button><a style="text-decoration: none; color:#f1e9d2; font-weight: bold;" href="../signup/signup.php">Đăng ký</a></button>
                    <?php endif;?>
                </div>
            </div>
        </header>
        <main>
            <?php
                if(isset($_GET['page'])){
                    switch ($_GET['page']) {
                        case 'trangchu':
                            include "trangchu/trangchu.php";
                            break;
                        case 'chitietmonan':
                            include "trangchu/chitietmonan.php";
                            break;
                        case 'dstheoloaimon':
                            include "trangchu/dstheoloaimon.php";
                            break;
                        case 'hoso':
                            include "hoso/hoso.php";
                            break;
                        case 'capnhatcongthuc':
                            include "../gdadmin/congthuc/capnhatcongthuc.php";
                            break;
                        case 'hosonguoidang':
                            include "hoso/hosonguoidang.php";
                            break;
                        default:
                            # code...
                            break;
                    }
                }
            ?>
        </main>
        <footer>
            <div class="chan1">
                <div style="padding: 30px;">
                    <b>Lời muốn nói</b>
                    <p>Gửi lời cảm ơn chân thành đến các bạn!</p>
                    Member:
                    <ul>
                        <li>
                            <p>Nguyễn Kiều Vy - 2321050005</p>
                            <p>Vương Hà Linh - 2321050007</p>
                            <p>Phạm Hương Giang - 2321050010</p>
                            <p>Phạm Thị Huế - 2321050052</p>
                            <p>Cao Thị Thu Quyên - 2321050058</p>
                        </li>
                    </ul>
                </div>
            </div>
        </footer>
    </div>
    
</body>
</html>