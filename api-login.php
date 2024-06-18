<?php
include 'koneksi.php';

$username = $_GET['username'];
$password = $_GET['password'];

if (!empty($username) && !empty($password)) {
    $cek = "SELECT * FROM user WHERE username = '$username'";
    $msql = mysqli_query($koneksi, $cek);
    $result = mysqli_fetch_assoc($msql);

    if ($result) {
        if (password_verify($password, $result['password'])) {
            echo "Selamat Datang";
        } else {
            echo "0"; // Invalid credentials
        }
    } else {
        echo "0"; // Invalid credentials
    }
} else {
    echo "Ada Data Yang Masih Kosong";
}
?>
