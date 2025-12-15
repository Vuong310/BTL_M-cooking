<?php
    include('../connect.php');
    $id = $_GET['id'];
    $sql = "SELECT ma.*,
                GROUP_CONCAT(DISTINCT lm.id) AS loai_ids,
                GROUP_CONCAT(DISTINCT CONCAT(nl.id,':',manl.so_luong)) AS nl_data,
                GROUP_CONCAT(DISTINCT ct.buoc_lam SEPARATOR '||') AS buoc_data
            FROM mon_an ma
            LEFT JOIN mon_an_loai_mon malm ON ma.id = malm.mon_an_id
            LEFT JOIN loai_mon lm ON malm.loai_mon_id = lm.id
            LEFT JOIN mon_an_nguyen_lieu manl ON ma.id = manl.mon_an_id
            LEFT JOIN nguyen_lieu nl ON manl.nguyen_lieu_id = nl.id
            LEFT JOIN cong_thuc ct ON ma.id = ct.mon_an_id
            WHERE ma.id='$id'
            GROUP BY ma.id";
    $result = mysqli_query($conn,$sql);
    $data = mysqli_fetch_assoc($result);

    /* TÁCH DỮ LIỆU */
    $loaiId = $data['loai_ids'] ? explode(',',$data['loai_ids']) : [];
    $nl = $data['nl_data'] ? explode(',',$data['nl_data']) : [];
    $buoc = $data['buoc_data'] ? explode('||',$data['buoc_data']) : [];
    
    /* DỮ LIỆU CHO SELECT */
    $allLoai = mysqli_fetch_all(mysqli_query($conn,"SELECT * FROM loai_mon"),MYSQLI_ASSOC);
    $allNL   = mysqli_fetch_all(mysqli_query($conn,"SELECT * FROM nguyen_lieu"),MYSQLI_ASSOC);

    /* XỬ LÝ SUBMIT */
    if($_SERVER['REQUEST_METHOD']=='POST'){
        if(!empty($_POST['ten-mon-an']) &&
            !empty($_POST['mo-ta']) &&
            !empty($_POST['thoi-gian-nau']) && 
            !empty($_POST['loai-mon'])){
            
            $tenMonAn = $_POST['ten-mon-an'];
            $moTa = $_POST['mo-ta'];
            $thoiGian = $_POST['thoi-gian-nau'];
            $dsLoai = $_POST['loai-mon'] ?? [];

            $sql = "UPDATE mon_an SET ten_mon_an='$tenMonAn', mo_ta='$moTa', thoi_gian_nau='$thoiGian' WHERE id='$id'";
            // echo $sql; 
            mysqli_query($conn, $sql);

            mysqli_query($conn,"DELETE FROM mon_an_loai_mon WHERE mon_an_id='$id'");
            $dsLoai = array_unique($dsLoai);
            for($i=0;$i<count($dsLoai);$i++){
                mysqli_query($conn, "INSERT INTO mon_an_loai_mon(mon_an_id, loai_mon_id) VALUES ('$id','{$dsLoai[$i]}')");
            }

            mysqli_query($conn,"DELETE FROM mon_an_nguyen_lieu WHERE mon_an_id='$id'");
            $dsNL = $_POST['nguyen-lieu'] ?? [];
            $dsSL = $_POST['so-luong'] ?? [];
            for($i=0;$i<count($dsNL);$i++){
                if($dsNL[$i] != '' && $dsSL[$i] != ''){
                    mysqli_query($conn, "INSERT INTO mon_an_nguyen_lieu(mon_an_id, nguyen_lieu_id, so_luong) VALUES ('$id','{$dsNL[$i]}','{$dsSL[$i]}')");
                }
            }

            mysqli_query($conn,"DELETE FROM cong_thuc WHERE mon_an_id='$id'");
            $dsBuoc = $_POST['buoc'] ?? [];
            for($i=0;$i<count($dsBuoc);$i++){
                if(trim($dsBuoc[$i]) != ''){
                    mysqli_query($conn, "INSERT INTO cong_thuc(mon_an_id, buoc_lam) VALUES ('$id','{$dsBuoc[$i]}')");
                }
            }
        }
        header('Location: admin.php?page=congthuc');
        exit();
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Cập nhật món ăn</title>
    <link rel="stylesheet" href="cacform.css">
    <style>
        form{
            width:70%; 
            margin:auto; 
            display:flex; 
            flex-direction:column; 
            gap:10px;
        }
        input, select, textarea{
            width:100%; 
            padding:5px;
        }
        .nguyenlieu, .loaimon{
            display:flex; 
            gap:10px; 
            margin-bottom:5px;
        }
        .them{
            display:flex; 
            justify-content:center; 
            margin-top:10px;
        }
        h1{
            text-align:center;
        }
        .box{
            margin-right:10px;
        }
        .thembuoc{
            margin-right:10px;
        }
    </style>
</head>
<body>
    <h1>Cập nhật món ăn</h1>
    <form method="post">
        <div class="box">
            <p>Tên món ăn</p>
            <input type="text" name="ten-mon-an" value="<?= $data['ten_mon_an'] ?>">
        </div>
        <div class="box">
            <p>Mô tả</p>
            <textarea name="mo-ta"><?= $data['mo_ta'] ?></textarea>
        </div>
        <div class="box">
            <p>Thời gian nấu</p>
            <input type="number" name="thoi-gian-nau" value="<?= $data['thoi_gian_nau'] ?>">
        </div>  

        <!-- LOẠI MÓN -->
        <p>Loại món</p>
        <div class="loaimon-wrapper">
            <?php
                if(count($loaiId)==0) $loaiId[] = '';

                for($i=0;$i<count($loaiId);$i++){
            ?>
            <div class="loaimon">
                <select name="loai-mon[]">
                    <?php
                    $res = mysqli_query($conn,"SELECT * FROM loai_mon");
                    while($row = mysqli_fetch_assoc($res)){
                        $selected = ($row['id']==$loaiId[$i])?'selected':'';
                        echo "<option value='{$row['id']}' $selected>{$row['ten_loai']}</option>";
                    }
                    ?>
                </select>
            </div>
            <?php } ?>
        </div>

        <div class="them">
            <button type="button" onclick="themLoaiMon()">Thêm loại món</button>
        </div>


        <!-- NGUYÊN LIỆU -->
        <p>Nguyên liệu</p>
        <div class="nguyenlieu-wrapper">
        <?php
        for($i=0;$i<count($nl);$i++){
            list($nlId,$sl) = explode(':',$nl[$i]);
        ?>
            <div class="nguyenlieu">
                <select name="nguyen-lieu[]">
                    <?php
                    for($j=0;$j<count($allNL);$j++){
                        $selected = ($allNL[$j]['id']==$nlId)?'selected':'';
                        echo "<option value='{$allNL[$j]['id']}' $selected>
                                {$allNL[$j]['ten_nguyen_lieu']}
                            </option>";
                    }
                    ?>
                </select>
                <input type="text" name="so-luong[]" value="<?= $sl ?>" placeholder="Định lượng">
            </div>
        <?php } ?>
        </div>

        <div class="them">
            <button type="button" onclick="themNguyenLieu()">Thêm nguyên liệu</button>
        </div>

        <!-- CÁC BƯỚC -->
        <p>Các bước thực hiện</p>
        <ol class="thembuoc">
            <?php
                for($i=0;$i<count($buoc);$i++){
                    echo "<li><textarea name='buoc[]'>{$buoc[$i]}</textarea></li>";
                }
            ?>
        </ol>

        <div class="them">
            <button type="button" onclick="themBuoc()">Thêm bước</button>
        </div>
        <div class="them">
            <input type="submit" value="Cập nhật món">
        </div>
    </form>

    <script>
        function themLoaiMon(){
            document.querySelector('.loaimon-wrapper')
                .insertAdjacentHTML('beforeend', `
                <div class="loaimon">
                    <select name="loai-mon[]">
                        <?php
                            $res = mysqli_query($conn,"SELECT * FROM loai_mon");
                            while($row = mysqli_fetch_assoc($res)){
                                echo "<option value='{$row['id']}'>{$row['ten_loai']}</option>";
                            }
                        ?>
                    </select>
                </div>
            `);
        }

        function themNguyenLieu(){
            var div = document.createElement("div");
            div.className = "nguyenlieu";

            div.innerHTML =
                '<select name="nguyen-lieu[]">' +
                '<?php
                    for($i=0;$i<count($allNL);$i++){
                        echo "<option value=\"{$allNL[$i]['id']}\">{$allNL[$i]['ten_nguyen_lieu']}</option>";
                    }
                ?>' +
                '</select>' +
                '<input type="text" name="so-luong[]" placeholder="Định lượng">';

            document.getElementsByClassName("nguyenlieu-wrapper")[0].appendChild(div);
        }
        function themBuoc(){
            var li = document.createElement("li");
            li.innerHTML = '<textarea name="buoc[]"></textarea>';
            document.getElementsByClassName("thembuoc")[0].appendChild(li);
        }
    </script>

</body>
</html>
