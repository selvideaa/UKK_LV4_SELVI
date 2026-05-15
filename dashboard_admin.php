<?php
session_start();
include 'koneksi.php';
if ($_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit;
}

$keyword = "";
if (isset($_POST['search'])) {
    $keyword = $_POST['keyword'];
    $result = mysqli_query($conn, "SELECT * FROM alumni 
        WHERE Nama_Lengkap LIKE '%$keyword%' 
        OR Angkatan LIKE '%$keyword%' 
        OR Jurusan LIKE '%$keyword%'");
} else {
    $result = mysqli_query($conn, "SELECT * FROM alumni");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="css/dashboard.css">
</head>
<body>
    <div class="bg-overlay"></div> 

    <div class="admin-container">
        <header class="main-header">
            <div class="header-left">
            <h3>Dashboard Admin</h3>
            </div>
            <div class="header-center">
            <h2>Manajemen Data Alumni</h2>
            </div>
            <div class="header-right">
            <span>Selamat datang, <strong><?php echo $_SESSION['username']; ?></strong></span>
            <a href="logout.php" class="btn-logout">Logout</a>
            </div>
        </header>
        ...
    </div>
</body>

        <main class="content">
            <div class="action-bar">
            <a href="tambah.php" class="btn-add">+ Tambah Data Alumni</a>
                
            <form method="POST" class="search-form">
                <input type="text" name="keyword" placeholder="Cari nama, angkatan, atau jurusan..." value="<?php echo $keyword; ?>">
                 <button type="submit" name="search" class="btn-search">Cari</button>
                 <?php if($keyword != ""): ?>
                 <a href="dashboard_admin.php" class="btn-reset">Reset</a>
                <?php endif; ?>
            </form>
            </div>

        <div class="table-container">
            <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Lengkap</th>
                    <th>Angkatan</th>
                    <th>Jurusan</th>
                    <th style="text-align: center;">Aksi</th>
                </tr>
                    </thead>
                    <tbody>
                        <?php 
    if (mysqli_num_rows($result) > 0) {
        $no = 1; 
        while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $row['Nama_Lengkap']; ?></td>
                    <td><span class="badge-year"><?php echo $row['Angkatan']; ?></span></td>
                    <td><?php echo $row['Jurusan']; ?></td>
                    <td class="actions">
                        <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn-edit">Edit</a>
                        <a href="delete.php?id=<?php echo $row['id']; ?>" 
                           class="btn-delete" 
                           onclick="return confirm('Apakah yakin ingin hapus data ini?')">Hapus</a>
                    </td>
                </tr>
            <?php } 
                        } else {
                            echo "<tr><td colspan='4' class='empty-row'>Data tidak ditemukan atau masih kosong.</td></tr>";
                        }
                        ?>
                   

                    </tbody>
                </table>
            </div>
      
        </main>

        <footer class="main-footer">
            <p>&copy; 2026-Selvi dearifa</p>
            
        </footer>
    </div>

</html>