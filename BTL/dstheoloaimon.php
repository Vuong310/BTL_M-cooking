<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body style="margin-top: 10vh;">
    <?php
        include('../btnhom/connect.php');
        $id = $_GET['id'];
        $sql = "SELECT ma.id AS mon_an_id,
                    ma.ten_mon_an,
                    lm.ten_loai
                FROM mon_an ma
                JOIN mon_an_loai_mon malm ON ma.id = malm.mon_an_id
                JOIN loai_mon lm ON malm.loai_mon_id = lm.id
                WHERE lm.id = $id";
        $result = mysqli_query($conn, $sql);
        $loaiMon = mysqli_fetch_array($result);
    ?>
    <div>
        <h1>Loại món: <?php echo $loaiMon['ten_loai'] ?></h1>
    </div>
    <?php while ($loaiMon = mysqli_fetch_array($result)) { ?>
        <div class="monan">
            <img src="img/logo.png">
            <div class="mota">
                <p><?php echo $loaiMon['ten_mon_an']; ?></p>
                
            </div>
        </div>
    <?php } ?>

</body>
</html>