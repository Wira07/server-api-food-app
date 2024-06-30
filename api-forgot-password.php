<?php
include 'koneksi.php';

$email = $_POST['email'];

if (!empty($email)) {
    $cek = "SELECT * FROM user WHERE username = '$email'";
    $msql = mysqli_query($koneksi, $cek);
    $result = mysqli_fetch_assoc($msql);

    if ($result) {
        $token = bin2hex(random_bytes(50));
        $expiry = date('Y-m-d H:i:s', strtotime('+1 hour'));

        $insertToken = "INSERT INTO password_resets (email, token, expiry) VALUES ('$email', '$token', '$expiry')";
        $msqlInsertToken = mysqli_query($koneksi, $insertToken);

        if ($msqlInsertToken) {
            $resetLink = "http://server-api-food-app.test/reset_password.php?token=$token";
            $subject = "Password Reset Request";
            $message = "Hi, please click on the link below to reset your password:\n\n$resetLink\n\nThis link will expire in one hour.";
            $headers = "From: no-reply@server-api-food-app.test";

            if (mail($email, $subject, $message, $headers)) {
                echo "Email Sent";
            } else {
                echo "Failed to send email";
            }
        } else {
            echo "Failed to generate reset token";
        }
    } else {
        echo "Email not found";
    }
} else {
    echo "Email field is empty";
}
?>
