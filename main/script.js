// Plis Help Ga Jago Atur Logika Gweh
// Navigasi Sederhana
function goToLogin() {
    // Memberikan efek delay sedikit untuk animasi sebelum pindah
    document.body.style.opacity = '0';
    document.body.style.transition = 'opacity 0.5s';
    setTimeout(() => {
        window.location.href = 'login.php';
    }, 500);
}

// Validasi Login
function validateLogin() {
    const usernameInput = document.getElementById('username');
    const passwordInput = document.getElementById('password');

    const username = usernameInput.value.trim();
    const password = passwordInput.value.trim();

    // Reset style error
    usernameInput.style.borderColor = '#333';
    passwordInput.style.borderColor = '#333';

    if (username === "") {
        alert("Username tidak boleh kosong!");
        usernameInput.style.borderColor = 'red';
        return false;
    }

    if (password === "") {
        alert("Password harus diisi!");
        passwordInput.style.borderColor = 'red';
        return false;
    }

    // // Simulasi Login Berhasil
    // alert("Login Berhasil! Selamat datang, Prajurit Saiyan: " + username);
    
    // // Arahkan ke halaman selanjutnya
    // window.location.href = 'dashboard.html'; 

    return true; 
    //alert dibuat nya di php
}

// Validasi Register
function validateRegister() {
    const username = document.getElementById('reg-username').value.trim();
    const email = document.getElementById('reg-email').value.trim();
    const password = document.getElementById('reg-password').value.trim();

    const usernameInput = document.getElementById('reg-username');
    const emailInput = document.getElementById('reg-email');
    const passwordInput = document.getElementById('reg-password');

    // Reset style error
    usernameInput.style.borderColor = '#333';
    emailInput.style.borderColor = '#333';
    passwordInput.style.borderColor = '#333';

    if (username === "" || email === "" || password === "") {
        alert("Semua data harus diisi untuk membuat akun!");
        
        if (username === "") usernameInput.style.borderColor = 'red';
        if (email === "") emailInput.style.borderColor = 'red';
        if (password === "") passwordInput.style.borderColor = 'red';
        
        return false;
    }

    if (!email.includes("@") || !email.includes(".")) {
        alert("Format email tidak valid!");
        emailInput.style.borderColor = 'red';
        return false;
    }

    if (password.length < 5) {
        alert("Password terlalu lemah! Minimal 5 karakter.");
        passwordInput.style.borderColor = 'red';
        return false;
    }

    // alert("Akun berhasil dibuat! Silakan login.");
    // window.location.href = 'login.html';

    return true;    
    //retrun true biar kode dilanjutin ke php, nanti disana alertnya bakal dieksekusi, bukan disini

}

// LOGIKA CLICKER PAGE
let balls = 0;
const targetValue = 160;

function updateCounter() {
    const ballCounter = document.getElementById('ball-counter');
    const claimButton = document.getElementById('claim-button');

    if (ballCounter && claimButton) {
        ballCounter.textContent = balls;
        
        if (balls >= targetValue) {
            claimButton.classList.remove('disabled');
            claimButton.classList.add('ready');
        } else {
            claimButton.classList.add('disabled');
            claimButton.classList.remove('ready');
        }
    }
}

function handleClaim() {
    const claimButton = document.getElementById('claim-button');
    const claimForm = document.getElementById('claimForm');
    
    // diganti biar alert berhasil dijalanin ada di php
    if (claimButton && balls >= targetValue) {
        claimButton.type = "submit";
        claimForm.submit();
        balls = 0;
        updateCounter();
    } else if (claimButton) {
        alert("Bola Naga belum cukup! Kumpulkan sampai 160.");
    }
}


// Fungsi Mengubah Goku menjadi Super Saiyan saat ditekan/di-hold
function handlePress(event) {
    const gokuImage = document.getElementById('goku-image');
    
    if (event.type === 'mousedown' || event.type === 'touchstart') {
        balls++;
        updateCounter();
    }

    if (gokuImage) {
        gokuImage.src = '../assets/image/program/clicker2.png'; 
    }
}

// Fungsi Mengembalikan Goku ke Base Form saat dilepas
function handleRelease() {
    const gokuImage = document.getElementById('goku-image');

    if (gokuImage) {
        gokuImage.src = '../assets/image/program/clicker1.png';
    }
}


function initializeClicker() {
    const clickArea = document.getElementById('goku-click-area');
    const claimButton = document.getElementById('claim-button');

    if (clickArea) {
        clickArea.addEventListener('mousedown', handlePress);
        clickArea.addEventListener('mouseup', handleRelease);
        clickArea.addEventListener('touchstart', handlePress, { passive: true });
        clickArea.addEventListener('touchend', handleRelease, { passive: true });
    }
    
    if (claimButton) {
        claimButton.addEventListener('click', handleClaim);
    }

    updateCounter();
}


// LOGIKA GACHA PAGE & COLLECTION PAGE
// Simulasi Data Karakter

// data dipindah ke database
// const CHARACTERS = [
//     { id: 0, name: "Goku – Base Form", rarity: "★★", type: "Saiyan", power: 5000, speed: 4500, defense: 3000, skill: "Kamehameha", image: "../assets/image/program/colle1.jpg" },
//     { id: 1, name: "Goku – Super Saiyan", rarity: "★★★★★", type: "God Ki / Saiyan", power: 12000, speed: 9500, defense: 8900, skill: "Final Flash Supreme", image: "../assets/image/program/colle1.jpg" },
//     { id: 2, name: "Vegeta – Super Saiyan", rarity: "★★★★", type: "Saiyan Elite", power: 10000, speed: 8000, defense: 7500, skill: "Galick Gun", image: "../assets/image/character/program/colle1.jpg" },
// ];

// // Data simulasi koleksi yang sudah didapatkan
// let obtainedCharacters = [CHARACTERS[1].id];

// let credits = 180;
// const summonCost = 160;

// Fungsi untuk menampilkan status (landing, summoning, result)
function showGachaState(stateId) {
    const states = ['gacha-landing', 'gacha-summoning', 'gacha-result'];
    states.forEach(id => {
        const element = document.getElementById(id);
        if (element) {
            element.classList.toggle('hidden', id !== stateId);
        }
    });
}

// pengecekan dipindah ke php

// function updateCreditsDisplay() {
//     const creditDisplay = document.getElementById('current-credits');
//     const summonButton = document.getElementById('summon-button');
//     if (creditDisplay) {
//         creditDisplay.textContent = credits;
//     }
//     if (summonButton) {
//         if (credits < summonCost) {
//             summonButton.disabled = true;
//             summonButton.textContent = `SUMMON 1X (${summonCost} Needed)`;
//             summonButton.classList.add('disabled');
//         } else {
//             summonButton.disabled = false;
//             summonButton.textContent = 'SUMMON 1X';
//             summonButton.classList.remove('disabled');
//         }
//     }
// }

// Animasi Teks Summoning
function animateSummoningText() {
    const summoningText = document.getElementById('summoning-text');
    let dots = 0;
    
    if (!summoningText) return;

    const intervalId = setInterval(() => {
        dots = (dots % 3) + 1;
        summoningText.textContent = "SUMMONING" + ".".repeat(dots) + "_";
    }, 400);

    return intervalId;
}

// Simulasi Gacha
// function summonCharacter() {
//     if (credits < summonCost) {
//         alert("Bola Naga tidak cukup untuk melakukan Summon! Kumpulkan 160 Bola Naga.");
//         return;
//     }
    
//     credits -= summonCost;
//     updateCreditsDisplay();
    
//     showGachaState('gacha-summoning');
//     const animationInterval = animateSummoningText();
    
//     setTimeout(() => {
//         clearInterval(animationInterval);
        
//         const randomIndex = Math.floor(Math.random() * CHARACTERS.length);
//         const obtainedChar = CHARACTERS[randomIndex];
        
//         if (!obtainedCharacters.includes(obtainedChar.id)) {
//             obtainedCharacters.push(obtainedChar.id);
//         }
        
//         displayResult(obtainedChar);

//     }, 3000);
// }

// Menampilkan Hasil Gacha
function displayResult(char) {
    // document.getElementById('char-image').src = char.image || '../assets/image/program/colle1.jpg';
    // document.getElementById('char-name').textContent = char.name;
    // document.getElementById('char-rarity').textContent = "★".repeat(char.rarity.length);
    // document.getElementById('char-type').textContent = char.type;
    // document.getElementById('char-power').textContent = char.power;
    // document.getElementById('char-speed').textContent = char.speed;
    // document.getElementById('char-defense').textContent = char.defense;
    // document.getElementById('char-skill').textContent = char.skill;

    // showGachaState('gacha-result');

    let imagePath = char.image;
    document.getElementById('char-image').src = imagePath;
    document.getElementById('char-name').textContent = char.name;
    const rarityElement = document.getElementById('char-rarity');
    rarityElement.textContent = char.rarity;

    document.getElementById('char-type').textContent = char.type;
    document.getElementById('char-power').textContent = char.power;
    document.getElementById('char-speed').textContent = char.speed;
    document.getElementById('char-defense').textContent = char.defense;
    document.getElementById('char-skill').textContent = char.skill;

    showGachaState('gacha-result');
}

// Inisialisasi Gacha
function initializeGacha() {
    // tombol sudah jadi form
    // const summonButton = document.getElementById('summon-button');
    const backToGachaButton = document.getElementById('back-to-gacha');

    // updateCreditsDisplay();
    // showGachaState('gacha-landing');

    // if (summonButton) {
    //     summonButton.addEventListener('click', summonCharacter);
    // }

    if (backToGachaButton) {
        backToGachaButton.addEventListener('click', () => {
            showGachaState('gacha-landing');
        });
    }
}

// LOGIKA COLLECTION PAGE
// Fungsi untuk menampilkan detail di Modal
function showCharacterDetails(element) {
    const modal = document.getElementById('character-modal');
    if (!modal) return;

    const data = element.dataset;
    // Isi Detail Modal
    document.getElementById('modal-char-image').src = data.image;
    document.getElementById('modal-char-name').textContent = data.name;
    document.getElementById('modal-char-rarity').textContent = data.rarity;
    document.getElementById('modal-char-type').textContent = data.type;
    document.getElementById('modal-char-power').textContent = data.power;
    document.getElementById('modal-char-speed').textContent = data.speed;
    document.getElementById('modal-char-defense').textContent = data.defense;
    document.getElementById('modal-char-skill').textContent = data.skill;
    
    modal.classList.remove('hidden');
    
    const backButton = document.getElementById('modal-back-button');
    backButton.onclick = hideCharacterDetails;
}

// Fungsi untuk menyembunyikan Modal
function hideCharacterDetails() {
    document.getElementById('character-modal').classList.add('hidden');
}

// Fungsi untuk menggambar koleksi karakter

// dipindah ke php

// function initializeCollection() {
//     const grid = document.getElementById('character-grid');
//     if (!grid) return;
    
//     grid.innerHTML = '';
    
//     CHARACTERS.forEach(char => {
//         const isUnlocked = obtainedCharacters.includes(char.id);
//         const item = document.createElement('div');
//         item.className = `character-item ${isUnlocked ? 'unlocked' : 'locked'}`;
//         item.setAttribute('data-index', char.id);
        
//         let content = `
//             <div class="char-thumb-box">
//         `;
        
//         if (isUnlocked) {
//             content += `<img src="${char.image || '../assets/image/program/colle1.jpg'}" alt="${char.name}" class="char-thumb-img">`;
//         } else {
//             content += `
//                 <div class="locked-overlay">
//                     <span class="locked-text">LOCKED</span>
//                 </div>
//             `;
//         }
        
//         content += `
//             </div>
//             <p class="char-thumb-name">${char.name}</p>
//         `;
        
//         item.innerHTML = content;
        
//         if (isUnlocked) {
//             item.addEventListener('click', () => showCharacterDetails(char.id));
//         }
        
//         grid.appendChild(item);
//     });
// }

document.addEventListener('DOMContentLoaded', () => {
    if (document.getElementById('goku-click-area')) {
        initializeClicker();
    }
    
    if (document.getElementById('gacha-landing')) {
        initializeGacha();
    }
    
    // if (document.getElementById('collection-container')) {
    //     initializeCollection();
    // }
});

function openEditModal(button) {
    // ambil data dari tombol yang diklik
    const id = button.getAttribute('data-id');
    const username = button.getAttribute('data-username');
    const role = button.getAttribute('data-role');
    const coins = button.getAttribute('data-coins');

    // masukkan data ke dalam form Modal
    document.getElementById('edit_id').value = id;
    document.getElementById('edit_username').value = username;
    document.getElementById('edit_role').value = role;
    document.getElementById('edit_coins').value = coins;

    // tampilkan Modal
    document.getElementById('editModal').classList.remove('hidden');
}

function closeEditModal() {
    document.getElementById('editModal').classList.add('hidden');
}
