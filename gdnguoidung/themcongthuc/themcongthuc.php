<?php
    session_start();
    if(!isset($_SESSION['username'])){
        header('location:../login/login.php');
        exit;
    }
    include ("../connect.php");
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $tenMonAn = $_POST['ten-mon-an'];
        $moTa = $_POST['mo-ta'];
        $thoiGianNau = $_POST['thoi-gian-nau'];
        $nguoiDang = $_POST['nguoi-dang'];
        $ngayDang = $_POST['ngay-dang'];
        $ds_loaiMon = $_POST['loai-mon'] ?? [];
        $ds_buocLam = $_POST['buoc'] ??[];
        $trangThai = $_POST['trang-thai'];


        #Bắt đầu xử lý thêm ảnh
        // Xử lý ảnh
        $poster = $_FILES["fileToUpload"]["name"];
        $target_dir = "../gdadmin/uploads/";
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
                VALUES ('$tenMonAn','$moTa','$thoiGianNau','$nguoiDang','$ngayDang','$target_file','chua_duyet')";
                //echo $sql;
                mysqli_query($conn, $sql);
                $monAnId = mysqli_insert_id($conn);

                // 4. Thêm loại món (mon_an_loai_mon)
                for ($i = 0; $i < count($ds_loaiMon); $i++) {
                    $id_loaiMon = $ds_loaiMon[$i];
                        mysqli_query($conn, "INSERT INTO mon_an_loai_mon(mon_an_id, loai_mon_id) VALUES ('$monAnId', '$id_loaiMon')");
                }

                // 5. Thêm nguyên liệu (mon_an_nguyen_lieu)
                $ds_nguyenLieu = $_POST['nguyenlieu'] ?? [];
                $ds_soLuong = $_POST['soluong'] ?? [];

                for ($i = 0; $i < count($ds_nguyenLieu); $i++) {
                    $nguyenLieuId = $ds_nguyenLieu[$i];
                    $soLuong = $ds_soLuong[$i] ?? '';

                    if($nguyenLieuId && $soLuong){
                        mysqli_query($conn, "INSERT INTO mon_an_nguyen_lieu(mon_an_id, nguyen_lieu_id, so_luong) VALUES ('$monAnId', '$nguyenLieuId', '$soLuong')");
                    }
                }

                // 6. Thêm các bước làm (cong_thuc)
                for ($i = 0; $i < count($ds_buocLam); $i++) {
                    $buoc_lam = trim($ds_buocLam[$i]);
                    if ($buoc_lam != '') {
                        mysqli_query(
                            $conn,
                            "INSERT INTO cong_thuc(mon_an_id, buoc_lam)
                            VALUES ('$monAnId', '$buoc_lam')"
                        );
                    }
                }

                header('location: index.php?page=trangchu');
                exit;
            }
        }


    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm món ăn mới</title>
    <link rel="stylesheet" href="../gdadmin/cacform.css">
    <style>
        body{
            display: flex;
            flex-direction: column;
            color:#324f23;
            margin:10vh auto;
            margin-bottom:0;
        }
        form{width:70%; 
            flex-direction:column; gap:5px; padding:30px; 
        }
        input, select, textarea{border:none; width:100%; padding:5px; }
        .nguyenlieu, .loaimon{display:flex; gap:10px; margin-bottom:5px; width:50%}
        h1{text-align:center;}
        .muc{width:100%}
        .cacmuc{display:flex; align-items:center;}
        h3{width:100%}
        .dungscrip{flex:1}
    </style>
</head>
<body>
    <h1>Thêm món ăn mới</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <div style="display:flex; gap:10x;">
            <div style="flex:1">
                <h3>Thêm hình ảnh</h3>
                <input type="file" name="fileToUpload" >
            </div>
            <div style="height:auto; flex:1">
                <div class="cacmuc">
                    <h3>Tên món ăn</h3>
                    <input type="text" name="ten-mon-an" placeholder="Nhập tên món ăn" required>
                </div>
                <div class="cacmuc">
                    <h3>Mô tả ngắn gọn</h3>
                    <textarea name="mo-ta" placeholder="Nhập mô tả" required></textarea>
                </div>
                <div class="cacmuc">
                    <h3>Người đăng</h3>
                    <input type="text" name="nguoi-dang" placeholder="Người đăng - id">
                </div>
                <div class="cacmuc">
                    <h3>Ngày đăng</h3>
                    <input type="text" name="ngay-dang" placeholder="Ngày đăng">
                </div>
                <div class="cacmuc">
                    <h3>Thời gian nấu</h3>
                    <textarea name="thoi-gian-nau" placeholder="Nhập thời gian nấu" required></textarea>
                </div>
            </div>
        </div>
        <div style="display:flex; gap:10px; ">
            <div class="dungscrip">
                <h3>Loại món</h3>
                <div class="loaimon-wrapper">
                    <div class="loaimon">
                        <select name="loai-mon[]">
                            <?php
                                $res = mysqli_query($conn, "SELECT * FROM loai_mon");
                                while($row = mysqli_fetch_assoc($res)){
                                    echo "<option value='{$row['id']}'>{$row['ten_loai']}</option>";
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div>
                    <button type="button" class="nut" onclick="themLoaiMon()">Thêm loại món</button>
                </div>
            </div>
            <div class="dungscrip">
                <h3>Nguyên liệu</h3>
                <div class="nguyenlieu-wrapper">
                    <div class="nguyenlieu">
                        <select name="nguyenlieu[]">
                            <?php
                                $res = mysqli_query($conn, "SELECT * FROM nguyen_lieu");
                                while($row = mysqli_fetch_assoc($res)){
                                    echo "<option value='{$row['id']}'>{$row['ten_nguyen_lieu']}</option>";
                                }
                            ?>
                        </select>
                        <input type="text" name="soluong[]" placeholder="Định lượng">
                    </div>
                </div>
                <div>
                    <button type="button" class="nut" onclick="themNguyenLieu()">Thêm nguyên liệu</button>
                </div>
            </div>
            <div class="dungscrip">
                <h3>Các bước thực hiện</3>
                <ol class="thembuoc">
                    <li><textarea name="buoc[]"></textarea></li>
                    <li><textarea name="buoc[]"></textarea></li>
                </ol>
                <div>
                    <button type="button" class="nut" onclick="themBuoc()">Thêm bước</button>
                </div>
            </div>
        </div>
        <div>
            <input type="submit" value="Thêm món">
        </div>
    </form>

    <script>
        function themHTML(wrapper, html){
            document.querySelector(wrapper).insertAdjacentHTML('beforeend', html);
        }

        function themLoaiMon(){
            themHTML('.loaimon-wrapper', `
                <div class="loaimon">
                    <select name="loai-mon[]">
                        <?php
                            $res = mysqli_query($conn, "SELECT * FROM loai_mon");
                            while($row = mysqli_fetch_assoc($res)){
                                echo "<option value='{$row['id']}'>{$row['ten_loai']}</option>";
                            }
                        ?>
                    </select>
                </div>
            `);
        }

        function themNguyenLieu(){
            themHTML('.nguyenlieu-wrapper', `
                <div class="nguyenlieu">
                    <select name="nguyenlieu[]">
                        <?php
                            $res = mysqli_query($conn, "SELECT * FROM nguyen_lieu");
                            while($row = mysqli_fetch_assoc($res)){
                                echo "<option value='{$row['id']}'>{$row['ten_nguyen_lieu']}</option>";
                            }
                        ?>
                    </select>
                    <input type="text" name="soluong[]" placeholder="Định lượng">
                </div>
            `);
        }

        function themBuoc(){
            themHTML('.thembuoc', `<li><textarea name="buoc[]"></textarea></li>`);
        }
    </script>
</body>
</html>