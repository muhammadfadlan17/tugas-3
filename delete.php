<?php
include 'koneksi.php';

$id = $_GET['id'];

$sql = "DELETE FROM users WHERE id = $id";

if (mysqli_query($koneksi, $sql)) {
    header("Location: index.php");
} else {
    echo "Error: " . mysqli_error($koneksi);
}
?>
