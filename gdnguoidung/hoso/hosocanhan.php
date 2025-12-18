<?php
    if(!isset($_SESSION["username"])){
        header('location: ../login/login.php');
    }
    $username = $_SESSION["username"];
    include('../connect.php');
    $sql = "SELECT * from nguoi_dung where ten_dang_nhap = '$username'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hồ sơ cá nhân</title>
    <link rel="stylesheet" href="../style.css">
    <style>
        .form{
            border-bottom:2px solid #324f23;
        }
    </style>
</head>
<body>
    <div>
        <div class="form">
            <h3>📃 Tên tài khoản: <?php echo $row['ten_dang_nhap']?></h3>
        </div>
        <div class="form">
            <h3>👤 Tên người dùng: <?php echo $row['ho_ten']?></h3>
        </div>
        <div class="form">
            <h3>📆 Ngày sinh: <?php echo $row['ngay_sinh']?></h3>
        </div>
        <div class="form">
            <h3>⚧️ Giới tính: <?php echo $row['gioi_tinh']?></h3>
        </div>
        <div class="form">
            <h3>📱 Số điện thoại: <?php echo $row['sdt']?></h3>
        </div>
        <div class="form">
            <h3>📪 Email: <?php echo $row['email']?></h3>
        </div>
    </div>
    <script>
        let cheDo = true;

        function doiNen(){
            //nếu cheDo = sáng (true) sẽ -> = tối (false)
            if (cheDo == true){
                document.getElementsByTagName('body')[0].style = 'background-color: #324f23;';
                
                document.getElementsByTagName('header')[0].style = 'background-color: #f1e9d2';
                document.getElementsByTagName('img')[0].src = '../img/logo2.png';
                document.getElementsByClassName('timkiem')[0].style = 'background-color: #324f23; border: 2px solid #324f23;';
                document.querySelectorAll('.header a').forEach(function(link) {
                    link.style.color = '#324f23';
                });

                document.head.insertAdjacentHTML( //phương thức cho phép chèn thêm HTML vào vị trí cụ thể trong phần tử
                    'beforeend', //vị trí thêm
                    '<style>.timkiem::placeholder { color: #f1e9d2; }</style>'
                );

                document.getElementsByTagName('footer')[0].style = 'background-color: #9ab25d';
                document.getElementsByClassName('chan1')[0].style = 'background-color: #f1e9d2; color: #324f23';
              
                cheDo = false;
            }
            else{
                document.getElementsByTagName('body')[0].style = 'background-color: #f1e9d2;';
               
                document.getElementsByTagName('header')[0].style = 'background-color: #9ab25d';
                document.getElementsByTagName('img')[0].src = '../img/logo.png';
                document.getElementsByClassName('timkiem')[0].style = 'background-color: #f1e9d2; border: 2px solid #f1e9d2;';
                document.querySelectorAll('.header a').forEach(function(link) {
                    link.style.color = '#f1e9d2';
                });

                document.head.insertAdjacentHTML(
                    'beforeend',
                    '<style>.timkiem::placeholder { color: #324f23; }</style>'
                );

                document.getElementsByTagName('footer')[0].style = 'background-color: #324f23';
                document.getElementsByClassName('chan1')[0].style = 'background-color: #9ab25d; color: white';
              
                cheDo = true;
            }
        }
    </script>
</body>
</html>