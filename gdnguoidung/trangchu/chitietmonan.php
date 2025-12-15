<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết món ăn</title>
    <link rel="stylesheet" href="../btnhom/cacform.css">
    <style>
        body{
            display: flex;
            flex-direction: column;
            color:#324f23;
            margin:20vh auto;
            margin-bottom:0;
        }
        h2{
            text-align:left;
            font-size:30px;
        }
        a{
            text-decoration:none;
        }
        p{
            font-weight: bold;
            font-size: large;
        }
        .nguyenlieu{
            flex:1;
        }
        li{
            padding-inline-start: 0;
            font-size:20px;
        }
        .container{
            background-color: #9ab25b;
            display:flex;
            flex-direction: column;
            padding:20px;
            gap:5px;
            margin:auto;
            width:80%;
            border-radius: 10px;
            box-shadow: 0 15px 20px rgba(0,0,0,0.3);
            color:#f1e9d2;
            font-weight:bold;
        }
        .tendangnhap{
            display:flex;
            justify-content: space-around;
            align-items:flex-start;
            gap:10px;
        }
    </style>
</head>
<body>
    <?php
        include('../connect.php');
        $id = $_GET['id'];
        $sql = "SELECT ma.*, ct.buoc_lam ,nl.ten_nguyen_lieu, nd.ho_ten
                from mon_an ma
                join cong_thuc ct on ma.id = ct.mon_an_id
                join mon_an_loai_mon malm on ma.id = malm.mon_an_id
                join mon_an_nguyen_lieu manl on ma.id = manl.mon_an_id
                join nguyen_lieu nl on manl.nguyen_lieu_id = nl.id
                join loai_mon lm on malm.loai_mon_id = lm.id
                join nguoi_dung nd on ma.nguoi_dang_id = nd.id
                where ma.id = $id";
        $result = mysqli_query($conn,$sql);
        $monAn = mysqli_fetch_array($result);
    ?>
    <div class="container">
        <!-- <h1><?php echo $monAn['ten_mon_an']; ?></h1> -->
        <div class = "tendangnhap">
            <div>
                <!-- <img src="<?php echo $monAn['hinh_anh']?>" alt=""> -->
                 <img src="img/login.png" alt="" style="width:300px; height:300px">
            </div>
            <div>
                <h1 style="font-size:50px"><?php echo $monAn['ten_mon_an']; ?></h1>
                <p><?php echo $monAn['mo_ta']; ?></p>
                <p>Người đăng: <?php echo " " . $monAn['ho_ten']; ?></p>
                <p>Ngày đăng: <?php echo " " . $monAn['ngay_dang']; ?></p>
                <p>Thời gian nấu: <?php echo " " . $monAn['thoi_gian_nau'] . " phút"; ?></p>
            </div>
        </div>
        <div class="tendangnhap">
            <div class="nguyenlieu">
                <h2>Nguyên liệu</h2>
                <?php 
                    include ('../connect.php');
                    $sql_nl = "SELECT manl.*, nl.ten_nguyen_lieu from mon_an_nguyen_lieu manl
                            join nguyen_lieu nl on manl.nguyen_lieu_id = nl.id
                            where manl.mon_an_id = $id";
                    $result_nl = mysqli_query($conn, $sql_nl);
                ?>
                <ol>
                    <?php
                        while($nguyenLieu = mysqli_fetch_assoc($result_nl)){
                    ?>
                    <li><?php echo $nguyenLieu['ten_nguyen_lieu'] . " " . $nguyenLieu['so_luong'];?></li>
                    <?php }?>
                </ol>
            </div>
            <div class="nguyenlieu">
                <h2>Các bước thực hiện</h2>
                <?php 
                    include ('../connect.php');
                    $sql_ct = "SELECT ct.* from cong_thuc ct
                            where ct.mon_an_id = $id";
                    $result_ct = mysqli_query($conn, $sql_ct);
                ?>
                <ol>
                    <?php
                        while($congThuc = mysqli_fetch_assoc($result_ct)){
                    ?>
                    <li><?php echo $congThuc['buoc_lam'];?></li>
                    <?php }?>
                </ol>
            </div>
        </div>
    </div>
    
</body>
</html>