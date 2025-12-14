<?php
session_start();
include("../config/conn.php");
include("../config/function.php");

cekAdmin();

// hapus (delete)
if(isset($_GET['hapus'])){
    $idHapus=$_GET['hapus'];

    // cegah admin hapus data admin
    $cek=mysqli_query($koneksi, "select *from users where username='".$_SESSION['username']."'");
    $dataAdmin=mysqli_fetch_assoc($cek);
    if($idHapus==$dataAdmin['id']){
        echo "<script> alert('Tidak bisa menghapus akun admin'); </script>";
    }else{
        $queryHapus=mysqli_query($koneksi, "delete from users where id='$idHapus'");
        if($queryHapus){
            echo "<script> alert('user berhasil dihapus!'); 
            window.location.href='admin_panel.php' </script>";
        }else{
            echo "<script> alert('gagal menghapus user!'); </script>";
        }
    } 
}

// update/edit
if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['edit_user'])){
    $idEdit=$_POST['id_user'];
    $usernameBaru=$_POST['username'];
    $roleBaru=$_POST['role'];
    $coinBaru=$_POST['coins'];

    $queryUpdate="update users set username='$usernameBaru', role='$roleBaru', 
            coins='$coinBaru' where id='$idEdit'";
    if(mysqli_query($koneksi, $queryUpdate)){
        echo "<script> alert('Data berhasil di update!') </script>";
    }else{
        echo "<script> alert('Gagal update! silahkan coba lagi') </script>";
    }
}

// ambil data user (read)
$queryUser=mysqli_query($koneksi, "select*from users");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - DragonBall Gacha</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=BIZ+UDPMincho&family=Rubik+Mono+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="bg-admin">
    <div class="overlay-clicker"></div> <div class="admin-container fade-in">
        <h1 class="main-title">ADMIN PANEL</h1>
        
        <div class="management-box">
            <div class="management-header">
                <h2>User Management</h2>
            </div>
            
            <div class="user-list-container">
                <?php while($user=mysqli_fetch_assoc($queryUser)): ?>
                    <div class="user-card">
                        <div class="user-info">
                            <p class="user-name">
                                <?php echo $user['username']; ?> 
                                (ID: <?php echo $user['id']; ?>)
                            </p>
                        </div>

                        <div class="user-actions">
                            <button type="button"
                                class="btn-action edit" 
                                onclick="openEditModal(this)" 
                                data-id="<?php echo $user['id']; ?>" 
                                data-username="<?php echo $user['username']; ?>"
                                data-role="<?php echo $user['role']; ?>"
                                data-coins="<?php echo $user['coins']; ?>"
                            >Edit</button>
                            
                            <a href="admin_panel.php?hapus=<?php echo $user['id']; ?>" 
                               class="btn-action delete"
                               onclick="return confirm('Yakin ingin menghapus user <?php echo $user['username']; ?>? Semua data gacha miliknya juga akan hilang.');"
                            >
                            Delete
                            </a>
                        </div>
                    </div>
                    <?php endwhile; ?>
                        <?php if(mysqli_num_rows($queryUser) == 0) : ?>
                            <p style="text-align:center; color:white;">Belum ada user terdaftar.</p>
                        <?php endif; ?>
                
            </div>
        </div>

        <div class="clicker-footer">
            <a href="admin_dashboard.php" class="btn-back-menu">BACK TO MENU</a>
        </div>
    </div>
    
    <div id="editModal" class="modal-overlay hidden">
        <div class="modal-box" style="background-color: white;">
            <h2>EDIT USER</h2><br>
            <form method="POST" action="">
                <table>
                <tr>
                    <td> <input type="hidden" name="edit_user" value="true"> </td>
                    <td> <input type="hidden" id="edit_id" name="id_user"> </td>
                </tr>

                <tr>
                    <td> <label>Username</label> </td>
                    <td> : </td>
                    <td> <input type="text" id="edit_username" name="username" value="<?php echo $user['username'] ?>" required> </td>
                </tr>
                
                <tr>
                    <td> <label>Role</label> </td>
                    <td> : </td>
                    <td> 
                        <select id="edit_role" name="role">
                            <option value="user">User</option>
                            <option value="admin">Admin</option>
                        </select> 
                    </td>
                </tr>

                <tr>
                    <td><label>Coins</label>
                    <td> : </td>
                    <td> <input type="number" id="edit_coins" name="coins" value="<?php echo $user['coins']?>" required> </td>
                </tr>
                
                <tr>
                    <td> <button type="submit" class="btn-save">SIMPAN</button> </td>
                    <td> <button type="button" class="btn-cancel" onclick="closeEditModal()">BATAL</button> </td>
                </tr>
                </table>
            </form>
        </div>
    </div>
    
    <script src="../assets/js/script.js"></script>
</body>
</html>