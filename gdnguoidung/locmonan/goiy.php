<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gợi ý món ăn</title>
    <style>
        body{
            width: 100%;
            height: auto;
        }
        .daxem-logo{
            display:flex;
            justify-content: center;
            margin: 50px 0;
        }
        .daxem-logo img{
            border-radius:100px;
            width: 400px; 
            margin-top:10px;
        }
        form{
            display: flex;
            justify-content: center;
            flex-direction: column;
            align-items: center;
        }
        input{
            background: #e0d9bf;
            width: 50%;
            padding: 12px 20px;
            box-sizing: border-box;
            border: 2px solid black;
            border-radius: 4px;
            font-size: 16px;
        }
        .nut{
            background-color: #324f23;
            color: #f1e9d2;
            font-size: 15px;
            border-radius: 10px; 
            padding:10px 30px;
            font-weight:bold;
            margin-top: -40px;
        }
        .monan{
            background-color: #324f23;
            color: #f1e9d2;
            font-weight: bold;
            border-radius: 10px;
            padding-bottom: 7px; 
        }
    </style>
</head>
<body>
    <div class="daxem-logo">
        <img src="../img/logo.png" alt="">
    </div>  
    <form method="POST" action="">
        <input type="text" id="nguyen_lieu" name="nguyen_lieu" placeholder="vd: trứng, bột mì, sữa"><br>
        <br><br>
        <button class="nut" type="submit" onclick="return canhBao()">Gợi ý món ăn</button>
    </form>

    <script>
        function canhBao(){
            let input = document.getElementById('nguyen_lieu').value.trim();
            if(input === ""){
                alert("Vui lòng nhập nguyên liệu!");
                return false;
            }
            return true;
        }
    </script>

    <?php
        // Lấy nguyên liệu từ form
        include('../connect.php');
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['nguyen_lieu'])){
            //Lấy dữ liệu từ ô input trong form có name="nguyen_lieu".
            $input = $_POST['nguyen_lieu'];
            // Tách chuỗi $input thành một mảng dựa trên dấu phẩy.
            $ds_nl = explode(",", $input);

            $where = "";
            foreach ($ds_nl as $index => $nl) {
                $nl = trim($nl); // Loại bỏ khoảng trắng thừa
                if ($index > 0){
                    $where .= " OR ";
                }
                $where .= "nl.ten_nguyen_lieu LIKE '%$nl%'";
            }

            $sql = "SELECT DISTINCT m.id, m.ten_mon_an, m.hinh_anh
                    FROM mon_an m
                    JOIN mon_an_nguyen_lieu manl ON m.id = manl.mon_an_id
                    JOIN nguyen_lieu nl ON manl.nguyen_lieu_id = nl.id
                    WHERE $where";
            $result = $conn->query($sql);
    ?>
        <h2>Kết quả gợi ý món ăn</h2>

        <?php if ($result && $result->num_rows > 0) { ?>
            <ul style='display: flex; flex-wrap: wrap; justify-content: center; gap: 30px;'>
                <?php while($row = $result->fetch_assoc()) { ?>
                    <li style='list-style-type: none; margin-bottom: 30px; display: flex; flex-direction: column; align-items: center;'>
                        <a href="index.php?page=chitietmonan&id=<?php echo $row['id']; ?>">
                            <div class='monan'>    
                                <?php if(!empty($row['hinh_anh'])){ ?>
                                    <img src="../gdadmin/<?php echo $row['hinh_anh']; ?>" alt="">
                                <?php } else { ?>
                                    <img src="../img/logo.png" alt="">
                                <?php } ?>
                                <p><?php echo $row['ten_mon_an']; ?></p>
                            </div>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        <?php } else { ?>
            <strong>Không tìm thấy món ăn phù hợp.</strong>
    <?php } 
        }
    ?>

</body>
</html>