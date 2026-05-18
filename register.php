<?php
include 'koneksi.php';


if (isset($_POST['register'])) {
    $username = $_POST['username'];
   $password = password_hash($_POST['password'], PASSWORD_DEFAULT); 
    $nama     = $_POST['nama_lengkap'];
    $angkatan = $_POST['angkatan'];
    $jurusan  = $_POST['jurusan'];

    $sql_users = "INSERT INTO users (username, password, role) 
              VALUES ('$username', '$password', 'user')";
   if (mysqli_query($conn, $sql_users)) {
    // Ambil ID yang baru saja dibuat untuk tabel alumni
    $user_id = mysqli_insert_id($conn);

        // Query untuk memasukkan data ke tabel alumni
    $sql_alumni = "INSERT INTO alumni (nama_lengkap, angkatan, jurusan, user_id) 
                   VALUES ('$nama', '$angkatan', '$jurusan', '$user_id')";
    
    mysqli_query($conn, $sql_alumni);
}

        header("Location: login.php");
        exit();
    } else {
            $error = "gagal"; 
        }
    

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="css/register.css">
</head>
<body>
    <div class="main-container">
        <div class="register-card">
            <div class="header-section">
                <h2>Buat Akun</h2>
                <p>Silakan isi data diri Anda di bawah ini</p>
            </div>

            <form method="POST">
                <div class="input-group">
                    <label>Username</label>
                    <input type="text" name="username" placeholder="Buat username" required>
                </div>

                <div class="input-group">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Buat password" required>
                </div>

                <div class="input-group">
                    <label>Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" placeholder="Tulis Nama Lengkap" required>
                </div>

                <div class="input-group">
                    <label>Angkatan</label>
                    <input type="number" name="angkatan" placeholder="Pilih Tahun" required>
                </div>

                <div class="input-group">
                    <label>Jurusan</label>
                    <select name="jurusan">
                        <option value="" disabled selected>Pilih Jurusan</option>
                        <option>Rekayasa Perangkat Lunak</option>
                        <option>Teknik Komputer dan Jaringan</option>
                        <option>Teknik Jaringan Akses Telekomunikasi</option>
                        <option>ANIMASI</option>
                    </select>
                </div>

                <button type="submit" name="register" class="btn-register">Daftar Sekarang</button>
            </form>

            <div class="footer-link">
                Sudah punya akun? <a href="login.php">Login di sini</a>
            </div>
        </div>
    </div>
</body>
</html>
