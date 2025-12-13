<?php
session_start();
include ("conn.php");
include ("function.php");

cekLogin();

$username=$_SESSION['username'];
$alert="";

if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST['claim'])){
    $update="update users set coins=coins+160 where username='$username'";
    if(mysqli_query($koneksi, $update)){
        $alert="Berhasil! 160 Koin telah ditambahkan";
    }else{
        $alert="Gagal klaim koin. Silahkan coba lagi";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clicker - DragonBall Gacha</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=BIZ+UDPMincho&family=Rubik+Mono+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-clicker">
    <div class="overlay-clicker"></div>
    
    <div class="clicker-container fade-in">
        
        <div class="clicker-header">
            <div class="stats-group left">
                <p>BALLS OBTAINED:</p>
                <div class="stat-box counter">
                    <img src="../assets/image/program/dragonball.png" alt="Dragon Ball" class="db-icon">
                    <span id="ball-counter">0</span>
                </div>
            </div>

            <!-- tombolnya dijadiin form -->
            <form method="POST" action="" id="claimForm" style="width: 100%; text-align: center;">
                <input type="hidden" name="claim">
                <button id="claim-button" class="btn-claim disabled">CLAIM</button>
            </form>

            <div class="stats-group right">
                <p>TARGET:</p>
                <div class="stat-box target">
                    <span id="target-value">160</span>
                </div>
            </div>
        </div>

        <div class="click-area" id="goku-click-area">
            <div class="goku-visual-box">
                <img src="../assets/image/program/clicker1.png" alt="Goku Base Form" id="goku-image" class="goku-image">
                <span class="tap-text">TAP!</span>
            </div>
        </div>

        <div class="clicker-footer">
            <a href="dashboard.php" class="btn-back-menu">BACK TO MENU</a>
        </div>
    </div>

    <script src="script.js"></script>
    <?php if ($alert!= "") : ?>
    <script>
        alert("<?php echo $alert; ?>");
    </script>
    <?php endif; ?>
</body>
</html>