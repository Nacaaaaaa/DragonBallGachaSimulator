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