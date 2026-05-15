<?php
session_start();
include 'koneksi.php';

if ($_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit;
}

if (isset($_POST['tambah'])) {
    $nama = $_POST['Nama_Lengkap'];
    $angkatan = $_POST['Angkatan'];
    $jurusan = $_POST['Jurusan'];

    $sql = "INSERT INTO alumni (Nama_Lengkap, Angkatan, Jurusan) VALUES ('$nama', '$angkatan', '$jurusan')";
    mysqli_query($conn, $sql);
    header("Location: dashboard_admin.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Data Alumni</title>
    <link rel="stylesheet" type="text/css" href="css/tambah.css">
</head>
<body>
    <div class="main-container">
        <div class="form-card">
            <h2>Tambah Data Alumni</h2>
            <form method="POST">
                <input type="text" name="Nama_Lengkap" placeholder="Masukan Nama" required>
                <input type="number" name="Angkatan" placeholder="Masukan Tahun Angkatan" required>
                <select name="Jurusan" required>
                    <option value="" disabled selected>Pilih Jurusan</option>
                    <option>Rekayasa Perangkat Lunak</option>
                    <option>Teknik Komputer dan Jaringan</option>
                    <option>Teknik Jaringan Akses Telekomunikasi</option>
                    <option>ANIMASI</option>
                </select>

                <div class="button-group">
                    <button type="submit" name="tambah" class="btn-simpan">Simpan</button>
                    <a href="dashboard_admin.php" class="btn-batal">Batal</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>