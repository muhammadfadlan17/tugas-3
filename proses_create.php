<?php
include 'koneksi.php';

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];

$sql = "INSERT INTO users (name, email, phone) VALUES ('$name', '$email', '$phone')";

if (mysqli_query($koneksi, $sql)) {
    header("Location: index.php");
} else {
    echo "Error: " . mysqli_error($koneksi);
}
?>
