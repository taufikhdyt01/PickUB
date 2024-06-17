<?php
// Sesion untuk mengantisipasi driver yang lupa logout
session_start();
if (isset($_SESSION["driver_id"])) {
    $id_driver = $_SESSION["driver_id"];
    $query = "SELECT * FROM drivers WHERE id_driver = '$id_driver'";
    $result = mysqli_query($koneksi, $query);
    $row = mysqli_fetch_assoc($result);
    if (time() - $row["last_active"] > 300) {
        // Jika driver tidak aktif selama 5 menit, status akan otomatis menjadi tidak aktif
        $query = "UPDATE drivers SET status = 'tidak aktif' WHERE id_driver = '$id_driver'";
        $result = mysqli_query($koneksi, $query);
    }
}
?>

<?php
// Tampilkan list status driver
include "koneksi.php";
$query = "SELECT * FROM drivers";
$result = mysqli_query($koneksi, $query);
while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>" . $row["nama"] . "</td>";
    echo "<td>" . $row["status"] . "</td>";
    echo "<td><a href='halaman_profil.php?id=" . $row["id_driver"] . "'>Lihat Profil</a></td>";
    echo "</tr>";
}
?>
<?php
// Tampilkan profil driver
$id_driver = $_GET["id"];
$query = "SELECT * FROM drivers WHERE id_driver = '$id_driver'";
$result = mysqli_query($koneksi, $query);
$row = mysqli_fetch_assoc($result);
echo "<h2>" . $row["nama"] . "</h2>";
echo "<p>Peringkat: " . $row["peringkat"] . "</p>";
echo "<p>Ulasan: " . $row["ulasan"] . "</p>";
?>

<?php
// Update status driver
$id_driver = $_POST["id_driver"];
$status = $_POST["status"];
$query = "UPDATE drivers SET status = '$status' WHERE id_driver = '$id_driver'";
$result = mysqli_query($koneksi, $query);
if (!$result) {
    echo "Gagal update status";
} else {
    echo "Status berhasil diupdate";
}
?>

<?php
// Sesion untuk mengantisipasi driver yang lupa logout
session_start();
if (isset($_SESSION["driver_id"])) {
    $id_driver = $_SESSION["driver_id"];
    $query = "SELECT * FROM drivers WHERE id_driver = '$id_driver'";
    $result = mysqli_query($koneksi, $query);
    $row = mysqli_fetch_assoc($result);
    if (time() - $row["last_active"] > 300) {
        // Jika driver tidak aktif selama 5 menit, status akan otomatis menjadi tidak aktif
        $query = "UPDATE drivers SET status = 'tidak aktif' WHERE id_driver = '$id_driver'";
        $result = mysqli_query($koneksi, $query);
    }
}
?>

