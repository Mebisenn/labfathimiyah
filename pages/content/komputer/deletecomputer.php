<?php
require_once('../../../config/db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['komputer_id'])) {
    $komputer_id = $_POST['komputer_id'];

    // Query untuk menghapus data dari tabel
    $query = "UPDATE tbl_komputer SET status_deleted = 1 WHERE komputer_id=$komputer_id";

    // Eksekusi query
    if (mysqli_query($db_connect, $query)) {
        header('Location: computer.php'); // Redirect ke halaman utama setelah berhasil hapus data
        exit();
    } else {
        echo 'Error: ' . mysqli_error($db_connect);
    }
}
?>
