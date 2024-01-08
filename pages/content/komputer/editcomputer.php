<?php
require_once('../../../config/db.php');

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    $komputer_id = $_GET['id'];

    // Query untuk mendapatkan data komputer berdasarkan ID
    $result = mysqli_query($db_connect, "SELECT * FROM tbl_komputer WHERE komputer_id = $komputer_id");

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $nama_komputer = $row['nama_komputer'];
        $spesifikasi_komputer = $row['spesifikasi_komputer'];
        $status_komputer = $row['status_komputer'];
    } else {
        echo 'Error: ' . mysqli_error($db_connect);
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari formulir
    $komputer_id = $_POST['komputer_id'];
    $nama_komputer = $_POST['nama_komputer'];
    $spesifikasi_komputer = $_POST['spesifikasi_komputer'];
    $status_komputer = $_POST['status_komputer'];

    // Query untuk mengupdate data di tabel
    $query = "UPDATE tbl_komputer SET nama_komputer='$nama_komputer', spesifikasi_komputer='$spesifikasi_komputer', status_komputer='$status_komputer' WHERE komputer_id=$komputer_id";
    
    // Eksekusi query
    if (mysqli_query($db_connect, $query)) {
        header('Location: computer.php?edited=true'); // Redirect ke halaman utama setelah berhasil edit data
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
            <h1>Edit Data Komputer</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="computer.php">Data Komputer</a></li>
                    <li class="breadcrumb-item active">Edit Data Komputer</li>
                </ol>
            </nav>
        </div>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Edit Data Komputer</h5>
    <!-- Formulir Edit Data -->
        <form method="POST" action="editcomputer.php">
            <input type="hidden" name="komputer_id" value="<?= $komputer_id ?>">
            
            <div class="row mb-3">
                <label for="nama_komputer" class="col-sm-2 col-form-label">Nama Komputer:</label>
                <div class="col-sm-10">
                    <input type="text" name="nama_komputer" value="<?= $nama_komputer ?>" required>
                </div>
            </div>

            <div class="row mb-3">
                <label for="spesifikasi_komputer" class="col-sm-2 col-form-label">Spesifikasi Komputer:</label>
                <div class="col-sm-10">
                    <input type="text" name="spesifikasi_komputer" value="<?= $spesifikasi_komputer ?>" required>
                </div>
            </div>

            <div class="row mb-3">
                <label for="status_komputer" class="col-sm-2 col-form-label">Status Komputer:</label>
                <div class="col-sm-10">
                    <select name="status_komputer" required>
                        <option value="Aktif" <?= ($status_komputer == 'Aktif') ? 'selected' : ''; ?>>Aktif</option>
                        <option value="Non-Aktif" <?= ($status_komputer == 'Non-Aktif') ? 'selected' : ''; ?>>Non-Aktif</option>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    <a href="computer.php">Kembali</a>
                </div>
            </div>
        </form>
    </main><!-- End #main -->

<?php
require_once("{$base_dir}pages{$ds}core{$ds}footer.php");
?>
