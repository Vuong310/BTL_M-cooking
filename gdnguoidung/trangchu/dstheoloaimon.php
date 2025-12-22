<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xem thêm</title>
    <style>
        .menu{
            display:flex;
            flex-wrap:wrap;
            gap:20px;
            /* align-items:center; */
        }
    </style>
</head>
<body style="margin-top: 10vh;">
    <?php
        include('../connect.php');
        $id = $_GET['id'];
        $sql = "SELECT ma.id AS mon_an_id,
                    ma.ten_mon_an,
                    lm.ten_loai,
                    ma.hinh_anh
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
    <div class="menu">
        <?php while ($loaiMon = mysqli_fetch_array($result)) { ?>
        <div class="monan">
            <img src="../gdadmin/<?php echo $loaiMon['hinh_anh']?>" style="">
            <div class="mota">
                <p><?php echo $loaiMon['ten_mon_an']; ?></p>
                
            </div>
        </div>
        <?php } ?>
    </div>
    <script>
        // let cheDo = true;
        let cheDo = localStorage.getItem("cheDo") === "false" ? false : true;

        function doiNen(){
            //nếu cheDo = sáng (true) sẽ -> = tối (false)
            if (cheDo == true){
                document.getElementsByTagName('body')[0].style = 'background-color: #324f23; margin-top: 10vh;';
                document.getElementsByTagName('h1')[0].style = 'color: #f1e9d2';
                let tenloai = document.getElementsByClassName('tenloai');
                for (let i = 0; i < tenloai.length; i++) {
                    tenloai[i].style.color = '#f1e9d2';
                }
                let mota = document.getElementsByClassName('mota');
                for (let i = 0; i < mota.length; i++) {
                    mota[i].style.color = '#324f23';
                    mota[i].style.backgroundColor = '#e0d9bf';
                }

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
                document.getElementsByTagName('body')[0].style = 'background-color: #f1e9d2; margin-top: 10vh;';
                document.getElementsByTagName('h1')[0].style = 'color: black';
                let tenloai = document.getElementsByClassName('tenloai');
                for (let i = 0; i < tenloai.length; i++) {
                    tenloai[i].style.color = 'black';
                }
                let mota = document.getElementsByClassName('mota');
                for (let i = 0; i < mota.length; i++) {
                    mota[i].style.color = '#e0d9bf';
                    mota[i].style.backgroundColor = '#324f23';
                }

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
        localStorage.setItem("cheDo", cheDo); // Lưu trạng thái vào localStorage

        };
        // Khi trang load, kiểm tra trạng thái và áp dụng ngay
        window.onload = function(){
            if(localStorage.getItem("cheDo") === "false"){
                cheDo = true; // để khi gọi doiNen() nó chạy vào nhánh tối
                doiNen();
            }
        };
    </script>

</body>
</html>