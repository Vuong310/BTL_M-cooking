<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="cacform.css">
</head>
<body>
    <?php
        if((!empty($_POST['ten-mon-an'])) &&
            (!empty($_POST['loai-mon'])) &&
            (!empty($_POST['nguyen-lieu'])) &&
            (!empty($_POST['thoi-gian-nau'])) &&
            (!empty($_POST['mo-ta'])) &&
            (!empty($_POST['buoc-lam']))){

            include('connect.php');
            $tenMonAn = $_POST['ten-mon-an'];
            $loaiMon = $_POST['loai-mon'];
            $nguyenLieu = $_POST['nguyen-lieu'];
            $thoiGianNau = $_POST['thoi-gian-nau'];
            $moTa = $_POST['mo-ta'];
            $buocLam = $_POST['buoc-lam'];

            /* THÊM VÀO BẢNG mon_an */
            $sqlMonAn = "INSERT INTO mon_an(ten_mon_an, thoi_gian_nau, mo_ta) VALUES ('$tenMonAn','$thoiGianNau','$moTa')";
            mysqli_query($conn, $sqlMonAn);

            $idMonAn = mysqli_insert_id($conn);

            /* THÊM BƯỚC LÀM VÀO BẢNG cong_thuc */
            $sqlCongThuc = "INSERT INTO cong_thuc(mon_an_id,buoc_lam) VALUES ('$idMonAn','$buocLam')";
            mysqli_query($conn, $sqlCongThuc);

            /* THÊM LOẠI MÓN */
            foreach ($loaiMon as $idLoaiMon) {
                $sqlLoai = "INSERT INTO mon_an_loai_mon(mon_an_id,loai_mon_id) VALUES ('$idMonAn','$idLoaiMon')";
                mysqli_query($conn, $sqlLoai);
            }

            /* THÊM NGUYÊN LIỆU */
            foreach ($nguyenLieu as $idNguyenLieu) {
                $sqlNguyenLieu = "INSERT INTO mon_an_nguyen_lieu(mon_an_id,nguyen_lieu_id) VALUES ('$idMonAn','$idNguyenLieu')";
                mysqli_query($conn, $sqlNguyenLieu);
            }

            header('location: admin.php?page=congthuc');
            exit;
        }
        else{
            echo "<p class='error'>Vui lòng điền đầy đủ thông tin!</p>";
        }
    ?>
    <form action="admin.php?page=themcongthuc" method="post">
        <h2>Thêm công thức</h2>
        <div>
            <p>Tên món ăn</p>
            <input type="text" name="ten-mon-an">
        </div>
        <div>
            <p>Loại món</p>
            <select name="loai-mon[]" multiple>
                <?php
                $sql = "SELECT * FROM loai_mon";
                $result = mysqli_query($conn, $sql);

                while ($row = mysqli_fetch_assoc($result)) {
                ?>
                    <option value="<?php echo $row['id'] ?>"><?php echo $row['ten_loai'] ?></option>;
                <?php } ?>
            </select>
        </div>
        <div>
            <p>Nguyên liệu</p>
            <input type="text" name="nguyen-lieu">
        </div>
        <div>
            <p>Thời gian nấu</p>
            <input type="text" name="thoi-gian-nau">
        </div>
        <div>
            <p>Mô tả</p>
            <textarea name="mo-ta" id=""></textarea>
        </div>
        <div>
            <p>Bước làm</p>
            <textarea name="buoc-lam" id=""></textarea>
        </div>
        <div class="sua">
            <input type="submit" value="Thêm mới" style="margin: 15px 0 10px 0; width: 50%;">
        </div>

    </form>
</body>
</html>