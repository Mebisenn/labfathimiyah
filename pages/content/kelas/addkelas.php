<!-- addkelas.php -->
<?php
require '../../../config/db.php';

// Inisialisasi variabel
$nama_kelas = '';

// Periksa apakah formulir telah dikirim
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil nilai dari formulir
    $nama_kelas = $_POST['nama_kelas'];

    // Lakukan validasi dan masukkan data ke dalam database
    if (!empty($nama_kelas)) {
        $insert_query = "INSERT INTO tbl_kelas (nama_kelas) VALUES ('$nama_kelas')";
        if (mysqli_query($db_connect, $insert_query)) {
            // Alihkan ke halaman utama setelah penambahan
            header("Location: class.php?success=true");
            exit();
        } else {
            // Handle error jika kueri tidak berhasil
            die("Error adding kelas: " . mysqli_error($db_connect));
        }
    } else {
        // Handle form validation error
        echo "Nama Kelas tidak boleh kosong.";
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
            <h1>Tambah Data kelas</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="class.php">Data Kelas</a></li>
                    <li class="breadcrumb-item active">Tambah Data Kelas</li>
                </ol>
            </nav>
        </div>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Tambah Data Kelas</h5>

                <form method="POST">
                    <div class="row mb-3">
                        <label for="nama_kelas" class="col-sm-2 col-form-label">Nama Kelas:</label>
                        <div class="col-sm-10">
                            <input type="text" id="nama_kelas" name="nama_kelas" value="<?=$nama_kelas?>" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary">Tambah</button>
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
