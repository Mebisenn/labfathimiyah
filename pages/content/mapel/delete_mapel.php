<!-- hapus_mapel.php -->
<?php
require '../../../config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Pastikan mapel_id tersedia
    if (isset($_POST['mapel_id'])) {
        $mapel_id = intval($_POST['mapel_id']);

        // Hapus data mata pelajaran berdasarkan ID
        $delete_query = "UPDATE tbl_mapel SET status_deleted = 1 WHERE mapel_id=$mapel_id";
        if (mysqli_query($db_connect, $delete_query)) {
            // Alihkan ke halaman utama setelah penghapusan
            header("Location: mapel.php");
            exit();
        } else {
            // Handle error jika kueri tidak berhasil
            die("Error deleting mapel: " . mysqli_error($db_connect));
        }
    } else {
        die("Mapel ID not provided");
    }
} else {
    die("Invalid request method");
}
?>
