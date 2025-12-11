<?php
include("conn.php");

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $username=$_POST["reg-username"];
    $email=$_POST["reg-email"];
    $password=$_POST["reg-password"];

    $cekDuplikat=mysqli_query($koneksi, "select * from users where username='$username' or email='$email'");

    if(!mysqli_num_rows($cekDuplikat)){
        $query="insert into users (username, email, password, role) VALUES ('$username', '$email', '$password', 'user')";
        if(mysqli_query($koneksi, $query)){
            echo "<script>
                alert('Akun berhasil dibuat! Silakan Login');
                window.location.href='login.php';
                </script>";
            exit();
        }else{
            $error="akun tidak terbuat, silahkan coba lagi!";
        }
    }else{
        $error="Username atau Email sudah terdaftar! Cari yang lain.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - DragonBall Gacha</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=BIZ+UDPMincho&family=Rubik+Mono+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-manga">
    <div class="auth-header top-left fade-in">
        <h1 class="main-title-small">DRAGON<br>BALL</h1>
        <p class="sub-title-small">ガチャシミュレーター<br>Gacha Simulator</p>
    </div>

    <div class="auth-container fade-in">
        <!-- <form id="registerForm" onsubmit="event.preventDefault(); validateRegister();"> -->
        <form id="registerForm" method="POST" action="register.php" onsubmit="return validateRegister();">
            <div class="input-group">
                <label for="reg-username">USERNAME:</label>
                <input type="text" id="reg-username" name="reg-username" placeholder="Pilih Username">
            </div>

            <div class="input-group">
                <label for="reg-email">EMAIL:</label>
                <input type="email" id="reg-email" name="reg-email" placeholder="email@contoh.com">
            </div>

            <div class="input-group">
                <label for="reg-password">PASSWORD:</label>
                <input type="password" id="reg-password" name="reg-password" placeholder="Buat Password">
            </div>
            
            <button type="submit" class="btn-primary">DAFTAR</button>
            <br><br>
            <a href="login.php" class="btn-secondary">Kembali ke Login</a>
        </form>
        <?php if (isset($error)) echo "<br> <p style='color: red;'>$error</p>"; ?>
    </div>
    
    <div class="dragon-visual">
        <img src="../assets/image/program/naga.png" alt="Shenron Dragon">
    </div>
    
    <script src="script.js"></script>
</body>
</html>




