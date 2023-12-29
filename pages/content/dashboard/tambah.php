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
    <h1>Tambah Data Lab</h1>

    <form method="post" action="tambah.php">
        <label for="tambah_mapel">id Mapel:</label>
        <input type="text" id="tambah_mapel" name="tambah_mapel" required>

        <label for="tambah_guru">id Guru:</label>
        <input type="text" id="tambah_guru" name="tambah_guru" required>

        <label for="tambah_ruangan">id Ruangan:</label>
        <input type="text" id="tambah_ruangan" name="tambah_ruangan" required>

        <label for="tambah_kelas">id Kelas:</label>
        <input type="text" id="tambah_kelas" name="tambah_kelas" required>

        <label for="tambah_hari">id Hari:</label>
        <input type="text" id="tambah_hari" name="tambah_hari" required>

        <label for="tambah_waktu">id waktu:</label>
        <input type="text" id="tambah_waktu" name="tambah_waktu" required>

        <!-- Tambahkan input untuk hari, waktu, dll. sesuai kebutuhan -->

        <button type="submit">Simpan Data</button>
    </form>

    <?php
require '../../../config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_mapel = $_POST['tambah_mapel'];
    $nama_guru = $_POST['tambah_guru'];
    $ruangan = $_POST['tambah_ruangan'];
    $nama_kelas = $_POST['tambah_kelas'];
    $nama_hari = $_POST['tambah_hari'];
    $waktu = $_POST['tambah_waktu'];

    // Validasi untuk memeriksa apakah jadwal dengan parameter yang sama sudah ada
    $checkOverlapQuery = "SELECT COUNT(*) as count FROM tbl_jadwal WHERE
        ruangan_id = '$ruangan' AND
        hari_id = '$nama_hari' AND
        waktu_id = '$waktu'";

    $overlapResult = mysqli_query($db_connect, $checkOverlapQuery);
    $overlapCount = mysqli_fetch_assoc($overlapResult)['count'];

    // Jika tidak ada bentrok, lakukan penambahan data
    if ($overlapCount == 0) {
        $insert_query = "INSERT INTO tbl_jadwal (mapel_id, guru_id, ruangan_id, kelas_id, hari_id, waktu_id) VALUES ('$nama_mapel', '$nama_guru', '$ruangan', '$nama_kelas', '$nama_hari', '$waktu')";

        if (mysqli_query($db_connect, $insert_query)) {
            // Setelah menambahkan jadwal, tambahkan ke tabel periode sebagai history
            $lastInsertedId = mysqli_insert_id($db_connect);
            $insertPeriodeQuery = "INSERT INTO tbl_periode (id_jadwal, semester) VALUES ('$lastInsertedId', 'semester_anda')";
            if (mysqli_query($db_connect, $insertPeriodeQuery)) {
                echo "Data berhasil ditambahkan!";
            } else {
                echo "Error: " . $insertPeriodeQuery . "<br>" . mysqli_error($db_connect);
            }
        } else {
            echo "Error: " . $insert_query . "<br>" . mysqli_error($db_connect);
        }
    } else {
        echo "Bentrok jadwal terdeteksi. Silakan pilih waktu atau ruangan yang berbeda.";
    }
}
?>



    <a href="dashboard.php">Kembali</a>
</main><!-- End #main -->
<?php
require_once("{$base_dir}pages{$ds}core{$ds}footer.php");
?>

