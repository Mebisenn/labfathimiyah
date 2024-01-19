<?php
require_once('../../../config/db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari formulir
    $nama_komputer = $_POST['nama_komputer'];
    $spesifikasi_komputer = $_POST['spesifikasi_komputer'];
    $status_komputer = $_POST['status_komputer'];

    // Query untuk menambahkan data ke tabel
    $query = "INSERT INTO tbl_komputer (nama_komputer, spesifikasi_komputer, status_komputer) VALUES ('$nama_komputer', '$spesifikasi_komputer', '$status_komputer')";
    
    // Eksekusi query
    if (mysqli_query($db_connect, $query)) {
        header('Location: computer.php?success=true'); // Redirect ke halaman utama setelah berhasil tambah data
        exit();
    } else {
        echo 'Error: ' . mysqli_error($db_connect);
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
        <div class="pagetitle">
            <h1>Tambah Data Komputer</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="computer.php">Data Komputer</a></li>
                    <li class="breadcrumb-item active">Tambah Data Komputer</li>
                </ol>
            </nav>
        </div>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Tambah Data Komputer</h5>
                <form method="POST" action="addcomputer.php">
                    <div class="row mb-3">
                        <label for="nama_komputer" class="col-sm-2 col-form-label">Nama Komputer:</label>
                        <div class="col-sm-10">
                            <input type="text" name="nama_komputer" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="spesifikasi_komputer" class="col-sm-2 col-form-label">Spesifikasi Komputer:</label>
                        <div class="col-sm-10">
                            <input type="text" name="spesifikasi_komputer" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="status_komputer" class="col-sm-2 col-form-label">Status Komputer:</label>
                        <div class="col-sm-10">
                            <select name="status_komputer" required>
                                <option value="Aktif">Aktif</option>
                                <option value="Non-Aktif">Non-Aktif</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary">Tambah Komputer</button>
                            <a href="computer.php">Kembali</a>
                        </div>
                    </div>
                </form>
    </main><!-- End #main -->

<?php
require_once("{$base_dir}pages{$ds}core{$ds}footer.php");
?>
