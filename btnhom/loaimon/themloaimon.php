<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm loại món</title>
    <link rel="stylesheet" href="cacform.css">
</head>
<body>
    <?php
        if((!empty($_POST['ten-loai']))){
            $tenLoai = $_POST['ten-loai'];
            
            include('connect.php');
            $sql = "INSERT INTO loai_mon(ten_loai) VALUES ('$tenLoai')";
            mysqli_query($conn, $sql);
            header('location: admin.php?page=loaimon');
        }
        else{
            echo "<p>Vui lòng điền đầy đủ thông tin!</p>";
        }
    ?>
    <form action="admin.php?page=themloaimon" method="post">
        <h2>Thêm loại món</h2>
        <div>
            <p>Tên loại món</p>
            <input type="text" name="ten-loai">
        </div>
        <div>
            <input type="submit" value="Thêm mới">
        </div>

    </form>
</body>
</html>