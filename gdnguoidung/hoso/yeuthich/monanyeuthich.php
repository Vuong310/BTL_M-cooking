<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['username'])) {
    echo "Vui lòng đăng nhập";
    exit;
}
include __DIR__ . ('/../../../connect.php');
$tenDangNhap = $_SESSION['username'];
// lấy ID người dùng từ DB
$sql = "SELECT id FROM nguoi_dung WHERE ten_dang_nhap = '$tenDangNhap'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$user_id = (int)$row['id'];

// Lấy danh sách các món đã yêu thích của nd
$sql1 = "SELECT ma.*
        FROM mon_an ma
        JOIN mon_an_yeu_thich yt ON yt.mon_an_id = ma.id
        WHERE yt.nguoi_dung_id = $user_id
        ORDER BY yt.ngay_them DESC";
$result = mysqli_query($conn, $sql1);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<title>Các món ăn yêu thích</title>
<style>
.danhsach { 
    display: flex;
    flex-direction:column;
    width:85%;
    margin:auto;
}
.monan1 {
    display: flex;
    border-radius: 12px;
    padding: 15px;
    gap: 20px;
    
}
.monan1 img {
    width: 200px;
    height: 200px;
    border-radius: 10px;
    flex:1;
}
.mota-monan {
    display:flex;
    flex-direction:column;
    justify-content: center;
    background-color: #e0d9bf;
    width: 480px;
    border-radius: 10px;
    padding: 0 10px;
    color:#324f23;
    flex:2;
}
.mota-monan p{
    font-weight:bold;
}

</style>
</head>
<body>
<h1 style="text-align:center;">Các món ăn bạn đã yêu thích</h1>

<div class="danhsach">
    <?php
        if(mysqli_num_rows($result) > 0){
    ?>
        <?php
            while($row = mysqli_fetch_assoc($result)){
        ?>
            <div class="chucnang">
                <a href="index.php?page=chitietmonan&id=<?php echo $row['id']?>">
                    <div class="monan1">
                    <img src="../gdadmin/<?php echo $row['hinh_anh'];?>">
                    <div class="mota-monan">
                        <h3><?php echo $row['ten_mon_an']?></h3>
                        <p>Mô tả: <?php echo $row['mo_ta']?></p>
                    </div>
                </div>
                </a>
            </div>
    <?php 
        }
    } else{
        echo "Bạn chưa yêu thích món ăn nào.";
    }
    ?>
</div>
</body>
</html>

