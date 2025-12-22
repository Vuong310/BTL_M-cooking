<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết món ăn</title>
    <link rel="stylesheet" href="../btnhom/cacform.css">
    <style>
        body{
            display: flex;
            flex-direction: column;
            color:#324f23;
            margin:20vh auto;
            margin-bottom:0;
        }
        h2{
            text-align:left;
            font-size:30px;
        }
        a{
            text-decoration:none;
            color:#f1e9d2;
        }
        p{
            font-weight: bold;
            font-size: large;
        }
        .nguyenlieu{
            flex:1;
        }
        li{
            padding-inline-start: 0;
            font-size:20px;
        }
        .container{
            background-color: #9ab25b;
            display:flex;
            flex-direction: column;
            padding:20px;
            gap:5px;
            margin:auto;
            width:80%;
            border-radius: 10px;
            box-shadow: 0 15px 20px rgba(0,0,0,0.3);
            color:#f1e9d2;
            font-weight:bold;
        }
        .tendangnhap{
            display:flex;
            justify-content: space-around;
            align-items:flex-start;
            gap:10px;
        }
        .yeu-thich {
            cursor: pointer;
            background-color: #324f23;
            color: #f1e9d2;
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
        .yeu-thich:hover {
            background-color: #f1e9d2;
            color: #324f23;
        }
        img{
            width:300px; height:auto;
            border-radius:10px;
        }
    </style>
</head>
<body>
    <?php
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        include('../connect.php');
        $id = $_GET['id'];

        // GHI LỊCH SỬ XEM MÓN
        if (isset($_SESSION['username'])) {
            $ten_dn = $_SESSION['username'];

            //Truy xuất ID người dùng từ tên đăng nhập
            $sql_user = "SELECT id FROM nguoi_dung WHERE ten_dang_nhap = '$ten_dn'";
            $result_user = mysqli_query($conn, $sql_user);
            $row_user = mysqli_fetch_assoc($result_user);

            if($row_user){
                $user_id = $row_user['id'];
                // Thêm lịch sử mới
                $sql_ls = "INSERT INTO lich_su (nguoi_dung_id, mon_an_id) VALUES ($user_id, $id) ON DUPLICATE KEY UPDATE thoi_gian_xem = CURRENT_TIMESTAMP";
                mysqli_query($conn, $sql_ls);
            }
        }
        
        $sql = "SELECT ma.*, ct.buoc_lam ,nl.ten_nguyen_lieu, nd.ho_ten
                from mon_an ma
                join cong_thuc ct on ma.id = ct.mon_an_id
                join mon_an_loai_mon malm on ma.id = malm.mon_an_id
                join mon_an_nguyen_lieu manl on ma.id = manl.mon_an_id
                join nguyen_lieu nl on manl.nguyen_lieu_id = nl.id
                join loai_mon lm on malm.loai_mon_id = lm.id
                join nguoi_dung nd on ma.nguoi_dang_id = nd.id
                where ma.id = $id";
        $result = mysqli_query($conn,$sql);
        $monAn = mysqli_fetch_array($result);
    ?>
    <div class="container">
        <div class = "tendangnhap">
            <div>
                <img src="../gdadmin/<?php echo $monAn['hinh_anh']?>">
            </div>
            <div>
                <h1 style="font-size:50px"><?php echo $monAn['ten_mon_an']; ?></h1>
                <p><?php echo $monAn['mo_ta']; ?></p>
                <p><a href="index.php?page=hosonguoidang&id=<?php echo $monAn['nguoi_dang_id']?>">Người đăng: <?php echo " " . $monAn['ho_ten']; ?></p></a>
                <p>Ngày đăng: <?php echo " " . $monAn['ngay_dang']; ?></p>
                <p>Thời gian nấu: <?php echo " " . $monAn['thoi_gian_nau'] . " phút"; ?></p>
                <button class="yeu-thich" id="btn-yeuthich" data-id="<?= $monAn['id'] ?>">
                    Yêu thích
                </button>
            </div>
        </div>
        <div class="tendangnhap">
            <div class="nguyenlieu">
                <h2>Nguyên liệu</h2>
                <?php 
                    include ('../connect.php');
                    $sql_nl = "SELECT manl.*, nl.ten_nguyen_lieu from mon_an_nguyen_lieu manl
                            join nguyen_lieu nl on manl.nguyen_lieu_id = nl.id
                            where manl.mon_an_id = $id";
                    $result_nl = mysqli_query($conn, $sql_nl);
                ?>
                <ol>
                    <?php
                        while($nguyenLieu = mysqli_fetch_assoc($result_nl)){
                    ?>
                    <li><?php echo $nguyenLieu['ten_nguyen_lieu'] . " " . $nguyenLieu['so_luong'];?></li>
                    <?php }?>
                </ol>
            </div>
            <div class="nguyenlieu">
                <h2>Các bước thực hiện</h2>
                <?php 
                    include ('../connect.php');
                    $sql_ct = "SELECT ct.* from cong_thuc ct
                            where ct.mon_an_id = $id";
                    $result_ct = mysqli_query($conn, $sql_ct);
                ?>
                <ol>
                    <?php
                        while($congThuc = mysqli_fetch_assoc($result_ct)){
                    ?>
                    <li><?php echo $congThuc['buoc_lam'];?></li>
                    <?php }?>
                </ol>
            </div>
        </div>
    </div>
    <script>
        const btn = document.getElementById("btn-yeuthich");
        btn.addEventListener("click", function() {
            const monAnId = this.getAttribute("data-id");
            const isLiked = this.innerHTML === "Đã yêu thích";

            fetch("hoso/yeuthich/updateYeuThich.php", {
                method: "POST",
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                body: "mon_an_id=" + monAnId + "&liked=" + (isLiked ? 0 : 1)
            })
            .then(res => res.json())
            .then(data => {
                this.innerHTML = isLiked ? "Yêu thích" : "Đã yêu thích";
                console.log("Cập nhật:", data);
            })
            .catch(err => console.error(err));
        });
    </script>
    <script>
        // let cheDo = true;
        let cheDo = localStorage.getItem("cheDo") === "false" ? false : true;

        function doiNen(){
            //nếu cheDo = sáng (true) sẽ -> = tối (false)
            if (cheDo == true){
                document.getElementsByTagName('body')[0].style = 'background-color: #324f23';
                
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
                document.getElementsByTagName('body')[0].style = 'background-color: #f1e9d2';
                
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