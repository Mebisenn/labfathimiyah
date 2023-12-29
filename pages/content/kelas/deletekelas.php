<!-- hapuskelas.php -->
<?php
require '../../../config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Pastikan kelas_id tersedia
    if (isset($_POST['kelas_id'])) {
        $kelas_id = intval($_POST['kelas_id']);

        // Hapus data kelas berdasarkan ID
        $delete_query = "UPDATE tbl_kelas SET status_deleted = 1 WHERE kelas_id=$kelas_id";
        if (mysqli_query($db_connect, $delete_query)) {
            // Alihkan ke halaman utama setelah penghapusan
            header("Location: class.php");
            exit();
        } else {
            // Handle error jika kueri tidak berhasil
            die("Error deleting kelas: " . mysqli_error($db_connect));
        }
    } else {
        die("Kelas ID not provided");
    }
} else {
    die("Invalid request method");
}
?>
