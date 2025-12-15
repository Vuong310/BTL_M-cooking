<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cập nhật món ăn</title>
    <link rel="stylesheet" href="cacform.css">
</head>
<body>
    <?php 
        include ('../connect.php');
        $id = $_GET['id'];
        $sql = "SELECT * FROM mon_an WHERE id = '$id'";
        $result = mysqli_query($conn, $sql);
        $monAn = mysqli_fetch_assoc($result);
    ?>
    <?php
        if(
            !empty($_POST['ten-mon-an']) &&
            !empty($_POST['mo-ta']) &&
            !empty($_POST['thoi-gian-nau']) &&
            !empty($_POST['nguoi-dang']) &&
            !empty($_POST['ngay-dang']) && 
            !empty($_POST['trang-thai']) 
        ){
            $tenMonAn = $_POST['ten-mon-an'];
            $moTa = $_POST['mo-ta'];
            $thoiGianNau = $_POST['thoi-gian-nau'];
            $nguoiDang = $_POST['nguoi-dang'];
            $ngayDang = $_POST['ngay-dang'];
            $trangThai = $_POST['trang-thai'];

            $sql = "UPDATE `mon_an` SET `ten_mon_an`='$tenMonAn',`mo_ta`='$moTA',`thoi_gian_nau`='$thoiGianNau',`nguoi_dang_id`='$nguoiDang',`trang_thai`='$trangThai' WHERE `id`='$id'";
            //echo $sql;
            mysqli_query($conn, $sql);
            header('location: admin.php?page=monan');    
        }
        else{
            echo "<p class='warning'>Vui lòng nhập đầy đủ thông tin</p>";
        }
    ?>
            

    <form action="admin.php?page=capnhatmonan&id=<?php echo $id ?>" method="post">
        <div>
            <p>Tên món ăn</p>
            <input type="text" name="ten-mon-an" value="<?php echo $monAn['ten_mon_an']?>">
        </div>
        <div>
            <p>Mô tả</p>
            <input type="text" name="mo-ta" value="<?php echo $monAn['mo_ta']?>">
        </div>
        <div>
            <p>Thời gian nấu</p>
            <input type="number" name="thoi-gian-nau" value="<?php echo $monAn['thoi_gian_nau']?>">
        </div>
        <div>
            <p>Người đăng</p>
            <input type="text" name="nguoi-dang" value="<?php echo $monAn['nguoi_dang_id']?>">
        </div>
        <div>
            <p>Ngày đăng</p>
            <input type="text" name="ngay-dang" value="<?php echo $monAn['ngay_dang']?>">
        </div>
        <div>
            <p>poster</p>
            <input type="file" name="fileToUpload" >
        </div>
        <div>
            <p>Trạng thái</p>
            <select name="trang-thai" id="">
                <option value="cho_duyet" <?php if($monAn['trang_thai']=='cho_duyet') echo 'selected'?>>Chờ duyệt</option>
                <option value="da_duyet" <?php if($monAn['trang_thai']=='da_duyet') echo 'selected'?>>Đã duyệt</option>
            </select>
        </div>
        <div>
            <input type="submit" name="submit" value="Thêm mới">
        </div>
    </form>        
</body>
</html>
