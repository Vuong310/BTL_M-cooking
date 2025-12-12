<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BTL</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <!-- <div style="display: flex; flex-direction: column; min-height: 100vh;"> -->
        <main>
            <div class="menu">
                <?php
                    include('../btnhom/connect.php');
                    $sql = "SELECT * from mon_an";
                    $result = mysqli_query($conn,$sql);
                    while($row = mysqli_fetch_array($result)){
                ?>
                <a href="index.php?page=chitietmonan&id=<?php echo $row['id']?>">
                    <div class="monan">
                        <img src="img/logo.png">
                        <div class="mota">
                            <p><?php echo $row['ten_mon_an']?></p>
                        </div>
                    </div>
                </a>
                
                <?php }?>
            </div>
           
        </main>
    <!-- </div> -->
    
</body>
</html>