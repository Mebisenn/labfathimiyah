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
            header("Location: room.php?success=true");
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
    if ($_SESSION['role'] !== 'admin') {
        // Jika bukan super admin atau admin, tampilkan pesan atau redirect ke halaman lain
        header("Location: ../../../login.php");
        exit();
    }


$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__) . $ds . '..' . $ds . '..' . $ds . '..') . $ds;
require_once("{$base_dir}pages{$ds}core{$ds}header.php");

?>

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Tambah Data Ruangan</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="room.php">Data Ruangan</a></li>
                    <li class="breadcrumb-item active">Tambah Data Ruangan</li>
                </ol>
            </nav>
        </div>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Tambah Data Ruangan</h5>
            <form method="POST">
                <div class="row mb-3">
                    <label for="no_ruangan" class="col-sm-2 col-form-label">No Ruangan:</label>
                    <div class="col-sm-10">
                        <input type="text" id="no_ruangan" name="no_ruangan" value="<?=$no_ruangan?>" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="kapasitas" class="col-sm-2 col-form-label">Kapasitas:</label>
                    <div class="col-sm-10">
                        <input type="number" id="kapasitas" name="kapasitas" value="<?=$kapasitas?>" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Tambah</button>
                        <a href="room.php">Kembali</a>
                    </div>
                </div>
            </form>
    </main><!-- End #main -->

<?php
require_once("{$base_dir}pages{$ds}core{$ds}footer.php");
?>