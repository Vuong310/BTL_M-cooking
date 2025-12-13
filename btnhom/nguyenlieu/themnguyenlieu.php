<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm nguyên liệu</title>            
    <link rel="stylesheet" href="cacform.css">
</head>
<body>
    <?php
        if((!empty($_POST['ten-nguyen-lieu']))){
            $tenNguyenLieu = $_POST['ten-nguyen-lieu'];
            
            include('connect.php');
            $sql = "INSERT INTO nguyen_lieu(ten_nguyen_lieu) VALUES ('$tenNguyenLieu')";
            mysqli_query($conn, $sql);
            header('location: admin.php?page=nguyenlieu');
        }
        else{
            echo "<p>Vui lòng điền đầy đủ thông tin!</p>";
        }
    ?>
    <form action="admin.php?page=themnguyenlieu" method="post">
        <h2>Thêm nguyên liệu</h2>
        <div>
            <p>Tên nguyên liệu</p>
            <input type="text" name="ten-nguyen-lieu">
        </div>
        <div>
            <input type="submit" value="Thêm mới">
        </div>

    </form>
</body>
</html>