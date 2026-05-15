<?php
session_start();
include 'koneksi.php';

if ($_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit;
}

$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM alumni WHERE id='$id'");
$data = mysqli_fetch_assoc($result);

if (isset($_POST['edit'])) {
    $nama     = $_POST['Nama_Lengkap'];
    $angkatan = $_POST['Angkatan'];
    $jurusan  = $_POST['Jurusan'];

    $sql = "UPDATE alumni SET Nama_Lengkap='$nama', Angkatan='$angkatan', Jurusan='$jurusan' WHERE id='$id'";
    if (mysqli_query($conn, $sql)) {
        header("Location: dashboard_admin.php");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Data Alumni</title>
    <link rel="stylesheet" href="css/edit.css">
</head>
<body>
    <div class="main-wrapper">
        <div class="form-card">
            <h2>Edit Data Alumni</h2>
            <form method="POST">
                <input type="text" name="Nama_Lengkap" value="<?php echo $data['Nama_Lengkap']; ?>" placeholder="Nama Lengkap" required>
                <input type="number" name="Angkatan" value="<?php echo $data['Angkatan']; ?>" placeholder="Tahun Angkatan" required>
                
                <select name="Jurusan">
                <?php 
                $pilihan = ["Rekayasa Perangkat Lunak", "Teknik Komputer dan Jaringan", "Teknik Jaringan Akses Telekomunikasi", "ANIMASI"];
                foreach ($pilihan as $j) {
                $selected = ($data['Jurusan'] == $j) ? "selected" : "";
                echo "<option value='$j' $selected>$j</option>";
                    }
                    ?>
                </select>

                <div class="button-container">
                    <button type="submit" name="edit" class="btn-save">Simpan Perubahan</button>
                    <a href="dashboard_admin.php" class="btn-cancel">Batal</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>