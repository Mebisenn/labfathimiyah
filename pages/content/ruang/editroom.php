<!-- editroom.php -->
<?php
require '../../../config/db.php';

// Inisialisasi variabel
$tbl_ruangan = array();
$no_ruangan_sebelum = '';
$kapasitas_sebelum = '';

// Periksa apakah ID ruangan disediakan dalam URL
if (isset($_GET['id'])) {
    $ruangan_id = intval($_GET['id']);

    // Ambil detail ruangan berdasarkan ID
    $result = mysqli_query($db_connect, "SELECT * FROM tbl_ruangan WHERE ruangan_id=$ruangan_id");

    // Pengecekan apakah ada hasil dari kueri
    if ($result) {
        // Pengecekan apakah ada data ruangan ditemukan
        if (mysqli_num_rows($result) > 0) {
            $tbl_ruangan = mysqli_fetch_assoc($result);
            // Akses array offset hanya jika variabel terdefinisi dan merupakan array
            $no_ruangan_sebelum = isset($tbl_ruangan['no_ruangan']) ? $tbl_ruangan['no_ruangan'] : '';
            $kapasitas_sebelum = isset($tbl_ruangan['kapasitas']) ? $tbl_ruangan['kapasitas'] : '';
        } else {
            // Handle case when no ruangan data is found
            die("Ruangan data not found for ID: $ruangan_id");
        }
    } else {
        // Handle case when there is an error in the query
        die("Error fetching ruangan data: " . mysqli_error($db_connect));
    }

    // Periksa apakah formulir telah dikirim
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Perbarui detail ruangan
        $no_ruangan_baru = $_POST['no_ruangan_baru'];
        $kapasitas_baru = $_POST['kapasitas_baru'];

        // Lakukan validasi untuk memastikan bahwa $ruangan_id memiliki nilai yang valid
        if (!empty($ruangan_id)) {
            $update_query = "UPDATE tbl_ruangan SET no_ruangan='$no_ruangan_baru', kapasitas='$kapasitas_baru' WHERE ruangan_id=$ruangan_id";
            if (mysqli_query($db_connect, $update_query)) {
                // Alihkan ke halaman utama setelah pengeditan
                header("Location: room.php?edited=true");
                exit();
            } else {
                // Handle error jika kueri tidak berhasil
                die("Error updating ruangan: " . mysqli_error($db_connect));
            }
        } else {
            die("Invalid ruangan ID: $ruangan_id");
        }
    }
} else {
    // Alihkan ke halaman utama jika ID tidak disediakan
    die("Ruangan ID not provided");
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
    <div class="pagetitle">
        <h1>Edit Data Ruangan</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="room.php">Data Ruangan</a></li>
                <li class="breadcrumb-item active">Edit Data Ruangan</li>
            </ol>
        </nav>
    </div>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Edit Data Ruangan</h5>
        <form method="POST">
            <div class="row mb-3">
                <label for="no_ruangan_baru" class="col-sm-2 col-form-label">No Ruangan:</label>
                <div class="col-sm-10">
                    <input type="text" id="no_ruangan_baru" name="no_ruangan_baru" value="<?=$no_ruangan_sebelum?>" required>
                </div>
            </div>

            <div class="row mb-3">
                <label for="kapasitas_baru" class="col-sm-2 col-form-label">Kapasitas:</label>
                <div class="col-sm-10">
                    <input type="number" id="kapasitas_baru" name="kapasitas_baru" value="<?=$kapasitas_sebelum?>" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="room.php">Kembali</a>
                </div>
            </div>
        </form>
    </main><!-- End #main -->

<?php
require_once("{$base_dir}pages{$ds}core{$ds}footer.php");
?>

