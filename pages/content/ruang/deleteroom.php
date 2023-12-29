<!-- hapusroom.php -->
<?php
require '../../../config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Pastikan ruangan_id tersedia
    if (isset($_POST['ruangan_id'])) {
        $ruangan_id = intval($_POST['ruangan_id']);

        // Hapus data ruangan berdasarkan ID
        $delete_query = "UPDATE tbl_ruangan SET status_deleted = 1 WHERE ruangan_id=$ruangan_id";
        if (mysqli_query($db_connect, $delete_query)) {
            // Alihkan ke halaman utama setelah penghapusan
            header("Location: room.php");
            exit();
        } else {
            // Handle error jika kueri tidak berhasil
            die("Error deleting ruangan: " . mysqli_error($db_connect));
        }
    } else {
        die("Ruangan ID not provided");
    }
} else {
    die("Invalid request method");
}
?>
