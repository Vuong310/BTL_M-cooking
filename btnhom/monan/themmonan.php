<?php
    include "connect.php";
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

        // Kiểm tra xem file ảnh có hợp lệ không
        if(!empty($_FILES["fileToUpload"]["tmp_name"])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($check !== false) {
                $uploadOk = 1;
            } else {
                echo "File không phải là ảnh.";
                $uploadOk = 0;
            }
        }

        // Kiểm tra nếu file đã tồn tại
        /*if (file_exists($target_file)) {
            echo "File này đã tồn tại trên hệ thông";
            $uploadOk = 0;
        }*/

        // Kiểm tra kích thước file
        if ($_FILES["fileToUpload"]["size"] > 50000000) {
            echo "File quá lớn";
            $uploadOk = 0;
        }

        // Cho phép các định dạng file ảnh nhất định
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            echo "Chỉ những file JPG, JPEG, PNG & GIF mới được chấp nhận.";
            $uploadOk = 0;
        }
        
        #Kết thúc xử lý ảnh
        if($uploadOk == 0){
            echo "File của bạn chưa được tải lên";
        }
        else{
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                //Đoạn code xử lý login ban đầu
                $sql = "INSERT INTO `mon_an`(`ten_mon_an`, `mo_ta`, `thoi_gian_nau`, `nguoi_dang_id`, `ngay_dang`, `hinh_anh`, `trang_thai`) 
                VALUES ('$tenMonAn','$moTa','$thoiGianNau','$nguoiDang','$ngayDang','$target_file','$trangThai')";
                //echo $sql;
                mysqli_query($conn, $sql);
                
                $id_monAn = mysqli_insert_id($conn);

                header('location: admin.php?page=monan');
                exit;
            }
            else {
                echo "<p class='warning'>Vui lòng nhập đầy đủ thông tin</p>";
            } 
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm món ăn</title>
    <link rel="stylesheet" href="cacform.css">
    
</head>
<body>
    <form action="admin.php?page=themmonan" method="post" enctype="multipart/form-data">
        <h2>Thêm món ăn</h2>
        <div>
            <p>Tên món an</p>
            <input type="text" name="ten-mon-an" placeholder="Tên món ăn">
        </div>
        <div>
            <p>Mô tả</p>
            <input type="text" name="mo-ta" placeholder="Mô tả">
        </div>
        <div
            <p>Thời gian nấu</p>
            <input type="number" name="thoi-gian-nau" placeholder="Thời gian nấu">
        </div>
        <div>
            <p>Người đăng</p>
            <input type="text" name="nguoi-dang" placeholder="Người đăng">
        </div>
        <div>
            <p>Ngày đăng</p>
            <input type="text" name="ngay-dang" placeholder="Ngày đăng">
        </div>
        <div>
            <p>poster</p>
            <input type="file" name="fileToUpload" >
        </div>
        <div>
            <p>Trạng thái</p>
            <input type="text" name="trang-thai" placeholder="Trạng thái">
        </div>
        <div>
            <input type="submit" name="submit" value="Thêm mới">
        </div>
    </form>
</body>
</html>



