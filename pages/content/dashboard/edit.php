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
                <label for="guru_baru" class="col-sm-2 col-form-label">Nama Guru:</label>
                    <div class="col-sm-10">
                        <select id="guru_baru" name="guru_baru" required>
                            <?php
                            require '../../../config/db.php';
                            // Ambil data dari tabel tbl_guru
                            $guruQuery = "SELECT * FROM tbl_guru";
                            $guruResult = mysqli_query($db_connect, $guruQuery);

                            while ($row = mysqli_fetch_assoc($guruResult)) {
                                echo "<option value='{$row['guru_id']}'>{$row['nama_guru']}</option>";
                            }
                            ?>
                        </select>
                    </div>
            </div>

            <div class="row mb-3">
                <label for="hari_baru" class="col-sm-2 col-form-label">Nama Hari:</label>
                    <div class="col-sm-10">
                        <select id="hari_baru" name="hari_baru" required>
                            <?php
                            // Ambil data dari tabel tbl_hari
                            $hariQuery = "SELECT * FROM tbl_hari";
                            $hariResult = mysqli_query($db_connect, $hariQuery);

                            while ($row = mysqli_fetch_assoc($hariResult)) {
                                echo "<option value='{$row['hari_id']}'>{$row['nama_hari']}</option>";
                            }
                            ?>
                        </select>
                    </div>
            </div>

            <div class="row mb-3">
                <label for="ruangan_baru" class="col-sm-2 col-form-label">Ruangan:</label>
                    <div class="col-sm-10">
                        <select id="ruangan_baru" name="ruangan_baru" required>
                            <?php
                            // Ambil data dari tabel tbl_ruangan
                            $ruanganQuery = "SELECT * FROM tbl_ruangan";
                            $ruanganResult = mysqli_query($db_connect, $ruanganQuery);

                            while ($row = mysqli_fetch_assoc($ruanganResult)) {
                                echo "<option value='{$row['ruangan_id']}'>{$row['no_ruangan']}</option>";
                            }
                            ?>
                        </select>
                    </div>
            </div>

            <div class="row mb-3">
                <label for="kelas_baru" class="col-sm-2 col-form-label">Nama Kelas:</label>
                    <div class="col-sm-10">
                        <select id="kelas_baru" name="kelas_baru" required>
                            <?php
                            // Ambil data dari tabel tbl_kelas
                            $kelasQuery = "SELECT * FROM tbl_kelas";
                            $kelasResult = mysqli_query($db_connect, $kelasQuery);

                            while ($row = mysqli_fetch_assoc($kelasResult)) {
                                echo "<option value='{$row['kelas_id']}'>{$row['nama_kelas']}</option>";
                            }
                            ?>
                        </select>
                    </div>
            </div>

            <div class="row mb-3">
                <label for="mapel_baru" class="col-sm-2 col-form-label">Nama Mapel:</label>
                    <div class="col-sm-10">
                        <select id="mapel_baru" name="mapel_baru" required>
                            <?php
                            // Ambil data dari tabel tbl_mapel
                            $mapelQuery = "SELECT * FROM tbl_mapel";
                            $mapelResult = mysqli_query($db_connect, $mapelQuery);

                            while ($row = mysqli_fetch_assoc($mapelResult)) {
                                echo "<option value='{$row['mapel_id']}'>{$row['nama_mapel']}</option>";
                            }
                            ?>
                        </select>
                    </div>
            </div>

            <div class="row mb-3">
                <label for="waktu_baru" class="col-sm-2 col-form-label">Waktu:</label>
                    <div class="col-sm-10">
                        <select id="waktu_baru" name="waktu_baru" required>
                            <?php
                            // Ambil data dari tabel tbl_waktu
                            $waktuQuery = "SELECT * FROM tbl_waktu";
                            $waktuResult = mysqli_query($db_connect, $waktuQuery);

                            while ($row = mysqli_fetch_assoc($waktuResult)) {
                                echo "<option value='{$row['waktu_id']}'>{$row['waktu_mulai']}-{$row['waktu_selesai']}</option>";
                            }
                            ?>
                        </select>
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
