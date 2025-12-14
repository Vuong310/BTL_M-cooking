<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BTL</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <main>
        <div>
            <img src="img/logo.png" style="width: 100%; margin-top: 10vh; margin-bottom: 50px;">
        </div>
        <div style="text-align: center;">
            <b style="font-size: 50px">  Hãy chọn món ăn mà bạn muốn</b>
        </div>
        <div class="menu" style="margin-top: 30px;">
            <?php
                include('../btnhom/connect.php');
                $sql_lm = "SELECT * from loai_mon";
                $result_lm = mysqli_query($conn, $sql_lm);
                while($lm = mysqli_fetch_array($result_lm)){
                    $loaiMonID = $lm['id'];
                    $sql = "SELECT ma.* FROM mon_an ma
                            JOIN mon_an_loai_mon malm ON ma.id = malm.mon_an_id
                            JOIN loai_mon lm ON lm.id = malm.loai_mon_id
                            WHERE ma.trang_thai = 'da_duyet' 
                            AND malm.loai_mon_id = $loaiMonID
                            ORDER BY ma.id DESC LIMIT 5";
                    $result = mysqli_query($conn, $sql);
                    if(mysqli_num_rows($result)==0){
                        continue;
                    }
            ?>
            <div>
                <h1><?php echo $lm['ten_loai'] ?></h1>
            </div>
            <div style="display: flex; gap: 30px; text-align: center;">
                <?php 
                    while($row = mysqli_fetch_array($result)){
                ?>
                <a href="index.php?page=chitietmonan&id=<?php echo $row['id']?>">
                    <div class="monan">
                        <img src="img/logo.png" style="width: 270px; height: 270px; border-radius: 10px;">
                        <div class="mota">
                            <p><?php echo $row['ten_mon_an']?></p>
                        </div>
                    </div>
                </a>
            <?php } ?> 
            </div>
        </div>
        <?php }?>
    </main>
    <footer>
        <div style="background-color: #9ab25d; color: white; border-top-left-radius: 10px ;border-top-right-radius: 10px ;">
            <div style="padding: 30px;">
                <b>Lời muốn nói</b>
                <p>Gửi lời cảm ơn chân thành đến các bạn!</p>
                Member:
                <ul>
                    <li>
                        <p>Nguyễn Kiều Vy - 2321050005</p>
                        <p>Vương Hà Linh - 2321050007</p>
                        <p>Phạm Hương Giang - 2321050010</p>
                        <p>Phạm Thị Huế - 2321050052</p>
                        <p>Cao Thị Thu Quyên - 2321050058</p>
                    </li>
                </ul>
            </div>
        </div>
    </footer>
</body>
</html>