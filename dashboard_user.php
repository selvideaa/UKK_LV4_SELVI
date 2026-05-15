<?php
session_start();
include 'koneksi.php';


if ($_SESSION['role'] != 'user') {
    header("Location: login.php");
    exit;
}

$keyword = "";
if (isset($_POST['search'])) {
    $keyword = $_POST['keyword'];
    $query = "SELECT * FROM alumni WHERE 
              Nama_Lengkap LIKE '%$keyword%' OR 
              Angkatan LIKE '%$keyword%' OR 
              Jurusan LIKE '%$keyword%'";
} else {
    $query = "SELECT * FROM alumni";
}
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard User</title>
    <link rel="stylesheet" href="css/dashboard.css">
</head>
<body>
    <div class="bg-overlay"></div>
    
    <div class="admin-container">
        <header class="main-header">
    <div class="header-left">
        <h3>Dashboard User</h3>
    </div>
    <div class="header-center">
        <h2>Manajemen Data Alumni</h2>
    </div>
    <div class="header-right">
        <span>Halo, <strong><?php echo $_SESSION['username']; ?></strong></span>
        <a href="logout.php" class="btn-logout">Logout</a>
    </div>
</header>


        <main class="content">
            <div class="glass-card">
            <div class="action-bar user-bar">
                <form method="POST" class="search-form">
                <input type="text" name="keyword" placeholder="Cari teman angkatan..." value="<?php echo $keyword; ?>">
                <button type="submit" name="search" class="btn-search">Cari</button>
                <?php if($keyword != ""): ?>
                <button type="submit" name="reset" class="btn-reset">Reset</button>
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
        </tr>
    </thead>
        <tbody>
            <?php 
            if (mysqli_num_rows($result) > 0) {
                $no = 1; 
                while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td class="name-cell"><?php echo $row['Nama_Lengkap']; ?></td>
                    <td><span class="badge-year"><?php echo $row['Angkatan']; ?></span></td>
                    <td><?php echo $row['Jurusan']; ?></td>
                </tr>
            <?php } 
                } else {
                echo "<tr><td colspan='3' class='empty-row'>Data tidak ditemukan.</td></tr>";
                }
                ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>

        <footer class="main-footer">
            <p>&copy; 2026-Selvi dearifa</p>
           
        </footer>
    </div>
</body>
</html>