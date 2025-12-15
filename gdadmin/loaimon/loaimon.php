<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loại món</title>
    <link rel="stylesheet" href="cacbang.css">
</head>
<body>
    
    <div class="dau">
        <h1>Quản lý Loại món</h1>
        <a href="admin.php?page=themloaimon" class="nut">Thêm loại món</a>
    </div>
    <table border=1 style="width:50%; margin: 0 auto; text-align: center;">
        <tr>
            <th>STT</th>
            <th>Loại món</th>
        </tr>
        <?php
            include('../connect.php');
            $sql = "SELECT * from loai_mon";
            $result = mysqli_query($conn,$sql);
            while($row = mysqli_fetch_array($result)){
        ?>
        <tr>
            <td><?php echo $row['id']?></td>
            <td><?php echo $row['ten_loai']?></td>
            <td class="chucnang">
                <a href="admin.php?page=capnhatloaimon&id=<?php echo $row['id']?>" class="nutcapnhat">Cập nhật</a>
                <a href="loaimon/xoaloaimon.php?id=<?php echo $row['id']?>" class="nutxoa">Xóa</a>
            </td>
        </tr>
        <?php }?>
        
    </table>
    
</body>
</html>