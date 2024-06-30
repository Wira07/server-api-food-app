<?php
include 'koneksi.php';

$sql = "SELECT * FROM profiles";
$result = $conn->query($sql);

$profiles = array();

while($row = $result->fetch_assoc()) {
    $profiles[] = $row;
}

echo json_encode($profiles);

$conn->close();
?>
