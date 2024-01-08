<?php
require '../../../config/db.php';

class JadwalManager {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function deleteJadwal($id_jadwal) {
        mysqli_query($this->db, "UPDATE tbl_jadwal SET status_deleted = 1 WHERE id_jadwal=$id_jadwal");
    }
}

// Penggunaan
if (isset($_GET['id_jadwal'])) {
    $id_jadwal = $_GET['id_jadwal'];

    $jadwalManager = new JadwalManager($db_connect);
    $jadwalManager->deleteJadwal($id_jadwal);

    // Alihkan ke halaman utama setelah penghapusan
    header("Location: dashboard.php?deleted=true");
    exit();
} else {
    // Alihkan ke halaman utama jika ID tidak disediakan
    header("Location: dashboard.php");
    exit();
}
?>
