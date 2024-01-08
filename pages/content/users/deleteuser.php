<?php
require '../../../config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Pastikan user_id tersedia
    if (isset($_POST['user_id'])) {
        $user_id = intval($_POST['user_id']);

        // Hapus data pengguna berdasarkan ID
        $delete_query = "DELETE FROM tbl_users WHERE user_id=$user_id";
        if (mysqli_query($db_connect, $delete_query)) {
            // Alihkan ke halaman utama setelah penghapusan
            header("Location: datauser.php?deleted=true");
            exit();
        } else {
            // Handle error jika kueri tidak berhasil
            die("Error deleting user: " . mysqli_error($db_connect));
        }
    } else {
        die("User ID not provided");
    }
} else {
    die("Invalid request method");
}
?>
