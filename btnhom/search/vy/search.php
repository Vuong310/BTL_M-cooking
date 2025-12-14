<?php
    // Kết nối CSDL bằng PDO
    $dsn = "mysql:host=localhost;dbname=quan_ly_web_nauan;charset=utf8mb4";
    $user = "root";
    $pass = "30122005";
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ];
    $pdo = new PDO($dsn, $user, $pass, $options);

    // Lấy dữ liệu từ form
    $ten_mon = isset($_GET['ten_mon']) ? trim($_GET['ten_mon']) : "";

    // Nếu có nhập tên món thì truy vấn
    if ($ten_mon !== "") {
        $sql = "SELECT ma.id, ma.ten_mon_an, ma.mo_ta, ma.thoi_gian_nau, ma.ngay_dang, nd.ho_ten
                FROM mon_an ma
                JOIN nguoi_dung nd ON nd.id = ma.nguoi_dang_id
                WHERE ma.ten_mon_an LIKE :ten_mon";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([':ten_mon' => "%$ten_mon%"]);
        $rows = $stmt->fetchAll();
    } else {
        $rows = [];
    }
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Kết quả tìm kiếm</title>
</head>
<body>
    <form method="get" action="search.php">
        <input type="text" name="ten_mon" placeholder="Nhập tên món ăn..." required>
        <button type="submit">Tìm kiếm</button>
    </form>

    <h3>Kết quả cho: "<?php echo htmlspecialchars($ten_mon); ?>"</h3>
    <?php if (empty($rows)): ?>
        <p>Không tìm thấy món ăn nào.</p>
    <?php else: ?>
        <ul>
            <?php foreach ($rows as $r): ?>
                <li>
                <strong><?php echo htmlspecialchars($r['ten_mon_an']); ?></strong><br>
                Mô tả: <?php echo htmlspecialchars($r['mo_ta']); ?><br>
                Thời gian nấu: <?php echo htmlspecialchars($r['thoi_gian_nau']); ?> phút<br>
                Người đăng: <?php echo htmlspecialchars($r['ho_ten']); ?><br>
                Ngày đăng: <?php echo htmlspecialchars($r['ngay_dang']); ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</body>
</html>
