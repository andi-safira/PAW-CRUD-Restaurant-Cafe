<?php
include 'koneksi.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    die("ID menu tidak ditemukan.");
}

// Mengambil data menu berdasarkan ID
$stmt = mysqli_prepare($conn, "SELECT * FROM menu WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
$menu = mysqli_fetch_assoc($result);

if (!$menu) {
    die("Menu tidak ditemukan.");
}

// Memproses perubahan data ketika tombol Update ditekan
if (isset($_POST['update'])) {
    $nama = $_POST['nama'];
    $kategori = $_POST['kategori'];
    $harga = $_POST['harga'];
    $alergen = $_POST['alergen'];
    $halal = $_POST['halal'];
    $deskripsi = $_POST['deskripsi'];

    $sql = "UPDATE menu
            SET nama = ?, kategori = ?, harga = ?,
                alergen = ?, halal = ?, deskripsi = ?
            WHERE id = ?";

    $update = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param(
        $update,
        "ssisssi",
        $nama,
        $kategori,
        $harga,
        $alergen,
        $halal,
        $deskripsi,
        $id
    );

    if (mysqli_stmt_execute($update)) {
        header("Location: index.php");
        exit;
    } else {
        echo "Gagal mengubah data menu.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Menu</title>
</head>
<body>

    <h1>Edit Menu</h1>

    <form method="POST">
        <label>Nama Menu:</label><br>
        <input
            type="text"
            name="nama"
            value="<?php echo htmlspecialchars($menu['nama']); ?>"
            required
        >
        <br><br>

        <label>Kategori:</label><br>
        <select name="kategori" required>
            <option value="Makanan"
                <?php if ($menu['kategori'] == 'Makanan') echo 'selected'; ?>>
                Makanan
            </option>

            <option value="Minuman"
                <?php if ($menu['kategori'] == 'Minuman') echo 'selected'; ?>>
                Minuman
            </option>

            <option value="Dessert"
                <?php if ($menu['kategori'] == 'Dessert') echo 'selected'; ?>>
                Dessert
            </option>
        </select>
        <br><br>

        <label>Harga:</label><br>
        <input
            type="number"
            name="harga"
            min="0"
            value="<?php echo htmlspecialchars((string)$menu['harga']); ?>"
            required
        >
        <br><br>

        <label>Alergen:</label><br>
        <input
            type="text"
            name="alergen"
            value="<?php echo htmlspecialchars($menu['alergen'] ?? ''); ?>"
        >
        <br><br>

        <label>Halal:</label><br>
        <select name="halal" required>
            <option value="Ya"
                <?php if ($menu['halal'] == 'Ya') echo 'selected'; ?>>
                Ya
            </option>

            <option value="Tidak"
                <?php if ($menu['halal'] == 'Tidak') echo 'selected'; ?>>
                Tidak
            </option>
        </select>
        <br><br>

        <label>Deskripsi:</label><br>
        <textarea name="deskripsi"><?php
            echo htmlspecialchars($menu['deskripsi'] ?? '');
        ?></textarea>
        <br><br>

        <button type="submit" name="update">Update Menu</button>
    </form>

    <br>
    <a href="index.php">Kembali ke Daftar Menu</a>

</body>
</html>