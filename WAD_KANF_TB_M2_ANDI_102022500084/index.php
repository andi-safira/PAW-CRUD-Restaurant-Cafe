<?php
include 'koneksi.php';

$query = mysqli_query($conn, "SELECT * FROM menu");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Daftar Menu</title>
</head>
<body>

    <h1>Daftar Buku Menu</h1>

    <a href="tambah.php">+ Tambah Menu Baru</a>
    <br><br>

    <table border="1" cellpadding="8">
        <tr>
            <th>Nama Menu</th>
            <th>Kategori</th>
            <th>Harga</th>
            <th>Alergen</th>
            <th>Halal</th>
            <th>Aksi</th>
        </tr>

        <?php while ($menu = mysqli_fetch_assoc($query)) { ?>
        <tr>
            <td><?php echo htmlspecialchars($menu['nama']); ?></td>
            <td><?php echo htmlspecialchars($menu['kategori']); ?></td>
            <td>Rp <?php echo number_format($menu['harga'], 0, ',', '.'); ?></td>
            <td><?php echo htmlspecialchars($menu['alergen'] ?? ''); ?></td>
            <td><?php echo htmlspecialchars($menu['halal'] ?? ''); ?></td>
            <td>
                <a href="edit.php?id=<?php echo $menu['id']; ?>">Edit</a> |
                <a href="hapus.php?id=<?php echo $menu['id']; ?>"
                   onclick="return confirm('Yakin ingin menghapus menu ini?')">Hapus</a>
            </td>
        </tr>
        <?php } ?>

    </table>

</body>
</html>