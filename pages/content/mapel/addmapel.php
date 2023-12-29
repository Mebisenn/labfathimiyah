<!-- addmapel.php -->
<?php
require '../../../config/db.php';

// Inisialisasi variabel
$nama_mapel = '';

// Periksa apakah formulir telah dikirim
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil nilai dari formulir
    $nama_mapel = $_POST['nama_mapel'];

    // Lakukan validasi dan masukkan data ke dalam database
    if (!empty($nama_mapel)) {
        $insert_query = "INSERT INTO tbl_mapel (nama_mapel) VALUES ('$nama_mapel')";
        if (mysqli_query($db_connect, $insert_query)) {
            // Alihkan ke halaman utama setelah penambahan
            header("Location: mapel.php");
            exit();
        } else {
            // Handle error jika kueri tidak berhasil
            die("Error adding mapel: " . mysqli_error($db_connect));
        }
    } else {
        // Handle form validation error
        echo "Nama Mata Pelajaran tidak boleh kosong.";
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
        <body>
            <h1>Tambah Mata Pelajaran</h1>
            <form method="POST">
                <label for="nama_mapel">Nama Mata Pelajaran:</label>
                <input type="text" id="nama_mapel" name="nama_mapel" value="<?=$nama_mapel?>" required>

                <button type="submit">Tambah</button>
            </form>
        </body>

    </main><!-- End #main -->


<?php
require_once("{$base_dir}pages{$ds}core{$ds}footer.php");
?>
