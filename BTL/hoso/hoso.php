
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <style>
        main{
            width:100%;
        }
        .hoso{
            display:flex;
            margin:12vh auto;
            flex-direction:row;
        }
        .thanhcongcu{
            width:20%;
        }
        .thanhcongcu,.chinh{
            margin:auto;
            background-color:rgba(255,255,255,0.5);
            border-radius:10px;
        }
        .thanhcongcu ul{
            display:flex;
            flex-direction:column;
            padding-inline-start:0;
            align-items:baseline;
            margin:10px;
            color:#324f23;
            font-weight:bold;
        }
        .chinh{
            width:75%;
            padding:10px;
            margin-left:5px;
        }
    </style>
</head>
<body>
    <div class="hoso">
        <div class="thanhcongcu">
            <nav>
                <ul>
                    <li><a href="index.php?page=hoso&tab=chinhsuahoso" class="">Chỉnh sửa hồ sơ</a></li>
                    <li><a href="index.php?page=hoso&tab=dadang" class="">Món ăn đã thêm</a></li>
                    <li><a href="index.php?page=hoso&tab=yeuthich" class="">Món ăn yêu thích</a></li>
                    <li><a href="index.php?page=hoso&tab=lichsu" class="">Món ăn đã xem</a></li>
                    <li><a href="index.php?page=hoso&tab=xoahoso" class="">Xóa tài khoản</a></li>
                </ul>
            </nav>
        </div>
        <div class="chinh">
            <?php
                if (isset($_GET['tab'])) {
                    switch ($_GET['tab']) {
                        case 'hosocanhan':
                            include "hoso/hosocanhan.php";
                            break;
                        case 'chinhsuahoso':
                            include "hoso/chinhsuahoso.php";
                            break;
                        case 'dadang':
                            include "hoso/monandadang.php";
                            break;
                        case 'yeuthich':
                            include "hoso_yeuthich.php";
                            break;
                        case 'lichsu':
                            include "hoso_daxem.php";
                            break;
                    }
                }
            ?>
        </div>
    </div>
    
    
</body>
</html>