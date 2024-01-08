<?php
require '../../../config/db.php';

if (isset($_GET['id_jadwal'])) {
    $id_jadwal = $_GET['id_jadwal'];
    
    // Ambil detail jadwal berdasarkan ID
    $result = mysqli_query($db_connect, "SELECT * FROM tbl_jadwal WHERE id_jadwal=$id_jadwal");
    $tbl_jadwal = mysqli_fetch_assoc($result);

    // Periksa apakah formulir telah dikirim
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Ambil nilai dari formulir
        $mapel_baru = $_POST['mapel_baru'];
        $guru_baru = $_POST['guru_baru'];
        $ruangan_baru = $_POST['ruangan_baru'];
        $kelas_baru = $_POST['kelas_baru'];
        $hari_baru = $_POST['hari_baru'];
        $waktu_baru = $_POST['waktu_baru'];

        // Validasi bentrokan jadwal
        $checkOverlapQuery = "SELECT COUNT(*) as count FROM tbl_jadwal WHERE
        id_jadwal <> $id_jadwal AND
        ruangan_id = '$ruangan_baru' AND
        hari_id = '$hari_baru' AND
        waktu_id = '$waktu_baru'";

        $overlapResult = mysqli_query($db_connect, $checkOverlapQuery);
        $overlapCount = mysqli_fetch_assoc($overlapResult)['count'];

        // Jika tidak ada bentrokan, lakukan update pada tbl_jadwal
        if ($overlapCount == 0) {
        mysqli_query($db_connect, "UPDATE tbl_jadwal SET mapel_id='$mapel_baru', guru_id='$guru_baru', ruangan_id='$ruangan_baru', kelas_id='$kelas_baru', hari_id='$hari_baru', waktu_id='$waktu_baru' WHERE id_jadwal=$id_jadwal");

        // Alihkan ke halaman utama setelah pengeditan
        header("Location: dashboard.php?edited=true");
        exit();
        } else {
        echo "Bentrok jadwal terdeteksi. Silakan pilih waktu atau ruangan yang berbeda.";
        }

    }
} else {
    // Alihkan ke halaman utama jika ID tidak disediakan
    header("Location: dashboard.php");
    exit();
}
?>


<!-- ... Form HTML ... -->

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
        <h1>Edit Data Jadwal</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Data Jadwal</a></li>
                <li class="breadcrumb-item active">Edit Data Jadwal</li>
            </ol>
        </nav>
    </div>
    
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Edit Data Jadwal</h5>
        <form method="POST">
            <div class="row mb-3">
                <label for="mapel_baru" class="col-sm-2 col-form-label">Nama Mapel :</label>
                <div class="col-sm-10">
                    <input type="text" id="mapel_baru" name="mapel_baru" value="<?=$tbl_jadwal['mapel_id']?>" required>
                </div>
            </div>

            <div class="row mb-3">
                <label for="guru_baru" class="col-sm-2 col-form-label">Nama Guru :</label>
                <div class="col-sm-10">    
                    <input type="text" id="guru_baru" name="guru_baru" value="<?=$tbl_jadwal['guru_id']?>" required>
                </div>
            </div>

            <div class="row mb-3">
                <label for="ruangan_baru" class="col-sm-2 col-form-label">Ruangan :</label>
                <div class="col-sm-10">
                    <input type="text" id="ruangan_baru" name="ruangan_baru" value="<?=$tbl_jadwal['ruangan_id']?>" required>
                </div>
            </div>

            <div class="row mb-3">
                <label for="kelas_baru" class="col-sm-2 col-form-label">Nama Kelas :</label>
                <div class="col-sm-10">
                    <input type="text" id="kelas_baru" name="kelas_baru" value="<?=$tbl_jadwal['kelas_id']?>" required>
                </div>
            </div>

            <div class="row mb-3">
                <label for="hari_baru" class="col-sm-2 col-form-label">Nama Hari :</label>
                <div class="col-sm-10">
                    <input type="text" id="hari_baru" name="hari_baru" value="<?=$tbl_jadwal['hari_id']?>" required>
                </div>
            </div>

            <div class="row mb-3">
                <label for="waktu_baru" class="col-sm-2 col-form-label">Waktu :</label>
                <div class="col-sm-10">
                    <input type="text" id="waktu_baru" name="waktu_baru" value="<?=$tbl_jadwal['waktu_id']?>" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="dashboard.php">Kembali</a>
                </div>
            </div>
        </form>
        </div>
    </div>
</main><!-- End #main -->

<?php
require_once("{$base_dir}pages{$ds}core{$ds}footer.php");
?>
