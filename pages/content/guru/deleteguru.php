<!-- ============================== START BACKEND FOR DELETED DATA GURU ============================== -->
<?php
require '../../../config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Pastikan guru_id tersedia dalam parameter GET
    if (isset($_GET['guru_id'])) {
        $guru_id = intval($_GET['guru_id']);

        // Hapus data guru berdasarkan ID
        $delete_query = "UPDATE tbl_guru SET status_deleted = 1 WHERE guru_id=$guru_id";
        if (mysqli_query($db_connect, $delete_query)) {
            // Alihkan ke halaman utama setelah penghapusan
            header("Location: guru.php?deleted=true");
            exit();
        } else {
            // Handle error jika kueri tidak berhasil
            die("Error deleting guru: " . mysqli_error($db_connect));
        }
    } else {
        die("Guru ID not provided");
    }
} else {
    die("Invalid request method");
}
?>
<!-- ============================== FINISH BACKEND FOR DELETED DATA GURU ============================== -->