<?php    
    include __DIR__ . '/../../../connect.php';

    if (!isset($_SESSION['username'])) {
        echo "<p>Chưa có lịch sử.</p>";
        exit;
    }

    $ten_dn = $_SESSION['username'];

    $sql_id = "SELECT id FROM nguoi_dung WHERE ten_dang_nhap = '$ten_dn'";
    $result_id = mysqli_query($conn, $sql_id);
    $row_id = mysqli_fetch_assoc($result_id);
    $user_id = $row_id['id'];

    $sql = "SELECT ls.id, ls.thoi_gian_xem, ls.mon_an_id, ma.ten_mon_an, ma.hinh_anh
            FROM lich_su ls
            JOIN mon_an ma ON ls.mon_an_id = ma.id
            WHERE ls.nguoi_dung_id = $user_id
            ORDER BY ls.thoi_gian_xem DESC;";
    $result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lịch sử</title>
    <style>
        h1{
            text-align: center;
            font-size: 36px;
        }
        .timeline {
            width: 80%;
            margin: 20px 0;
            padding-left: 85px;
        }
        .timeline-item {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            position: relative;
        }
        .content {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        .content img {
            width: 150px;
            height: 150px;
            border-radius: 10px;
            object-fit: cover;
        }
        .content a {
            font-size: 25px;
            font-weight: bold;
            color: #333;
            text-decoration: none;
        }
        .time-chucnang {
            display: flex;
            align-items: flex-end;
            margin-left: auto;
            gap: 50px;
        }
        .time {
            font-size: 16px;
            color: #666;
            margin-top: 5px;
            margin-left: 50%; 
        }
        .nutxoa{
            color: #f1e9d2;
            background-color: #324f23;
            font-size: 16px;
            border-radius: 10px; 
            padding:10px 30px;
            margin-left: 10px;
            font-weight:bold;
        }
    </style>
</head>
<body>
    <h1>Lịch sử xem món ăn</h1>
    <div class="timeline">
    <?php while($row = $result->fetch_assoc()) { ?>
        <div class="timeline-item">
            <div class="content">
                <img src="/BTL_M-cooking/gdadmin/<?= $row['hinh_anh'] ?>" alt="">                 
                <a href="index.php?page=chitietmonan&id=<?php echo $row['id']; ?>">
                    <?= $row['ten_mon_an'] ?>
                </a>
            </div>

            <div class="time-chucnang">
                <div class="time">
                    <?= date('d/m/Y H:i', strtotime($row['thoi_gian_xem'])) ?>
                </div>
                
                <a href="/BTL_M-cooking/gdnguoidung/hoso/lichsu/xoa.php?id=<?php echo $row['id']?>" class="nutxoa">Xóa</a>
            </div>
        </div>
    <?php } ?>
</div>
</body>
</html>