<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cập nhật nguyên liệu</title>
    <link rel="stylesheet" href="cacform.css">
</head>
<body>
    <?php
        include('../connect.php');
        $id = $_GET['id'];
        $sql = "SELECT * from nguyen_lieu where id = '$id'";
        $result = mysqli_query($conn, $sql);
        $nguyenLieu = mysqli_fetch_assoc($result);
    ?>
    <?php
        if((!empty($_POST['ten-nguyen-lieu']))) {
            $tenNguyenLieu = $_POST['ten-nguyen-lieu'];
            
            $sql = "UPDATE `nguyen_lieu` SET `ten_nguyen_lieu`='$tenNguyenLieu' WHERE `id`='$id'";
            mysqli_query($conn, $sql);
            header('location: admin.php?page=nguyenlieu');
        }
        else{
            echo "<p>Vui lòng điền đầy đủ thông tin!</p>";
        }
    ?>
    <form action="admin.php?page=capnhatnguyenlieu&id=<?php echo $id ?>" method="post">
        <h2>Thêm nguyên liệu</h2>
        <div>
            <p>Tên nguyên liệu</p>
            <input type="text" name="ten-nguyen-lieu" value="<?php echo $nguyenLieu['ten_nguyen_lieu']?>">
        </div>
        <div>
            <input type="submit" value="Cập nhật">
        </div>

    </form>
</body>
</html>