<?php
include 'koneksi.php';

// Ambil kata kunci pencarian
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Pagination
$limit = 5;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Query data
$sql = "SELECT * FROM users WHERE name LIKE '%$search%' LIMIT $limit OFFSET $offset";
$result = mysqli_query($koneksi, $sql);

if (!$result) {
    die("Query gagal: " . mysqli_error($koneksi));
}

// Total data untuk pagination
$total_sql = "SELECT COUNT(*) FROM users WHERE name LIKE '%$search%'";
$total_result = mysqli_query($koneksi, $total_sql);
$total_data = mysqli_fetch_array($total_result)[0];
$total_pages = ceil($total_data / $limit);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Users</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center">Data Users</h1>
    <a href="create.php" class="btn btn-success mb-3">Tambah User</a>
    <form class="d-flex mb-3" method="GET" action="index.php">
        <input class="form-control me-2" type="search" name="search" placeholder="Cari nama..." value="<?php echo $search; ?>">
        <button class="btn btn-primary" type="submit">Cari</button>
    </form>

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Telepon</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (mysqli_num_rows($result) > 0) { ?>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['phone']; ?></td>
                    <td>
                        <a href="update.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="delete.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?');">Hapus</a>
                    </td>
                </tr>
                <?php } ?>
            <?php } else { ?>
                <tr>
                    <td colspan="5" class="text-center">Tidak ada data ditemukan</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <nav>
        <ul class="pagination">
            <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
                <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                    <a class="page-link" href="?page=<?php echo $i; ?>&search=<?php echo $search; ?>"><?php echo $i; ?></a>
                </li>
            <?php } ?>
        </ul>
    </nav>
</div>
</body>
</html>
