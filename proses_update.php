<?php
include 'koneksi.php';

$id = $_POST['id'];
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];

$sql = "UPDATE users SET name = '$name', email = '$email', phone = '$phone' WHERE id = $id";

if (mysqli_query($koneksi, $sql)) {
    header("Location: index.php");
} else {
    echo "Error: " . mysqli_error($koneksi);
}
?>
