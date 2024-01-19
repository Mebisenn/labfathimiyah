<!-- editguru.php -->
<?php
require '../../../config/db.php';

// Inisialisasi variabel
$tbl_guru = array();
$nama_guru_sebelum = '';

// Periksa apakah ID guru disediakan dalam URL
if (isset($_GET['id'])) {
    $guru_id = intval($_GET['id']);

    // Ambil detail guru berdasarkan ID
    $result = mysqli_query($db_connect, "SELECT * FROM tbl_guru WHERE guru_id=$guru_id");

    // Pengecekan apakah ada hasil dari kueri
    if ($result) {
        // Pengecekan apakah ada data guru ditemukan
        if (mysqli_num_rows($result) > 0) {
            $tbl_guru = mysqli_fetch_assoc($result);
            // Akses array offset hanya jika variabel terdefinisi dan merupakan array
            $nama_guru_sebelum = isset($tbl_guru['nama_guru']) ? $tbl_guru['nama_guru'] : '';
        } else {
            // Handle case when no guru data is found
            die("Guru data not found for ID: $guru_id");
        }
    } else {
        // Handle case when there is an error in the query
        die("Error fetching guru data: " . mysqli_error($db_connect));
    }

    // Periksa apakah formulir telah dikirim
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Perbarui detail guru
        $nama_guru_baru = $_POST['nama_guru_baru'];

        // Lakukan validasi untuk memastikan bahwa $guru_id memiliki nilai yang valid
        if (!empty($guru_id)) {
            $update_query = "UPDATE tbl_guru SET nama_guru='$nama_guru_baru' WHERE guru_id=$guru_id";
            if (mysqli_query($db_connect, $update_query)) {
                // Alihkan ke halaman utama setelah pengeditan
                header("Location: guru.php?edited=true");
                exit();
            } else {
                // Handle error jika kueri tidak berhasil
                die("Error updating guru: " . mysqli_error($db_connect));
            }
        } else {
            die("Invalid guru ID: $guru_id");
        }
    }
} else {
    // Alihkan ke halaman utama jika ID tidak disediakan
    die("Guru ID not provided");
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
            <h1>Edit Data Guru</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="guru.php">Data Guru</a></li>
                    <li class="breadcrumb-item active">Edit Data Guru</li>
                </ol>
            </nav>
        </div>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Tambah Data Jadwal</h5>
                <form method="POST">
                    <div class="row mb-3">
                        <label for="nama_guru_baru" class="col-sm-2 col-form-label">Nama Guru:</label>
                        <div class="col-sm-10">
                            <input type="text" id="nama_guru_baru" name="nama_guru_baru" value="<?=$nama_guru_sebelum?>" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="guru.php">Kembali</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main><!-- End #main -->

<?php
require_once("{$base_dir}pages{$ds}core{$ds}footer.php");
?>