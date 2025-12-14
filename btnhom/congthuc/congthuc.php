<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="cacbang.css">
</head>
<body>
    <div class="dau">
        <h1>Quản lý Công thức</h1>
        <a href="admin.php?page=themcongthuc" class="nut">Thêm công thức</a>
    </div>
    <table border=1>
        <tr>
            <th>STT</th>
            <th>Tên món ăn</th>
            <th>Loại món</th>
            <th>Nguyên liệu</th>
            <th>Thời gian nấu</th>
            <th>Mô tả</th>
            <th>Bước làm</th>
        </tr>
        <?php
        include('connect.php');
        $sql = "SELECT 
                    ma.id AS mon_an_id,
                    ma.ten_mon_an,
                    GROUP_CONCAT(DISTINCT lm.ten_loai SEPARATOR ', ') AS loai_mon,
                    GROUP_CONCAT(DISTINCT 
                        CONCAT(nl.ten_nguyen_lieu, ' (', manl.so_luong, ')')
                        SEPARATOR ', ') AS nguyen_lieu,
                    ma.thoi_gian_nau,
                    ma.mo_ta,
                    GROUP_CONCAT(DISTINCT ct.buoc_lam ORDER BY ct.id SEPARATOR ' | ') AS buoc_lam
                FROM mon_an ma
                LEFT JOIN mon_an_loai_mon malm ON ma.id = malm.mon_an_id
                LEFT JOIN loai_mon lm ON malm.loai_mon_id = lm.id
                LEFT JOIN mon_an_nguyen_lieu manl ON ma.id = manl.mon_an_id
                LEFT JOIN nguyen_lieu nl ON manl.nguyen_lieu_id = nl.id
                LEFT JOIN cong_thuc ct ON ma.id = ct.mon_an_id
                GROUP BY ma.id;";
        $result = mysqli_query($conn, $sql);
        while($cong_thuc = mysqli_fetch_assoc($result)){
        ?>
        <tr>
            <td><?php echo $cong_thuc['mon_an_id']?></td>
            <td><?php echo $cong_thuc['ten_mon_an']?></td>
            <td><?php echo $cong_thuc['loai_mon']?></td>
            <td><?php echo $cong_thuc['nguyen_lieu']?></td>
            <td><?php echo $cong_thuc['thoi_gian_nau']?></td>
            <td><?php echo $cong_thuc['mo_ta']?></td>
            <td><?php echo $cong_thuc['buoc_lam']?></td>
            <td class="chucnang">
                <a href="admin.php?page=capnhatcongthuc&id=<?php echo $cong_thuc['mon_an_id']?>" class="nutcapnhat">
                    Cập nhật
                </a>
                <a href="congthuc/xoacongthuc.php?id=<?php echo $cong_thuc['mon_an_id']?>" class="nutxoa">
                    Xóa
                </a>
            </td>

        </tr>
        <?php }?>
    </table>

</body>
</html>