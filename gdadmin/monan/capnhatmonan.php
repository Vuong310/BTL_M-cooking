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
            #Bắt đầu xử lý thêm ảnh
            // Xử lý ảnh
            $poster = $_FILES["fileToUploads"]["name"];
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
            $uploadOk = 1;

            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Nếu có file thì mới kiểm tra
            if (!empty($_FILES["fileToUpload"]["tmp_name"])) {
                $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                if ($check === false) {
                    echo "File không phải là ảnh.";
                    $uploadOk = 0;
                }
                if ($_FILES["fileToUpload"]["size"] > 50000000) {
                    echo "File quá lớn";
                    $uploadOk = 0;
                }
                if(!in_array($imageFileType, ["jpg","jpeg","png","gif"])) {
                    echo "Chỉ JPG, JPEG, PNG & GIF được chấp nhận.";
                    $uploadOk = 0;
                }
            }

            // Nếu có file hợp lệ thì upload và update kèm ảnh
            if ($uploadOk == 1 && !empty($_FILES["fileToUpload"]["tmp_name"])) {
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                    $sql = "UPDATE mon_an 
                            SET hinh_anh='$target_file', ten_mon_an='$tenMonAn', mo_ta='$moTa',
                                thoi_gian_nau='$thoiGianNau', nguoi_dang_id='$nguoiDang', trang_thai='$trangThai'
                            WHERE id='$id'";
                    mysqli_query($conn, $sql);
                }
            } 
            else {
                // Nếu không có file thì update nhưng bỏ hinh_anh
                $sql = "UPDATE mon_an 
                        SET ten_mon_an='$tenMonAn', mo_ta='$moTa', thoi_gian_nau='$thoiGianNau',
                            nguoi_dang_id='$nguoiDang', trang_thai='$trangThai'
                        WHERE id='$id'";
                mysqli_query($conn, $sql);
            }
            header('location: admin.php?page=monan');
            exit;
        }
        else{
            $warning = True;
        }
        
    ?>
            

    <form action="admin.php?page=capnhatmonan&id=<?php echo $id ?>" method="post" enctype="multipart/form-data">
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
            <p>Poster</p>
            <img src="<?php echo $monAn['hinh_anh']?>">
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
            <input type="submit" name="submit" value="Cập nhật">
        </div>
    </form>   
    <?php
        if($warning === True){
            echo "<p class='warning'>Vui lòng nhập đầy đủ thông tin</p>";
        }
    ?>     
</body>
</html>
