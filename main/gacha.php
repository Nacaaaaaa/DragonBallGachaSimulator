<?php
session_start();
include("conn.php");
include("function.php");

cekLogin();

$username=$_SESSION['username'];
$hasilGacha=null;

$koinUser=mysqli_query($koneksi, "select * from users where username='$username'");
$dataUser=mysqli_fetch_assoc($koinUser);
$idUser=$dataUser['id'];
$koinUser=$dataUser['coins'];

$biaya=160;

if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST['summon'])){
    if($koinUser>=$biaya){
        $updateKoinUser=$koinUser-$biaya;
        mysqli_query($koneksi, "update users set coins=$updateKoinUser where id='$idUser'");
        $koinUser=$updateKoinUser;

        // acak karakter (gacha)
        $gacha=mysqli_query($koneksi, "select * from characters order by rand() limit 1");
        $hasilGacha=mysqli_fetch_assoc($gacha);

        // simpan ke tabel database penyimpanan
        $idKarakter=$hasilGacha['id'];
        $cek=mysqli_query($koneksi, "select*from user_characters where user_id='$idUser' 
        and character_id='$idKarakter'");
        if(mysqli_num_rows($cek)==0){
            mysqli_query($koneksi, "insert into user_characters(user_id, character_id) 
            values ($idUser, $idKarakter)");
        }
    }else{
        $error="Bola Naga tidak cukup! Butuh 160";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gacha - DragonBall Gacha</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=BIZ+UDPMincho&family=Rubik+Mono+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-manga bg-gacha">
    <div class="overlay-cover"></div>
    
    <div class="gacha-container fade-in">
        <div id="gacha-landing" class="gacha-state">
            <h1 class="gacha-title">SUMMON CHARACTER</h1>
            
            <div class="gacha-visual">
                <img src="../assets/image/program/dragonball.png" alt="Seven Dragon Balls" class="dragon-balls-visual">
            </div>

            <p class="gacha-credits">YOUR CREDITS: <span id="current-credits"><?= $koinUser ?></span></p>

            <!-- tombol gacha jadi form -->
            <form method="POST">
                <input type="hidden" name="summon">

                <?php if($koinUser >= $biaya) : ?>
                    <button type="submit" id="summon-button" class="btn-gacha btn-summon">SUMMON 1X</button>
                <?php else : ?>
                    <button type="button" class="btn-gacha btn-summon disabled">SUMMON 1X (<?php echo $biaya; ?> Needed)</button>
                <?php endif; ?>
            </form>

            <a href="dashboard.php" class="btn-gacha btn-back">BACK TO MENU</a>
        </div>

        <div id="gacha-summoning" class="gacha-state hidden">
            <div class="gacha-visual">
                <img src="../assets/image/program/dragonball.png" alt="Summoning" class="dragon-balls-visual floating-img-gacha">
            </div>
            <p id="summoning-text" class="summoning-text">SUMMONING...</p>
        </div>

        <div id="gacha-result" class="gacha-state hidden">
            <h1 class="gacha-subtitle">CONGRATS U'VE GOT:</h1>
            
            <div class="result-box">
                <div class="character-image-box">
                    <img id="char-image" src="" alt="Character Result" class="char-image-result">
                </div>
                <div class="character-details">
                    <h2 id="char-name" class="char-name">Goku – Super Saiyan</h2>
                    
                    <p>Rarity: <span id="char-rarity" class="rarity">★★★★★</span></p>
                    <p>Type/Element: <span id="char-type">God Ki / Saiyan</span></p>
                    
                    <div class="char-stats">
                        <p>Power: <span id="char-power">12000</span></p>
                        <p>Speed: <span id="char-speed">9500</span></p>
                        <p>Defense: <span id="char-defense">8900</span></p>
                    </div>
                    
                    <p class="skill-label">Signature Skill: <span id="char-skill">Final Flash Supreme</span></p>
                </div>
            </div>

            <button id="back-to-gacha" class="btn-gacha btn-back-result">BACK</button>
        </div>
    </div>

    <script src="script.js"></script>
    <?php if ($hasilGacha!=null) : ?>
    <script>
        // ambil data dari php, ubah jadi JSON object biar bisa dibaca JS
        const dataKarakterGacha= <?php echo json_encode($hasilGacha); ?>;
        
        // Override fungsi JS biar langsung loncat ke animasi
        showGachaState('gacha-summoning');
        
        // Animasi Teks
        const animInterval = animateSummoningText();

        // setelah 3 detik, tampilkan hasilnya
        setTimeout(() => {
            clearInterval(animInterval);
            displayResult(dataKarakterGacha);
            
        }, 3000); 
    </script>
    <?php endif; ?>

    <?php if (isset($error)) : ?> 
        <script>alert("<?php echo $error; ?>");</script>
    <?php endif; ?>

    <script>
        initializeGacha();
    </script>
</body>
</html>