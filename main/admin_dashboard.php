<?php
session_start();

if(!isset($_SESSION['username'])){
    header("Location: login.php");
    exit();
}
if($_SESSION['role']!='admin'){
    header("Location: dashboard.php");
    exit();
}

$username=$_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - DragonBall Gacha</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=BIZ+UDPMincho&family=Rubik+Mono+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-manga bg-dashboard">
    <div class="overlay-cover"></div> 

    <div class="dashboard-container fade-in">

        <div class="db-title-box">
            <h1 class="main-title-small">DRAGON<br>BALL</h1>
        </div>

        <div class="nav-buttons">
            <a href="admin_panel.php" class="btn-nav">Admin Panel</a>
        </div>

        <div class="db-subtitle-box">
            <p class="sub-title-small">ガチャシミュレーター<br>Gacha Simulator</p>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>