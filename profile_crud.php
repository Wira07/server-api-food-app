<?php
$servername = "localhost";
$username = "root"; // sesuaikan dengan username MySQL Anda
$password = ""; // sesuaikan dengan password MySQL Anda
$dbname = "food_app";

// Membuat koneksi ke database
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$action = $_POST['action'];
$id = $_POST['id'];
$email = $_POST['email'];
$whatsapp = $_POST['whatsapp'];
$instagram = $_POST['instagram'];
$github = $_POST['github'];

if ($action == "update") {
    $sql = "UPDATE user_profile SET email='$email', whatsapp='$whatsapp', instagram='$instagram', github='$github' WHERE id=$id";
} elseif ($action == "create") {
    $sql = "INSERT INTO user_profile (email, whatsapp, instagram, github) VALUES ('$email', '$whatsapp', '$instagram', '$github')";
}

$response = array();

if ($conn->query($sql) === TRUE) {
    $response['status'] = 'success';
} else {
    $response['status'] = 'error';
    $response['message'] = $conn->error;
}

echo json_encode($response);

$conn->close();
?>
