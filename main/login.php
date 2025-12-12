<?php
session_start();
include("conn.php");

if(isset($_SESSION["username"])){
    header("Location: dashboard.php");
    exit();
}
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $username=$_POST["username"];
    $password=$_POST["password"];

    $cekUsername=mysqli_query($koneksi, "select * from users where username='$username'");

    if(mysqli_num_rows($cekUsername)){
        $row = mysqli_fetch_assoc($cekUsername);
        if($password==$row['password']){
            $_SESSION['username']=$row['username'];
            $_SESSION['role']=$row['role'];

            echo "<script>
                alert('Login Berhasil! Selamat datang, Prajurit Saiyan: ".$row['username']."');
                window.location.href = 'dashboard.php';
                </script>";
            exit();
        }else{
            $error="username atau password salah!";
        }
    }else{
        $error="username atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - DragonBall Gacha</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=BIZ+UDPMincho&family=Rubik+Mono+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-manga">
    <div class="overlay-cover"></div>
    
    <div class="auth-header top-left fade-in">
        <h1 class="main-title-small">DRAGON<br>BALL</h1>
        <p class="sub-title-small">ガチャシミュレーター<br>Gacha Simulator</p>
    </div>

    <div class="auth-container fade-in">
        <!-- <form id="loginForm" onsubmit="event.preventDefault(); validateLogin();"> -->
        <form method="POST" action="login.php" onsubmit="return validateLogin();">
            <div class="input-group">
                <label for="username">USERNAME:</label>
                <input type="text" id="username" name="username" placeholder="Masukkan Username">
            </div>

            <div class="input-group">
                <label for="password">PASSWORD:</label>
                <input type="password" name="password" id="password" placeholder="*****">
            </div>

            <div class="auth-links">
                <a href="register.php" class="link-text">Buat Akun Baru</a>
            </div>

            <button type="submit" class="btn-primary">LOGIN</button>
        </form>
        <?php if (isset($error)) echo "<br> <p style='color: red;'>$error</p>"; ?>
    </div>
    
    <div class="dragon-visual">
        <img src="../assets/image/program/naga.png" alt="Shenron Dragon"> 
    </div>

    <script src="script.js"></script>
</body>
</html>



