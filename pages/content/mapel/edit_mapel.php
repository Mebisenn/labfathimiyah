<!-- edit_mapel.php -->
<?php
require '../../../config/db.php';

// Inisialisasi variabel
$tbl_mapel = array();
$nama_mapel_sebelum = '';

// Periksa apakah ID mapel disediakan dalam URL
if (isset($_GET['id'])) {
    $mapel_id = intval($_GET['id']);

    // Ambil detail mapel berdasarkan ID
    $result = mysqli_query($db_connect, "SELECT * FROM tbl_mapel WHERE mapel_id=$mapel_id");

    // Pengecekan apakah ada hasil dari kueri
    if ($result) {
        // Pengecekan apakah ada data mapel ditemukan
        if (mysqli_num_rows($result) > 0) {
            $tbl_mapel = mysqli_fetch_assoc($result);
            // Akses array offset hanya jika variabel terdefinisi dan merupakan array
            $nama_mapel_sebelum = isset($tbl_mapel['nama_mapel']) ? $tbl_mapel['nama_mapel'] : '';
        } else {
            // Handle case when no mapel data is found
            die("Mapel data not found for ID: $mapel_id");
        }
    } else {
        // Handle case when there is an error in the query
        die("Error fetching mapel data: " . mysqli_error($db_connect));
    }

    // Periksa apakah formulir telah dikirim
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Perbarui detail mapel
        $nama_mapel_baru = $_POST['nama_mapel_baru'];

        // Lakukan validasi untuk memastikan bahwa $mapel_id memiliki nilai yang valid
        if (!empty($mapel_id)) {
            $update_query = "UPDATE tbl_mapel SET nama_mapel='$nama_mapel_baru' WHERE mapel_id=$mapel_id";
            if (mysqli_query($db_connect, $update_query)) {
                // Alihkan ke halaman utama setelah pengeditan
                header("Location: mapel.php?edited=true");
                exit();
            } else {
                // Handle error jika kueri tidak berhasil
                die("Error updating mapel: " . mysqli_error($db_connect));
            }
        } else {
            die("Invalid mapel ID: $mapel_id");
        }
    }
} else {
    // Alihkan ke halaman utama jika ID tidak disediakan
    die("Mapel ID not provided");
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
        <h1>Edit Data Mapel</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="mapel.php">Data Mapel</a></li>
                <li class="breadcrumb-item active">Edit Data Mapel</li>
            </ol>
        </nav>
    </div>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Edit Data Mapel</h5>

            <form method="POST">
                <div class="row mb-3">
                    <label for="nama_mapel_baru" class="col-sm-2 col-form-label">Nama Mapel:</label>
                    <div class="col-sm-10">
                        <input type="text" id="nama_mapel_baru" name="nama_mapel_baru" value="<?=$nama_mapel_sebelum?>" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="mapel.php">Kembali</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </main><!-- End #main -->


<?php
require_once("{$base_dir}pages{$ds}core{$ds}footer.php");
?>