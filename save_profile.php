<?php
$servername = "localhost";
$username = "root"; // Adjust according to your MySQL username
$password = ""; // Adjust according to your MySQL password
$dbname = "food_app";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$action = $_POST['action'];
$id = $_POST['id'];
$email = $_POST['email'];
$whatsapp = $_POST['whatsapp'];
$instagram = $_POST['instagram'];
$github = $_POST['github'];

$response = array();

if ($action == "update") {
    $sql = "UPDATE user_profile SET email='$email', whatsapp='$whatsapp', instagram='$instagram', github='$github' WHERE id=$id";
} elseif ($action == "create") {
    $sql = "INSERT INTO user_profile (email, whatsapp, instagram, github) VALUES ('$email', '$whatsapp', '$instagram', '$github')";
}

if ($conn->query($sql) === TRUE) {
    $response['status'] = 'success';
} else {
    $response['status'] = 'error';
    $response['message'] = $conn->error;
}

echo json_encode($response);

$conn->close();
?>
