<?php

$hostName = "localhost";
$userName = "root";
$password = "";
$dbName = "food_app";

$koneksi = mysqli_connect($hostName, $userName, $password, $dbName);

if (!$koneksi){
    echo "koneksi Gagal";
}