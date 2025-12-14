<?php
session_start();

include("config/function.php");
cekLogin();

$username=$_SESSION['username'];
$role=$_SESSION['role'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - DragonBall Gacha</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=BIZ+UDPMincho&family=Rubik+Mono+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="bg-manga bg-dashboard">
    <div class="overlay-cover"></div> 

    <div class="dashboard-container fade-in">
        <div class="db-title-box">
            <h1 class="main-title-small">DRAGON<br>BALL</h1>
        </div>

        <div class="nav-buttons">
            <a href="clicker.php" class="btn-nav">Clicker</a>
            <a href="gacha.php" class="btn-nav gacha">Gacha</a>
            <a href="collection.php" class="btn-nav">Your Collection</a>

            <a href="logout.php" class="btn-logout">LOGOUT</a>
        </div>

        <div class="db-subtitle-box">
            <p class="sub-title-small">ガチャシミュレーター<br>Gacha Simulator</p>
        </div>
    </div>

    <script src="assets/js/script.js"></script>
</body>
</html>
