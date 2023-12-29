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
        header('Location: computer.php'); // Redirect ke halaman utama setelah berhasil edit data
        exit();
    } else {
        echo 'Error: ' . mysqli_error($db_connect);
    }
}
?>

<!-- Formulir Edit Data -->
<form method="POST" action="editcomputer.php">
    <input type="hidden" name="komputer_id" value="<?= $komputer_id ?>">

    <label for="nama_komputer">Nama Komputer:</label>
    <input type="text" name="nama_komputer" value="<?= $nama_komputer ?>" required>

    <label for="spesifikasi_komputer">Spesifikasi Komputer:</label>
    <input type="text" name="spesifikasi_komputer" value="<?= $spesifikasi_komputer ?>" required>

    <label for="status_komputer">Status Komputer:</label>
    <select name="status_komputer" required>
        <option value="Aktif" <?= ($status_komputer == 'Aktif') ? 'selected' : ''; ?>>Aktif</option>
        <option value="Non-Aktif" <?= ($status_komputer == 'Non-Aktif') ? 'selected' : ''; ?>>Non-Aktif</option>
    </select>

    <button type="submit">Simpan Perubahan</button>
</form>
