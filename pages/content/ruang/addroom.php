<!-- addroom.php -->
<?php
require '../../../config/db.php';

// Inisialisasi variabel
$no_ruangan = '';
$kapasitas = '';

// Periksa apakah formulir telah dikirim
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil nilai dari formulir
    $no_ruangan = $_POST['no_ruangan'];
    $kapasitas = $_POST['kapasitas'];

    // Lakukan validasi dan masukkan data ke dalam database
    if (!empty($no_ruangan) && !empty($kapasitas)) {
        $insert_query = "INSERT INTO tbl_ruangan (no_ruangan, kapasitas) VALUES ('$no_ruangan', '$kapasitas')";
        if (mysqli_query($db_connect, $insert_query)) {
            // Alihkan ke halaman utama setelah penambahan
            header("Location: room.php");
            exit();
        } else {
            // Handle error jika kueri tidak berhasil
            die("Error adding ruangan: " . mysqli_error($db_connect));
        }
    } else {
        // Handle form validation error
        echo "No Ruangan dan Kapasitas tidak boleh kosong.";
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
    <h1>Tambah Ruangan</h1>
    <form method="POST">
        <label for="no_ruangan">No Ruangan:</label>
        <input type="text" id="no_ruangan" name="no_ruangan" value="<?=$no_ruangan?>" required>

        <label for="kapasitas">Kapasitas:</label>
        <input type="number" id="kapasitas" name="kapasitas" value="<?=$kapasitas?>" required>

        <button type="submit">Tambah</button>
    </form>
    </main><!-- End #main -->

<?php
require_once("{$base_dir}pages{$ds}core{$ds}footer.php");
?>