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
        .chucnang{
            flex-direction:column;
        }
    </style>
    <link rel="stylesheet" href="../gdadmin/cacbang.css">
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
        <div class="chucnang">
            <a href="index.php?page=chitietmonan&id=<?php echo $row['id']?>">
                <div class="monan">
                    <img src="../gdadmin/<?php echo $row['hinh_anh']?>">
                    <div class="mota">
                        <p><?php echo $row['ten_mon_an']?></p>
                        <p>Ngày đăng: <?php echo $row['ngay_dang']?></p>
                    </div>
                </div>
            </a>
            <div>
                <a href="index.php?page=capnhatcongthuc&id=<?php echo $row['id']?>" class="nutcapnhat">Cập nhật</a>
                <a href="../gdadmin/monan/xoamonan.php?id=<?php echo $row['id']?>" class="nutxoa" 
                onclick="return confirm('Bạn có chắc muốn xóa món ăn này?')">Xóa</a>
            </div>
        </div>
        <?php }?>
    </div>
    
</body>
</html>