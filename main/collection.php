<?php
session_start();
include("conn.php");
include("function.php");

cekLogin();

$username=$_SESSION['username'];
$user=mysqli_query($koneksi, "select id from users where username='$username'");
$userData=mysqli_fetch_assoc($user);
$userId=$userData['id'];

// ambil data dari db
$allKarakter=mysqli_query($koneksi, "select *from characters");
$karakterUser=mysqli_query($koneksi, "select character_id from user_characters where user_id='$userId'");
// buat array menyimpan char id
$idchar_dimiliki=[];
while($row=mysqli_fetch_assoc($karakterUser)){
    $idchar_dimiliki[]=$row['character_id'];
}
?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Collection - DragonBall Gacha</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=BIZ+UDPMincho&family=Rubik+Mono+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-collection">
    <div class="collection-sidebar left-text sticky-left">
        <span class="vertical-text">COLLECTION</span>
    </div>

    <div class="collection-sidebar right-text sticky-right">
        <span class="vertical-text">COLLECTION</span>
    </div>

    <div class="collection-container fade-in" id="collection-container">
        <h1 class="collection-title">YOUR COLLECTION</h1>
        
        <div class="character-grid" id="character-grid">
            <?php while($char = mysqli_fetch_assoc($allKarakter)) : ?>
                <?php
                // cek sudah punya karakternya belum
                $isUnlocked=in_array($char['id'], $idchar_dimiliki);
                $gambar=$char['image'];
                ?>

                <div class="character-item <?php echo $isUnlocked ? 'unlocked' : 'locked'; ?>"
                    <?php if($isUnlocked):?>
                        onclick="showCharacterDetails(this)"
                        data-name="<?php echo $char['name']; ?>"
                        data-rarity="<?php echo $char['rarity']; ?>"
                        data-type="<?php echo $char['type']; ?>"
                        data-power="<?php echo $char['power']; ?>"
                        data-speed="<?php echo $char['speed']; ?>"
                        data-defense="<?php echo $char['defense']; ?>"
                        data-skill="<?php echo $char['skill']; ?>"
                        data-image="<?php echo $gambar; ?>"
                    <?php endif; ?>
                >
                    <div class="char-thumb-box">
                        <?php if($isUnlocked) : ?>
                        <img src="<?php echo $gambar; ?>" alt="<?php echo $char['name']; ?>" class="char-thumb-img">
                        <?php else : ?>
                        <div class="locked-overlay">
                            <span class="locked-text">LOCKED</span>
                        </div>
                        <?php endif; ?>
                    </div>
                    <p class="char-thumb-name"><?php echo $char['name']; ?></p>
                </div>
            <?php endwhile; ?>

        </div>
    </div>

    <div class="collection-footer sticky-footer">
        <a href="dashboard.php" class="btn-back-menu">BACK TO MENU</a>
    </div>

    <div id="character-modal" class="modal-overlay hidden">
        <div class="gacha-result modal-content">
            <h1 class="gacha-subtitle">CHARACTER DETAILS</h1>
            
            <div class="result-box">
                <div class="character-image-box">
                    <img id="modal-char-image" src="" alt="Character Result" class="char-image-result">
                </div>
                <div class="character-details">
                    <h2 id="modal-char-name" class="char-name"></h2>
                    
                    <p>Rarity: <span id="modal-char-rarity" class="rarity"></span></p>
                    <p>Type/Element: <span id="modal-char-type"></span></p>
                    
                    <div class="char-stats">
                        <p>Power: <span id="modal-char-power"></span></p>
                        <p>Speed: <span id="modal-char-speed"></span></p>
                        <p>Defense: <span id="modal-char-defense"></span></p>
                    </div>
                    
                    <p class="skill-label">Signature Skill: <span id="modal-char-skill"></span></p>
                </div>
            </div>

            <button id="modal-back-button" class="btn-gacha btn-back-result">BACK</button>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>