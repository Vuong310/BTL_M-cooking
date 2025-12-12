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
        include('../btnhom/connect.php');
    ?>
    <div style="display: flex; flex-direction: column; min-height: 100vh;">
        <header class="dautrang">
            <div class="dautrang1">
                <img src="img/logo.png">
                <div class="thanhtimkiem">
                    <i class="fa fa-search" aria-hidden="true"></i>
                    <input type="search" class="timkiem" placeholder="Search...">
                </div>
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
                    
                    <button class="header"><a href="" class="">Log Out</a></button>
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
                        default:
                            # code...
                            break;
                    }
                }
            ?>
        </main>
        <footer>
            <p>Chú Thích</p>
        </footer>
    </div>
    
</body>
</html>