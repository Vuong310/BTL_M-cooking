<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nguyên liệu</title>
    <link rel="stylesheet" href="cacbang.css">
</head>
<body>
    
    <div class="dau">
        <h1>Quản lý Nguyên liệu</h1>
        <a href="admin.php?page=themnguyenlieu" class="nut">Thêm nguyên liệu</a>
    </div>
    <table border=1 style="width:50%; margin: 0 auto; text-align: center;">
        <tr>
            <th>STT</th>
            <th>Nguyên liệu</th>
            <th>Chức năng</th>
        </tr>
        <?php
            include('../btnhom/connect.php');
            $sql = "SELECT * from nguyen_lieu";
            $result = mysqli_query($conn,$sql);
            while($row = mysqli_fetch_array($result)){
        ?>
        <tr>
            <td><?php echo $row['id']?></td>
            <td><?php echo $row['ten_nguyen_lieu']?></td>
            <td class="chucnang">
                <a href="admin.php?page=capnhatnguyenlieu&id=<?php echo $row['id']?>" class="nutcapnhat">Cập nhật</a>
                <a href="nguyenlieu/xoanguyenlieu.php?id=<?php echo $row['id']?>" class="nutxoa">Xóa</a>
            </td>
        </tr>
        <?php }?>
        
    </table>
    
</body>
</html>