<?php
include 'koneksi.php';

// Ambil ID dari URL
$id = $_GET['id'];

// Query untuk mendapatkan data user berdasarkan ID
$sql = "SELECT * FROM users WHERE id = $id";
$result = mysqli_query($koneksi, $sql);

if (!$result) {
    die("Query gagal: " . mysqli_error($koneksi));
}

// Ambil data user
$row = mysqli_fetch_assoc($result);

if (!$row) {
    die("Data tidak ditemukan!");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center">Edit User</h1>
    <form action="proses_update.php" method="POST">
        <!-- Input hidden untuk ID -->
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        
        <!-- Input untuk Nama -->
        <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo $row['name']; ?>" required>
        </div>
        
        <!-- Input untuk Email -->
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo $row['email']; ?>" required>
        </div>
        
        <!-- Input untuk Telepon -->
        <div class="mb-3">
            <label for="phone" class="form-label">Telepon</label>
            <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $row['phone']; ?>" required>
        </div>
        
        <!-- Tombol Simpan -->
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
</body>
</html>
