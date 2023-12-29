<?php
require_once('../../../config/db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari formulir
    $nama_komputer = $_POST['nama_komputer'];
    $spesifikasi_komputer = $_POST['spesifikasi_komputer'];
    $status_komputer = $_POST['status_komputer'];

    // Query untuk menambahkan data ke tabel
    $query = "INSERT INTO tbl_komputer (nama_komputer, spesifikasi_komputer, status_komputer) VALUES ('$nama_komputer', '$spesifikasi_komputer', '$status_komputer')";
    
    // Eksekusi query
    if (mysqli_query($db_connect, $query)) {
        header('Location: computer.php'); // Redirect ke halaman utama setelah berhasil tambah data
        exit();
    } else {
        echo 'Error: ' . mysqli_error($db_connect);
    }
}
?>
<?php
    // Mulai sesi jika belum dimulai
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    // Periksa apakah pengguna sudah login
    if (!isset($_SESSION['role'])) {
        // Jika belum login, redirect ke halaman login
        header("Location: ../../../login.php");
        exit();
    }

    // Periksa apakah pengguna memiliki peran super admin atau admin
    if ($_SESSION['role'] !== 'super admin' && $_SESSION['role'] !== 'admin') {
        // Jika bukan super admin atau admin, tampilkan pesan atau redirect ke halaman lain
        header("Location: ../../../login.php");
        exit();
    }


$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__) . $ds . '..' . $ds . '..' . $ds . '..') . $ds;
require_once("{$base_dir}pages{$ds}core{$ds}header.php");

?>

<main id="main" class="main">
<!-- Formulir Tambah Data -->
    <form method="POST" action="addcomputer.php">
        <label for="nama_komputer">Nama Komputer:</label>
        <input type="text" name="nama_komputer" required>

        <label for="spesifikasi_komputer">Spesifikasi Komputer:</label>
        <input type="text" name="spesifikasi_komputer" required>

        <label for="status_komputer">Status Komputer:</label>
        <select name="status_komputer" required>
            <option value="Aktif">Aktif</option>
            <option value="Non-Aktif">Non-Aktif</option>
        </select>

        <button type="submit">Tambah Komputer</button>
    </form>
</main><!-- End #main -->

<?php
require_once("{$base_dir}pages{$ds}core{$ds}footer.php");
?>
