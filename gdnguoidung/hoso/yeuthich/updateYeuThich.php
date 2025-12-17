<?php
if(session_status() === PHP_SESSION_NONE) session_start();
include __DIR__ . '/../../../connect.php';

$userId = $_SESSION['user_id'] ?? 1;

if(isset($_POST['mon_an_id'], $_POST['liked'])){
    $monAnId = intval($_POST['mon_an_id']);
    $liked = intval($_POST['liked']);

    if($liked){
    $query = "INSERT INTO mon_an_yeu_thich (nguoi_dung_id, mon_an_id)
              VALUES ($userId, $monAnId)
              ON DUPLICATE KEY UPDATE ngay_them=NOW()";
    $result = mysqli_query($conn, $query);
    if(!$result){
        echo json_encode(['error' => mysqli_error($conn)]);
        exit;
    }

    $res = mysqli_query($conn, "SELECT ma.id, ma.ten_mon_an, ma.mo_ta, ma.hinh_anh, nd.ho_ten 
                                FROM mon_an ma 
                                JOIN nguoi_dung nd ON nd.id = ma.nguoi_dang_id
                                WHERE ma.id = $monAnId");
    $row = mysqli_fetch_assoc($res);
    echo json_encode($row);

} else {
    $query = "DELETE FROM mon_an_yeu_thich WHERE nguoi_dung_id=$userId AND mon_an_id=$monAnId";
    $result = mysqli_query($conn, $query);
    if(!$result){
        echo json_encode(['error' => mysqli_error($conn)]);
    } else {
        echo json_encode(['removed' => true]);
    }
}

}
