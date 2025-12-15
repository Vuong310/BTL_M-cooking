<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Món ăn đã đăng</title>
    <style>
        .monan img{
            width:200px;
            height:200px;
            /* border-radius: 10px; */
        }
        .mota{
            width:180px;
            max-height:100px;
        }
        .danhsach{
            display:flex;
            flex-wrap:wrap;
            gap:20px;
        }
    </style>
</head>
<body>
    <?php
        $username = $_SESSION['username'];
        include('../connect.php');
        $sql = "SELECT ma.* from mon_an ma
                join nguoi_dung nd on ma.nguoi_dang_id = nd.id
                where nd.ten_dang_nhap = '$username' ";
        // echo $sql;
        $result = mysqli_query($conn, $sql);
    ?>
    <div class="danhsach">
        <?php
            while($row = mysqli_fetch_assoc($result)){
        ?>
        <a href="index.php?page=chitietmonan&id=<?php echo $row['id']?>">
            <div class="monan">
                <img src="img/logo.png" style="">
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