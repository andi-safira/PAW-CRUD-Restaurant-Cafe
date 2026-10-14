<?php

if (isset($_POST['simpan'])) {

    $nama = $_POST['nama'];
    $kategori = $_POST['kategori'];
    $harga = $_POST['harga'];
    $alergen = $_POST['alergen'];
    $halal = $_POST['halal'];
    $deskripsi = $_POST['deskripsi'];

    echo "<h2>Menu berhasil disimpan!</h2>";

    echo "Nama Menu: " . $nama . "<br>";
    echo "Kategori: " . $kategori . "<br>";
    echo "Harga: Rp " . $harga . "<br>";
    echo "Alergen: " . $alergen . "<br>";
    echo "Halal: " . $halal . "<br>";
    echo "Deskripsi: " . $deskripsi . "<br><br>";

    echo '<a href="index.php">Kembali ke Daftar Menu</a>';

    exit;
}

?>


<!DOCTYPE html>

<html>

<head>

    <title>Tambah Menu</title>

</head>

<body>

    <h1>Form Tambah Menu Baru</h1>

    <form method="POST">

        <label>Nama Menu:</label>
        <br>

        <input
            type="text"
            name="nama"
            required
        >

        <br><br>


        <label>Kategori:</label>
        <br>

        <select name="kategori">

            <option>Makanan</option>
            <option>Minuman</option>
            <option>Dessert</option>

        </select>

        <br><br>


        <label>Harga (Rp):</label>
        <br>

        <input
            type="number"
            name="harga"
            required
        >

        <br><br>


        <label>Alergen (Opsional):</label>
        <br>

        <input
            type="text"
            name="alergen"
        >

        <br><br>


        <label>Status Halal:</label>
        <br>

        <input
            type="radio"
            name="halal"
            value="Ya"
            checked
        >

        Ya

        <input
            type="radio"
            name="halal"
            value="Tidak"
        >

        Tidak

        <br><br>


        <label>Deskripsi:</label>
        <br>

        <textarea
            name="deskripsi"
            rows="4"
            cols="40"
        ></textarea>

        <br><br>


        <label>Foto Menu:</label>
        <br>

        <input
            type="file"
            name="foto"
        >

        <br><br>


        <!-- Tombol Simpan & Batal -->

        <button
            Simpan
        </button>

        <a href="index.php">
            Batal
        </a>

    </form>

</body>

</html>