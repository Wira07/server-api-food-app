<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['token']) && isset($_POST['password'])) {
        $token = $_POST['token'];
        $newPassword = $_POST['password'];

        // Validate token existence and expiry
        $query = "SELECT * FROM password_resets WHERE token='$token' AND expiry > NOW()";
        $result = mysqli_query($koneksi, $query);
        $resetRecord = mysqli_fetch_assoc($result);

        if ($resetRecord) {
            $email = $resetRecord['email'];

            // Hash the new password
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

            // Update the user's password in the user table
            $updateQuery = "UPDATE user SET password='$hashedPassword' WHERE username='$email'";
            $updateResult = mysqli_query($koneksi, $updateQuery);

            if ($updateResult) {
                // Delete the token after successful password reset
                $deleteTokenQuery = "DELETE FROM password_resets WHERE token='$token'";
                mysqli_query($koneksi, $deleteTokenQuery);

                echo "Password has been successfully reset.";
            } else {
                echo "Failed to reset password. Please try again.";
            }
        } else {
            echo "Invalid or expired token.";
        }
    } else {
        echo "All fields are required.";
    }
}
?>
