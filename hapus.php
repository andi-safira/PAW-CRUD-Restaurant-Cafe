```php
<?php
include 'koneksi.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID menu tidak valid.");
}

$id = (int) $_GET['id'];

$stmt = mysqli_prepare($conn, "DELETE FROM menu WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);

if (mysqli_stmt_execute($stmt)) {
    header("Location: index.php");
    exit;
} else {
    echo "Gagal menghapus menu.";
}
?>
```