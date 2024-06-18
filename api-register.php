<?php
include 'koneksi.php';

$username = $_POST['username'];
$password = $_POST['password'];

if (!empty($username) && !empty($password)) {
    $queryRegister = "SELECT * FROM user WHERE username = '" . $username . "'";
    $msql = mysqli_query($koneksi, $queryRegister);
    $result = mysqli_num_rows($msql);

    if ($result == 0) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $regis = "INSERT INTO user (username, password) VALUES ('$username', '$hashedPassword')";
        $msqlRegis = mysqli_query($koneksi, $regis);

        if ($msqlRegis) {
            echo "Daftar Berhasil";
        } else {
            echo "Terjadi kesalahan saat mendaftar";
        }
    } else {
        echo "Username Sudah Digunakan";
    }
} else {
    echo "Semua Data Harus Di Isi Lengkap";
}
?>
