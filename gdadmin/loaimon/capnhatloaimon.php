<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cập nhật loại món</title>
    <link rel="stylesheet" href="cacform.css">
</head>
<body>
    <?php
        include('../connect.php');
        $id = $_GET['id'];
        $sql = "SELECT * from loai_mon where id = '$id'";
        $result = mysqli_query($conn, $sql);
        $loaiMon = mysqli_fetch_assoc($result);
    ?>
    <?php
        if((!empty($_POST['ten-loai']))) {
            $tenLoai = $_POST['ten-loai'];
            
            $sql = "UPDATE `loai_mon` SET `ten_loai`='$tenLoai' WHERE `id`='$id'";
            mysqli_query($conn, $sql);
            header('location: admin.php?page=loaimon');
        }
        else{
            echo "<p>Vui lòng điền đầy đủ thông tin!</p>";
        }
    ?>
    <form action="admin.php?page=capnhatloaimon&id=<?php echo $id ?>" method="post">
        <h2>Thêm loại món</h2>
        <div>
            <p>Tên loại món</p>
            <input type="text" name="ten-loai" value="<?php echo $loaiMon['ten_loai']?>">
        </div>
        <div>
            <input type="submit" value="Cập nhật">
        </div>

    </form>
</body>
</html>