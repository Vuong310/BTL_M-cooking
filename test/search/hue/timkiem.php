<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Tìm kiếm món ăn</title>
</head>
<body>

<h2>TÌM KIẾM MÓN ĂN</h2>

<form method="GET">
    <input type="text" name="keyword" placeholder="Nhập tên món ăn">
    <button type="submit">Tìm</button>
</form>

<?php
include("connect.php");

if (isset($_GET['keyword'])) {
    $keyword = $_GET['keyword'];

    $sql = "SELECT * FROM mon_an 
            WHERE ten_mon_an LIKE '%$keyword%'";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo "<h3>Kết quả tìm kiếm:</h3>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "Tên món: " . $row['ten_mon_an'] . "<br>";
        }
    } else {
        echo "Không tìm thấy món ăn!";
    }
}
?>

</body>
</html>
