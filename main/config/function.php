<?php
// function cek session
function cekLogin(){
    if(!isset($_SESSION['username'])){
        header("Location: login.php");
        exit();
    }
}

// function cek admin bukan
function cekAdmin(){
    cekLogin();
    if($_SESSION['role']!="admin"){
        header("Location: login.php");
        exit();
    }
}
?>