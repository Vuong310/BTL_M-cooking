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
        include('connect.php');
        $id = $_GET['id'];
        $sql = "SELECT 
                    ma.id AS mon_an_id,
                    ma.ten_mon_an,
                    GROUP_CONCAT(DISTINCT lm.ten_loai SEPARATOR ', ') AS loai_mon,
                    GROUP_CONCAT(DISTINCT 
                        CONCAT(nl.ten_nguyen_lieu, ' (', manl.so_luong, ')')
                        SEPARATOR ', ') AS nguyen_lieu,
                    ma.thoi_gian_nau,
                    ma.mo_ta,
                    GROUP_CONCAT(DISTINCT ct.buoc_lam ORDER BY ct.id SEPARATOR ' | ') AS buoc_lam
                FROM mon_an ma
                LEFT JOIN mon_an_loai_mon malm ON ma.id = malm.mon_an_id
                LEFT JOIN loai_mon lm ON malm.loai_mon_id = lm.id
                LEFT JOIN mon_an_nguyen_lieu manl ON ma.id = manl.mon_an_id
                LEFT JOIN nguyen_lieu nl ON manl.nguyen_lieu_id = nl.id
                LEFT JOIN cong_thuc ct ON ma.id = ct.mon_an_id
                WHERE ma.id='$id'
                GROUP BY ma.id;";
        $result = mysqli_query($conn, $sql);
        $congThuc = mysqli_fetch_assoc($result);

        
        if(isset($_POST['submit'])){
            $tenMonAn = $_POST['ten-mon-an'];
            $loaiMon = $_POST['loai-mon'];
            $nguyenLieu = $_POST['nguyen-lieu'];
            $thoiGianNau = $_POST['thoi-gian-nau'];
            $moTa = $_POST['mo-ta'];
            $buocLam = $_POST['buoc-lam'];

            if($tenMonAn && $loaiMon && $nguyenLieu && $thoiGianNau && $moTa && $buocLam){
            
                // 1. Cập nhật thông tin món ăn
                $sqlMonAn = "UPDATE mon_an SET ten_mon_an='$tenMonAn', thoi_gian_nau='$thoiGianNau', mo_ta='$moTa' WHERE id='$id'";
                mysqli_query($conn, $sqlMonAn);

                // 2. Cập nhật loại món
                mysqli_query($conn, "DELETE FROM mon_an_loai_mon WHERE mon_an_id='$id'");
                $loai = array_map('trim', explode(',', $loaiMon));
                foreach($loai as $loaiItem){
                    // Lấy id loại món
                    $res = mysqli_query($conn, "SELECT id FROM loai_mon WHERE ten_loai='$loaiItem'");
                    if(mysqli_num_rows($res) > 0){
                        $row = mysqli_fetch_assoc($res);
                        $loaiId = $row['id'];
                        mysqli_query($conn, "INSERT INTO mon_an_loai_mon(mon_an_id, loai_mon_id) VALUES ('$id', '$loaiId')");
                    }
                }

                // 3. Cập nhật nguyên liệu
                mysqli_query($conn, "DELETE FROM mon_an_nguyen_lieu WHERE mon_an_id='$id'");

                // Tách các nguyên liệu theo dấu phẩy
                $nguyenArr = array_map('trim', explode(',', $nguyenLieu));

                foreach($nguyenArr as $nguyen){
                    // Dùng regex để tách tên và số lượng theo dấu ngoặc
                    if(preg_match('/^(.*?)\s*\((.*?)\)$/', $nguyen, $matches)){
                        $tenNL = trim($matches[1]);  // Tên nguyên liệu
                        $soLuong = trim($matches[2]); // Số lượng

                        // Lấy id nguyên liệu từ bảng nguyen_lieu
                        $res = mysqli_query($conn, "SELECT id FROM nguyen_lieu WHERE ten_nguyen_lieu='$tenNL'");
                        if(mysqli_num_rows($res) > 0){
                            $row = mysqli_fetch_assoc($res);
                            $nlId = $row['id'];

                            // Chèn vào bảng mon_an_nguyen_lieu
                            mysqli_query($conn, "INSERT INTO mon_an_nguyen_lieu(mon_an_id, nguyen_lieu_id, so_luong) VALUES ('$id', '$nlId', '$soLuong')");
                        }
                    }
                }

                // 4. Cập nhật các bước làm
                mysqli_query($conn, "DELETE FROM cong_thuc WHERE mon_an_id='$id'");
                $buocArr = explode("\n", $buocLam);
                foreach($buocArr as $buoc){
                    $buoc = trim($buoc);
                    if($buoc != ''){
                        mysqli_query($conn, "INSERT INTO cong_thuc(mon_an_id, buoc_lam) VALUES ('$id', '$buoc')");
                    }
                }

                header('location: admin.php?page=congthuc');
                exit();
            }
            else{
                echo "<p class='error'>Vui lòng điền đầy đủ thông tin!</p>";
            }
        }
    ?>
    <form action="admin.php?page=capnhatcongthuc&id=<?php echo $id ?>" method="post">
        <h2>Cập nhật công thức</h2>
        <div>
            <p>Tên món ăn</p>
            <input type="text" name="ten-mon-an" value="<?php echo $congThuc['ten_mon_an']?>">
        </div>
        <div>
            <p>Loại món</p>
            <input type="text" name="loai-mon" value="<?php echo $congThuc['loai_mon']?>">
        </div>
        <div>
            <p>Nguyên liệu</p>
            <input type="text" name="nguyen-lieu" value="<?php echo $congThuc['nguyen_lieu']?>">
        </div>
        <div>
            <p>Thời gian nấu</p>
            <input type="text" name="thoi-gian-nau" value="<?php echo $congThuc['thoi_gian_nau']?>">
        </div>
        <div>
            <p>Mô tả</p>
            <textarea type="text" name="mo-ta"><?php echo $congThuc['mo_ta']?></textarea>
        </div>
        <div>
            <p>Bước làm</p>
            <textarea type="text" name="buoc-lam"><?php echo $congThuc['buoc_lam']?></textarea>
        </div>
        <div class="sua">
            <input type="submit" name="submit" value="Cập nhật" style="margin: 15px 0 10px 0; width: 50%;">
        </div>

    </form>
</body>
</html>