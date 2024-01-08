<?php
require '../../../config/db.php';

class MapelManager {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function deleteMapel($mapel_id) {
        $delete_query = "UPDATE tbl_mapel SET status_deleted = 1 WHERE mapel_id=$mapel_id";
        mysqli_query($this->db, $delete_query);
    }
}

// Penggunaan
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['id'])) {
        $mapel_id = intval($_GET['id']);

        $mapelManager = new MapelManager($db_connect);
        $mapelManager->deleteMapel($mapel_id);

        header("Location: mapel.php?deleted=true");
        exit();
    } else {
        die("Mapel ID not provided");
    }
} else {
    die("Invalid request method");
}

?>
