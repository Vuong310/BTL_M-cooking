<?php
include('connect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // 1. Lấy dữ liệu cơ bản
    $tenMonAn = $_POST['ten-mon-an'];
    $moTa = $_POST['mo-ta'];
    $thoiGianNau = $_POST['thoi-gian-nau'];
    $ds_loaiMon = $_POST['loai-mon'] ?? [];
    $ds_buocLam = $_POST['buoc'] ??[];

    // 3. Thêm món ăn vào mon_an
    $sqlMonAn = "INSERT INTO mon_an (ten_mon_an, mo_ta, thoi_gian_nau) 
                 VALUES ('$tenMonAn', '$moTa', '$thoiGianNau')";
    mysqli_query($conn, $sqlMonAn);
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

    // 7. Chuyển hướng về danh sách công thức
    header('Location: admin.php?page=congthuc');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm món ăn mới</title>
    <link rel="stylesheet" href="cacform.css">
    <style>
        form{width:60%; margin:auto; display:flex; flex-direction:column; gap:10px;}
        /* input, select, textarea{width:100%; padding:5px;} */
        .nguyenlieu, .loaimon{display:flex; gap:10px; margin-bottom:5px;}
        .them{display:flex; justify-content:center; margin-top:10px;}
        h1{text-align:center;}
    </style>
</head>
<body>
    <h1>Thêm món ăn mới</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <p>Tên món ăn</p>
        <input type="text" name="ten-mon-an" placeholder="Nhập tên món ăn" required>

        <p>Mô tả ngắn gọn</p>
        <textarea name="mo-ta" placeholder="Nhập mô tả" required></textarea>

        <p>Thời gian nấu (phút)</p>
        <input type="number" name="thoi-gian-nau" placeholder="Nhập thời gian nấu" required>

        <p>Loại món</p>
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
        <div class="them">
            <button type="button" class="nut" onclick="themLoaiMon()">Thêm loại món</button>
        </div>

        <p>Nguyên liệu</p>
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
        <div class="them">
            <button type="button" class="nut" onclick="themNguyenLieu()">Thêm nguyên liệu</button>
        </div>

        <p>Các bước thực hiện</p>
        <ol class="thembuoc">
            <li><textarea name="buoc[]"></textarea></li>
            <li><textarea name="buoc[]"></textarea></li>
        </ol>
        <div class="them">
            <button type="button" class="nut" onclick="themBuoc()">Thêm bước</button>
        </div>

        <div class="them">
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
