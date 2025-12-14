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
        <h1>Quản lý Người dùng</h1>
        <a href="admin.php?page=themnguoidung" class="nut">Thêm người dùng</a>
    </div>
    <table border=1>
        <tr>
            <th>Tên đăng nhập</th>
            <th>Mật khẩu</th>
            <th>Họ tên</th>
            <th>Giới tính</th>
            <th>Email</th>
            <th>Số điện thoại</th>
            <th>Vai trò</th>
            <th>Ngày sinh</th>
            <th>Chức năng</th>
        </tr>
        <?php
            include('connect.php');
            $sql = "SELECT nd.*, vt.ten_vai_tro from nguoi_dung nd join vai_tro vt on nd.vai_tro_id = vt.id";
            $result = mysqli_query($conn,$sql);
            while($row = mysqli_fetch_array($result)){
        ?>
        <tr>
            <td><?php echo $row['ten_dang_nhap']?></td>
            <td><?php echo $row['mat_khau']?></td>
            <td><?php echo $row['ho_ten']?></td>
            <td><?php echo $row['gioi_tinh']?></td>
            <td><?php echo $row['email']?></td>
            <td><?php echo $row['sdt']?></td>
            <td><?php echo $row['ten_vai_tro']?></td>
            <td><?php echo $row['ngay_sinh']?></td>
            <td class="chucnang">
                <a href="admin.php?page=capnhatnguoidung&id=<?php echo $row['id']?>" class="nutcapnhat">Cập nhật</a>
                <a href="nguoidung/xoanguoidung.php?id=<?php echo $row['id']?>" class="nutxoa">Xóa</a>
            </td>
        </tr>
        <?php }?>
        
    </table>
    
</body>
</html>