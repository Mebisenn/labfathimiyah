<!-- editkelas.php -->
<?php
require '../../../config/db.php';

// Inisialisasi variabel
$tbl_kelas = array();
$nama_kelas_sebelum = '';

// Periksa apakah ID kelas disediakan dalam URL
if (isset($_GET['id'])) {
    $kelas_id = intval($_GET['id']);

    // Ambil detail kelas berdasarkan ID
    $result = mysqli_query($db_connect, "SELECT * FROM tbl_kelas WHERE kelas_id=$kelas_id");

    // Pengecekan apakah ada hasil dari kueri
    if ($result) {
        // Pengecekan apakah ada data kelas ditemukan
        if (mysqli_num_rows($result) > 0) {
            $tbl_kelas = mysqli_fetch_assoc($result);
            // Akses array offset hanya jika variabel terdefinisi dan merupakan array
            $nama_kelas_sebelum = isset($tbl_kelas['nama_kelas']) ? $tbl_kelas['nama_kelas'] : '';
        } else {
            // Handle case when no kelas data is found
            die("Kelas data not found for ID: $kelas_id");
        }
    } else {
        // Handle case when there is an error in the query
        die("Error fetching kelas data: " . mysqli_error($db_connect));
    }

    // Periksa apakah formulir telah dikirim
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Perbarui detail kelas
        $nama_kelas_baru = $_POST['nama_kelas_baru'];

        // Lakukan validasi untuk memastikan bahwa $kelas_id memiliki nilai yang valid
        if (!empty($kelas_id)) {
            $update_query = "UPDATE tbl_kelas SET nama_kelas='$nama_kelas_baru' WHERE kelas_id=$kelas_id";
            if (mysqli_query($db_connect, $update_query)) {
                // Alihkan ke halaman utama setelah pengeditan
                header("Location: class.php?edited=true");
                exit();
            } else {
                // Handle error jika kueri tidak berhasil
                die("Error updating kelas: " . mysqli_error($db_connect));
            }
        } else {
            die("Invalid kelas ID: $kelas_id");
        }
    }
} else {
    // Alihkan ke halaman utama jika ID tidak disediakan
    die("Kelas ID not provided");
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
            <h1>Edit Data Kelas</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="class.php">Data Kelas</a></li>
                    <li class="breadcrumb-item active">Edit Data Kelas</li>
                </ol>
            </nav>
        </div>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Edit Data Kelas</h5>
                <form method="POST">
                    <div class="row mb-3">
                        <label for="nama_kelas_baru" class="col-sm-2 col-form-label">Nama Kelas:</label>
                        <div class="col-sm-10">
                            <input type="text" id="nama_kelas_baru" name="nama_kelas_baru" value="<?=$nama_kelas_sebelum?>" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="class.php">Kembali</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main><!-- End #main -->

<?php
require_once("{$base_dir}pages{$ds}core{$ds}footer.php");
?>

