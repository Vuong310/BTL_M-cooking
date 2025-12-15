<?php
    // session_start();
    include('../connect.php');
    if(isset($_POST['ten']) && isset($_POST['mk'])){
        $username = $_POST['ten'];
        $password = $_POST['mk'];
        $sql = "SELECT * from nguoi_dung where ten_dang_nhap = '$username' and mat_khau = '$password'";
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result)>0){
            if ($username === 'admin' && $password === 'admin123') {
                // Đặt tên session riêng cho admin
                session_name("ADMIN");
                session_start();
                $_SESSION['admin'] = $username;
                header('Location: admin.php?page=nguoidung');
                exit;
            } 
            else {
                // Đặt tên session riêng cho user
                session_name("USERS");
                session_start();
                $_SESSION['username'] = $username;
                header('Location: ../gdadmin/index.php?page=trangchu');
                exit;
            }
        }
        else{
            // echo "<p class='warning'>Sai thông tin đăng nhập</p>";
            $warning = True;
            // <?php
            //     echo "<script>alert('Xin chào! Đây là thông báo từ PHP');</script>";
            // 
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body{
            /* background-color: #f1e9d2; */
            display:flex;
            align-items:center;
            flex-direction:column;
            justify-content: center;
            margin:auto;
            height:90vh;
            font-family: 'Courier New', Courier, monospace;
            color:#f1e9d2;
            background-color: #f1e9d2;
            /* background-image: url('img/nen_signup.jpg'); */
        }
        main{
            background-color:#9ab25d;
            display:flex;
            justify-content: space-around;
            margin: auto;
            align-items: center;
            width: 100%;
            max-width: 600px; /*max hiển thị chỉ bằng thế, không đổi dù zoom trang*/
            padding: 20px;
            box-sizing: border-box; /*tổng kích thước padding và nội dung = width*/
            border-radius: 10px;
            box-shadow: 0 15px 20px rgba(0, 0, 0, 0.3); 
            /*dịch bóng theo chiều ngang, dịch bóng theo chiều dọc, độ mờ bóng, độ lan, màu*/
        }
        a{
            color:#f1e9d2;
            text-decoration: none;
            /* font-weight: bold; */
        }
        .nhap input{
            border:0;
            background-color: #9ab25d;
        }
        .nhap input::placeholder{
            color:#f1e9d2;
            font-family: 'Courier New', Courier, monospace;
        }
        .nhap input:focus{
            outline:none;
        }
        .nhap{
            border-bottom: 1px #324f23 solid;
            padding:10px;
            display:flex;
            justify-content: flex-start;
            align-items: end;
            gap:20px;
            /* border: white 3px solid; */
        }
        .nutbam button{
            border-radius: 8px;
            background-color:#324f23;
            padding:10px 20px;
            /* margin: 50px auto; */
            font-size: 16px;
            cursor: pointer;
            color:#f1e9d2;
            white-space: nowrap;
            font-family: 'Courier New', Courier, monospace;
        }
        .nut{
            border-radius: 8px;
            background-color:#324f23;
            padding:10px 20px;
            /* margin: 50px auto; */
            font-size: 16px;
            cursor: pointer;
            color:#f1e9d2;
            white-space: nowrap;
            font-family: 'Courier New', Courier, monospace;
            font-weight: bold;
        }
        .nutbam{
            display: flex;
            justify-content: flex-start;
            gap:30px;
            margin: 50px auto;
        }
        .warning{
            color:red;
            font-weight:bold;
        }
        .hinh{
            text-align: center;
            margin:20px;
            margin-right: 40px;
            /* border:3px solid black; */
        }
        .hinh img{
            border-radius: 10px;
            width:100%;
            height:auto;
        }
        /* .chanmain{
            display:flex;
            justify-content: space-around;
            gap:5px;
            align-items: flex-start;
            margin-bottom: 10px;
        } */
        .phai{
            margin-right:20px;
            /* border:3px black solid; */
        }
    </style>
</head>
<body>
    <main>
        <div class="hinh">
            <img src="img/login.png">
        </div>
        <div class="phai">
            <h1><b>Log In</b></h1>
            <form action="login.php" method="post">
                <div class="nhap">
                    <i class="fa fa-user" aria-hidden="true"></i>
                    <input type="text" name="ten" placeholder="Your account">
                </div>
                <div class="nhap">
                    <i class="fa fa-lock" aria-hidden="true"></i>
                    <input type="password" name="mk" placeholder="Password">
                </div>
                <!-- <div style="margin-top:10px">
                    <input type="checkbox" name="rmb">Remember me
                </div> -->
                <div class="nutbam">
                    <input class = "nut" type="submit" value="Log In">
                    <button><a class="nut" href="signup/signup.php">Sign Up</a></button>
                    <!-- <button><b>Log In</b></button>
                    <button><b>Sign Up</b></button> -->
                </div>
                <!-- <div class="chanmain">
                    Or login with
                    <div class="chanmain" style="gap:10px;">
                        <i class="fa fa-facebook-official" aria-hidden="true"></i>
                        <i class="fa fa-twitter-square" aria-hidden="true"></i>
                        <i class="fa fa-google-plus-square" aria-hidden="true"></i>
                    </div> -->
                </div>
            </form>
        </div>
    </main>
    <?php
        if($warning === True){
            echo "<script>alert('Bạn đã nhập sai tên tài khoản hoặc mật khẩu, vui lòng nhập lại!');</script>";
        }
    ?>
    
    
</body>
</html>