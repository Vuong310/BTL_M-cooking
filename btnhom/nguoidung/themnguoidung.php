<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="cacform.css">
</head>
<body>
    <form action="admin.php?page=themnguoidung" method="post">
        <h2>Thêm người dùng</h2>
        <div class="tendangnhap">
            <div>
                <p>Tên người dùng</p>
                <input type="text" name="ten-nguoi-dung">
            </div>
            <div>
                <p>Mật khẩu</p>
                <input type="password" name="mat-khau">
            </div>
        </div>
        <div>
            <p>Họ và tên</p>
            <input type="text" name="ho-ten">
        </div>
        <div>
            <p>Ngày sinh</p>
            <input type="date" name="ngay-sinh">
        </div>
        <div>
            <p>Số điện thoại</p>
            <input type="text" name="sdt">
        </div>
        <div>
            <p>Email</p>
            <input type="email" name="email">
        </div>
        <div>
            <p>Vai trò</p>
            <select name="vai-tro" id="">
                <option value="0">--Chọn vai trò--</option>
                <option value="1">Admin</option>
                <option value="2">Người dùng</option>
            </select>
        </div>
        <div>
            <input type="submit" value="Thêm mới">
        </div>

    </form>
</body>
</html>