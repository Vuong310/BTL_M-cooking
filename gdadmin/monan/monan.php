<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Món ăn</title>
    <link rel="stylesheet" href="cacbang.css">
</head>
<body>
    <div class="dau">
        <h1>Thông tin món ăn</h1>
        <a href="admin.php?page=themmonan" class="nut">Thêm món ăn</a>
    </div>
    <table border=1>
        <tr>
            <th>Tên món ăn</th>
            <th>Mô tả</th>
            <th>Thời gian nấu</th>
            <th>Người đăng</th>
            <th>Ngày đăng</th>
            <th>Hình ảnh</th>
            <th>Trạng thái</th>
            <th>Chức năng</th> 
        </tr>

        <?php
            include("../connect.php");
            $sql = "SELECT ma.*, nd.ho_ten
                    FROM mon_an ma
                    JOIN nguoi_dung nd ON nd.id = ma.nguoi_dang_id";
            $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_array($result)){
        ?>

        <tr>
            <td><?php echo $row["ten_mon_an"] ?></td>
            <td><?php echo $row["mo_ta"] ?></td>
            <td><?php echo $row["thoi_gian_nau"] ?></td>
            <td><?php echo $row["ho_ten"] ?></td>
            <td><?php echo $row["ngay_dang"] ?></td>
            <td><img src="<?php echo $row["hinh_anh"] ?>" alt=""></td>
            <td><?php echo $row["trang_thai"] ?></td>
            <td class="chucnang">
                <a href="admin.php?page=capnhatmonan&id=<?php echo $row['id']?>" class="nutcapnhat">Cập nhật</a>
                <a href="monan/xoamonan.php?id=<?php echo $row['id']?>" class="nutxoa" 
                onclick="return confirm('Bạn có chắc muốn xóa món ăn này?')">
                    Xóa
                </a>
            </td>
        </tr>
        <?php } ?>
    </table>
    
</body>
</html>





