
<?php
include 'koneksi.php';

if (isset($_POST['simpan'])) {
    $nama = $_POST['nama'];
    $kategori = $_POST['kategori'];
    $harga = $_POST['harga'];
    $alergen = $_POST['alergen'];
    $halal = $_POST['halal'];
    $deskripsi = $_POST['deskripsi'];

    $query = "INSERT INTO menu
              (nama, kategori, harga, alergen, halal, deskripsi)
              VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $query);

    mysqli_stmt_bind_param(
        $stmt,
        "ssisss",
        $nama,
        $kategori,
        $harga,
        $alergen,
        $halal,
        $deskripsi
    );

    if (mysqli_stmt_execute($stmt)) {
        header("Location: index.php");
        exit;
    } else {
        echo "Gagal menyimpan menu.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Menu</title>
</head>
<body>

    <h1>Tambah Menu Baru</h1>

    <form method="POST">
        <label>Nama Menu:</label><br>
        <input type="text" name="nama" required>
        <br><br>

        <label>Kategori:</label><br>
        <select name="kategori" required>
            <option value="Makanan">Makanan</option>
            <option value="Minuman">Minuman</option>
            <option value="Dessert">Dessert</option>
        </select>
        <br><br>

        <label>Harga:</label><br>
        <input type="number" name="harga" min="0" required>
        <br><br>

        <label>Alergen:</label><br>
        <input type="text" name="alergen" placeholder="Contoh: telur / Tidak Ada">
        <br><br>

        <label>Halal:</label><br>
        <select name="halal" required>
            <option value="Ya">Ya</option>
            <option value="Tidak">Tidak</option>
        </select>
        <br><br>

        <label>Deskripsi:</label><br>
        <textarea name="deskripsi"></textarea>
        <br><br>

        <button type="submit" name="simpan">Simpan Menu</button>
    </form>

    <br>
    <a href="index.php">Kembali ke Daftar Menu</a>

</body>
</html>
