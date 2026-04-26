<?php
// Memanggil koneksi database
include 'koneksi.php';

// Logika yang Anda tanyakan diletakkan di sini
if(isset($_POST['login'])){
    $u = $_POST['username']; 
    $p = $_POST['password'];
    
    // Mencari user di database
    $q = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$u' AND password='$p'");
    
    if(mysqli_num_rows($q) > 0){
        $d = mysqli_fetch_assoc($q);
        
        // Menyimpan data ke dalam Session
        $_SESSION['username'] = $d['username'];
        $_SESSION['level'] = $d['level']; 
        
        // Melempar ke halaman tampil.php jika berhasil
        header("Location: tampil.php");
        exit;
    } else {
        // Jika salah, buat pesan error
        $error = "Username atau Password salah!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Sistem</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card mx-auto" style="max-width: 400px;">
            <div class="card-body">
                <h3 class="text-center">Login</h3>
                <hr>
                
                <?php if(isset($error)) { echo "<div class='alert alert-danger'>$error</div>"; } ?>

                <form method="POST" action="">
                    <div class="mb-3">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <button type="submit" name="login" class="btn btn-primary w-100">Masuk</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>