<?php
include 'koneksi.php';

$token = $_GET['token'] ?? '';

if (empty($token)) {
    echo "Token is missing.";
    exit;
}

$cek = "SELECT * FROM password_resets WHERE token = '$token' AND expiry > NOW()";
$msql = mysqli_query($koneksi, $cek);
$result = mysqli_fetch_assoc($msql);

if ($result) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];

        if (!empty($new_password) && $new_password === $confirm_password) {
            $hashedPassword = password_hash($new_password, PASSWORD_DEFAULT);
            $updatePassword = "UPDATE user SET password = '$hashedPassword' WHERE username = '".$result['email']."'";
            $msqlUpdatePassword = mysqli_query($koneksi, $updatePassword);

            if ($msqlUpdatePassword) {
                $deleteToken = "DELETE FROM password_resets WHERE token = '$token'";
                mysqli_query($koneksi, $deleteToken);
                echo "Password reset successful. You can now log in with your new password.";
            } else {
                echo "Failed to reset password.";
            }
        } else {
            echo "Passwords do not match or are empty.";
        }
    } else {
        // Show reset password form
        echo '<form method="post" action="">
                <label for="new_password">New Password:</label>
                <input type="password" name="new_password" id="new_password" required><br>
                <label for="confirm_password">Confirm Password:</label>
                <input type="password" name="confirm_password" id="confirm_password" required><br>
                <button type="submit">Reset Password</button>
              </form>';
    }

    // Display token details
    echo "<h3>Token Details</h3>";
    echo "<table class='table table-striped table-bordered'>";
    echo "<thead class='table-dark'><tr><th>Email</th><th>Token</th><th>Expiry</th></tr></thead><tbody>";
    echo "<tr><td>" . $result['email'] . "</td><td>" . $result['token'] . "</td><td>" . $result['expiry'] . "</td></tr>";
    echo "</tbody></table>";
} else {
    echo "Invalid or expired token.";
}
?>
