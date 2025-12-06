<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Sign up</h1>
    </header>

    <main>
        <div class="hang1">
            <h2>Create a new account</h2>
            <p>It's quick and easy</p>
            <hr>
        </div>
        <form>
                <div class="name">
                <input type="text" placeholder="Firstname">
                <input type="text" placeholder="Surname">
            </div>
            <div class="birth">
                <p>Date of birth</p>
                <div class="ngaythangnamsinh">
                    <select name="date">
                        <?php
                            for($i = 1; $i<=30; $i++){
                                echo "<option value='$i'>$i</option>";
                            }
                        ?>
                    </select>
                    <select name="thang">
                        <?php
                            for($i = 1; $i<=12; $i++){
                                echo "<option value='$i'>$i</option>";
                            }
                        ?>
                    </select>
                    <select name="năm">
                        <?php
                            for($i = 1970; $i<=2025; $i++){
                                echo "<option value='$i'>$i</option>";
                            }
                        ?>
                    </select>
                </div>
            </div>
            <div class="gender">
                <p style="margin-left:5px;">Gender</p>
                <div class="luachon">
                    <div class="vien">
                        <p>Female:</p>
                        <input type="radio" name="chon" value="1">
                    </div> 
                    <div class="vien">
                        <p>Male:</p>
                        <input type="radio" name="chon" value="2">
                    </div>
                    <div class="vien">
                        <p>Custom:</p>
                        <input type="radio" name="chon" value="3">
                    </div>
                </div>
            </div>
            <div class="nhap">
                <input type="tel" type="email" placeholder="Mobile number or email address">
                <input type="password" placeholder="New password">
            </div>
            <div class="noidung">
                <p style="margin-bottom: 10px;">People who use our service may have uploaded your contact information to Cooking. Learn more</p>
                <p>By clicking Sign Up, you argee to our Terms, Privacy Policy and Cookies Policy. You may receive SMS notifications from us and can opt out at any time</p>
            </div>
            <button><b>Sign Up</b></button>
        </form>
        <div style="margin:10px;">
            <a style="text-decoration: none;color:white;" href="../login.php">Already have an account</a>
        </div>
    </main>
</body>
</html>