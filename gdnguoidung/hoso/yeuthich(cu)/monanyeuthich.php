<?php
if(session_status() == PHP_SESSION_NONE){
    session_start();
}
include __DIR__ . '/../../../connect.php'; // đường dẫn tới connect.php

$userId = $_SESSION['user_id'] ?? 1;

// Lấy danh sách các món đã yêu thích của user
$liked = false;
$sql = "SELECT ma.*
        FROM mon_an ma
        JOIN mon_an_yeu_thich yt ON yt.mon_an_id = ma.id
        WHERE yt.nguoi_dung_id = $userId
        ORDER BY yt.ngay_them DESC";

$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result) > 0) $liked = true;
?>

<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<title>Các món ăn yêu thích</title>
<style>
.yeu-thich {
    cursor: pointer;
    background-color: #f1e9d2;
    color: #324f23;
    font-size: 16px;
    font-weight: bold;
    border: 2px solid #324f23;
    border-radius: 10px;
    padding: 8px 20px;
    display: flex;
    align-items: center;
    gap: 5px;
    transition: 0.3s;
}
</style>
</head>
<body>
<h1>Các món ăn bạn đã yêu thích</h1>

<div id="list-yeu-thich">
<?php if(mysqli_num_rows($result) > 0): ?>
    <?php while($row = mysqli_fetch_assoc($result)): ?>
        <div>
            <h3><?= htmlspecialchars($row['ten_mon_an']) ?></h3>
            <p><?= htmlspecialchars($row['mo_ta']) ?></p>
            <?php if(!empty($row['hinh_anh'])): ?>
                <img src="<?= htmlspecialchars($row['hinh_anh']) ?>" width="200" alt="<?= htmlspecialchars($row['ten_mon_an']) ?>">
            <?php endif; ?>
            <br>
            <button class="yeu-thich" data-id="<?= $row['id'] ?>">
                <?= $liked ? "Đã yêu thích" : "Yêu thích" ?>
            </button>
        </div>
    <?php endwhile; ?>
<?php else: ?>
    <p>Bạn chưa yêu thích món ăn nào.</p>
<?php endif; ?>
</div>

<script>
// Gắn sự kiện cho các nút bỏ yêu thích
function bindYeuThichBtns() {
    document.querySelectorAll("#list-yeu-thich .yeu-thich").forEach(btn => {
        btn.addEventListener("click", function() {
            const monAnId = this.getAttribute("data-id");
            fetch("capnhatmonanyeuthich.php", {
                method: "POST",
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                body: "mon_an_id=" + monAnId + "&liked=0"
            })
            .then(res => res.json())
            .then(data => {
                if(data.removed) this.parentElement.remove();
            })
            .catch(err => console.error(err));
        });
    });
}

// Gọi bind khi load
bindYeuThichBtns();
</script>
</body>
</html>
