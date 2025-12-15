<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BTL</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <?php 
        session_start();
        if(!isset($_SESSION["username"])){
            header('location: ../btnhom/login.php');
        }
        // include('../btnhom/connect.php');
    ?>
    
    <div style="display: flex; flex-direction: column; min-height: 100vh;">
        <header class="dautrang">
            <div class="dautrang1">
                <img src="img/logo.png">
                <form method="GET" action="index.php">
                    <i class="fa fa-search" aria-hidden="true"></i>
                    <input type="search" name="search" class="timkiem" placeholder="Search..." required>
                    <input type="hidden" name="page" value="trangchu">

                </form>
                <nav class="header">
                    <ul>
                        <li><a href="index.php?page=trangchu">Trang chủ</a></li>
                        <li><a href="index.php?page=hoso">Hồ sơ</a></li>
                        <li><a href="index.php?page=themcongthuc">Thêm công thức</a></li>
                        <li><a href="index.php?page=loc">Lọc</a></li>
                    </ul>
                </nav>
                <div class="dangnhap">
                    <div class="dangnhap" style="background-color: #ffffff33;border-radius:50px;">
                        <img src="img/(10).jpg" style="border-radius:50px; height:50px;">
                        <p style="font-weight:bold;margin:auto 10px;"><?php
                            echo $_SESSION["username"];
                        ?></p>
                    </div>
                    
                    <button class="header"><a href="../btnhom/login.php" class="">Log Out</a></button>
                    <!-- <button><b>Sign Up</b></button>
                    <button><b>Log In</b></button> -->
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
                        case 'chitietmonan':
                            include "chitietmonan.php";
                            break;
                        case 'dstheoloaimon':
                            include "dstheoloaimon.php";
                            break;
                        default:
                            # code...
                            break;
                    }
                }
            ?>
        </main>
        <footer>
            <div style="background-color: #9ab25d; color: white; border-top-left-radius: 10px ;border-top-right-radius: 10px ;">
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