<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <main>
        <div>
            <img src="../img/logo.png" style="width: 100%; margin-top: 10vh; margin-bottom: 50px;">
        </div>
        <div style="text-align: center;">
            <b style="font-size: 50px">Hãy chọn món ăn mà bạn muốn</b>
        </div>
        <?php
            include('../connect.php');
            if(isset($_GET['search'])){
                $search = $_GET['search'];
                $sql = "SELECT * FROM mon_an WHERE trang_thai = 'da_duyet' AND ten_mon_an LIKE ?";
                $stmt = $conn->prepare($sql);
                $key = "%$search%";
                $stmt->bind_param("s", $key);
                $stmt->execute();
                $result = $stmt->get_result();
        ?>
            <div style="display:flex; flex-wrap:wrap; gap:30px;">
                <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                ?>
                            <a href="index.php?page=chitietmonan&id=<?php echo $row['id']; ?>">
                                <div class="monan">
                                    <img src="../gdadmin/<?php echo $row['hinh_anh']?>">
                                    <div class="mota">
                                        <p><b><?php echo $row['ten_mon_an']; ?></b></p>
                                    </div>
                                </div>
                            </a>
                <?php
                        }
                    }
                    else{echo "<p>Không tìm thấy món ăn nào phù hợp </p>";}
                ?>
            </div>

        <?php
            }
            else{
        ?>   
        <?php
            include('../connect.php');
            $sql_lm = "SELECT * from loai_mon";
            $result_lm = mysqli_query($conn, $sql_lm);
            while($lm = mysqli_fetch_array($result_lm)){
                $loaiMonID = $lm['id'];
                $sql = "SELECT ma.* FROM mon_an ma
                        JOIN mon_an_loai_mon malm ON ma.id = malm.mon_an_id
                        JOIN loai_mon lm ON lm.id = malm.loai_mon_id
                        WHERE ma.trang_thai = 'da_duyet' 
                        AND malm.loai_mon_id = $loaiMonID
                        ORDER BY ma.id DESC LIMIT 5";
                $result = mysqli_query($conn, $sql);
                if(mysqli_num_rows($result)==0){
                    continue;
                }
        ?>
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <h1 class="tenloai"><?php echo $lm['ten_loai'] ?></h1>
            <a href="index.php?page=dstheoloaimon&id=<?php echo $lm['id']?>" class="xemthem">Xem thêm ></a>
        </div>
        <div style="display: flex; gap: 30px; text-align: center; overflow-x: auto;">
            <?php 
                while($row = mysqli_fetch_array($result)){
            ?>
            <a href="index.php?page=chitietmonan&id=<?php echo $row['id']?>">
                <div class="monan">
                    <img src="../gdadmin/<?php echo $row['hinh_anh']?>" style="">
                    <div class="mota">
                        <p><?php echo $row['ten_mon_an']?></p>
                    </div>
                </div>
            </a>
        <?php } ?> 
        </div>
    <?php }?>
    <?php
            }
        ?>
    <script>
        let cheDo = true;

        function doiNen(){
            //nếu cheDo = sáng (true) sẽ -> = tối (false)
            if (cheDo == true){
                document.getElementsByTagName('body')[0].style = 'background-color: #324f23';
                document.getElementsByTagName('b')[0].style = 'color: #f1e9d2; font-size: 50px';
                document.getElementsByTagName('img')[2].src = '../img/logo2.png';
                let tenloai = document.getElementsByClassName('tenloai');
                for (let i = 0; i < tenloai.length; i++) {
                    tenloai[i].style.color = '#f1e9d2';
                }
                let xemthem = document.getElementsByClassName('xemthem');
                for (let i = 0; i < xemthem.length; i++) {
                    xemthem[i].style.color = '#f1e9d2';
                    xemthem[i].style.border = '1px solid #f1e9d2';
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
                document.getElementsByTagName('body')[0].style = 'background-color: #f1e9d2';
                document.getElementsByTagName('b')[0].style = 'color: black; font-size: 50px';
                document.getElementsByTagName('img')[2].src = '../img/logo.png';
                let tenloai = document.getElementsByClassName('tenloai');
                for (let i = 0; i < tenloai.length; i++) {
                    tenloai[i].style.color = 'black';
                }
                let xemthem = document.getElementsByClassName('xemthem');
                for (let i = 0; i < xemthem.length; i++) {
                    xemthem[i].style.color = 'black';
                    xemthem[i].style.border = '1px solid #9ab25d';
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
        }
    </script>
    </main>
</body>
</html>