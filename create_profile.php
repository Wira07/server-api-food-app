<?php
include 'koneksi.php';

header('Content-Type: application/json');

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];

$response = array();

if ($name && $email && $phone) {
    $sql = "INSERT INTO profiles (name, email, phone) VALUES ('$name', '$email', '$phone')";
    if ($conn->query($sql) === TRUE) {
        $response['status'] = 'success';
        $response['message'] = 'New record created successfully';
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Error: ' . $sql . '<br>' . $conn->error;
    }
} else {
    $response['status'] = 'error';
    $response['message'] = 'Invalid input';
}

$conn->close();
echo json_encode($response);
?>
