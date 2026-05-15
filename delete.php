<?php
session_start();
include 'koneksi.php';


if ($_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit;
}


if (isset($_GET['id'])) {
    $id = $_GET['id'];

    
    $sql = "DELETE FROM alumni WHERE id='$id'";
    if (mysqli_query($conn, $sql)) {
    header("Location: dashboard_admin.php");
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
    } else {
    echo "ID tidak ditemukan!";
    }
?>