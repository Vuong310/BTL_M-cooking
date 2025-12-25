<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['username'])) {
    echo "Vui lòng đăng nhập";
    exit;
}
include __DIR__ . '/../../../connect.php';
$username = $_SESSION['username'];
$monAnId = (int)$_POST['mon_an_id'];
$liked = (int)$_POST['liked'];

// lấy user id
$sqlUser = "SELECT id FROM nguoi_dung WHERE ten_dang_nhap = '$username'";
$resultUser = mysqli_query($conn, $sqlUser);

$user = mysqli_fetch_assoc($resultUser);
$user_id = (int)$user['id'];

if($liked === 1){
    // thêm yêu thích
    $sql = "INSERT INTO mon_an_yeu_thich (nguoi_dung_id, mon_an_id, ngay_them) 
            VALUES ($user_id, $monAnId, NOW())";
    $result = mysqli_query($conn, $sql);
    echo "added";
} else {
    // bỏ yêu thích
    $sql = "DELETE FROM mon_an_yeu_thich 
            WHERE nguoi_dung_id = $user_id AND mon_an_id = $monAnId";
    $result = mysqli_query($conn, $sql);
    echo "removed";
}
?>
