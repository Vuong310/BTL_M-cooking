<?php
    include('../connect.php');
    $id = $_GET['id'];
    $sql_nd = "SELECT nd.*, COUNT(ma.id) as so_mon from nguoi_dung nd 
            join mon_an ma on ma.nguoi_dang_id = nd.id
            where nd.id = '$id'";
    $nguoiDang = mysqli_fetch_assoc(mysqli_query($conn, $sql_nd));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hồ sơ người đăng</title>
    <style>
        main{
            margin-top:10vh;
            width:70%;
        }
        .danhsach{
            display:flex;
            flex-wrap:wrap;
            gap:20px;
        }
        .monan img{
            width:200px;
            height:200px;
            /* border-radius: 10px; */
        }
        .mota{
            width:180px;
            max-height:100px;
        }
        .tren{
            background-color:rgba(255,255,255,0.5);
            border-radius:10px;
            padding: 20px;
            margin-bottom:10px;
        }
    </style>
</head>
<body>
    <div class="tren">
        <h1>Thông tin cơ bản</h1>
        <p>Họ tên: <?php echo $nguoiDang['ho_ten']?></p>
        <p>Email: <?php echo $nguoiDang['email']?></p>
        <p>Số món đã đăng: <?php echo $nguoiDang['so_mon']?></p>
    </div>
    <div class="danhsach">
        <?php
            $sql = "SELECT ma.* from mon_an ma join nguoi_dung nd on nd.id = ma.nguoi_dang_id where nd.id = '$id'";
            $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_assoc($result)){
        ?>
        <a href="index.php?page=chitietmonan&id=<?php echo $row['id']?>">
            <div class="monan">
                <img src="../img/logo.png">
                <div class="mota">
                    <p><?php echo $row['ten_mon_an']?></p>
                    <p>Ngày đăng: <?php echo $row['ngay_dang']?></p>
                </div>
            </div>
        </a>
        <?php }?>
    </div>
</body>
</html>