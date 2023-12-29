<!-- editroom.php -->
<?php
require '../../../config/db.php';

// Inisialisasi variabel
$tbl_ruangan = array();
$no_ruangan_sebelum = '';
$kapasitas_sebelum = '';

// Periksa apakah ID ruangan disediakan dalam URL
if (isset($_GET['id'])) {
    $ruangan_id = intval($_GET['id']);

    // Ambil detail ruangan berdasarkan ID
    $result = mysqli_query($db_connect, "SELECT * FROM tbl_ruangan WHERE ruangan_id=$ruangan_id");

    // Pengecekan apakah ada hasil dari kueri
    if ($result) {
        // Pengecekan apakah ada data ruangan ditemukan
        if (mysqli_num_rows($result) > 0) {
            $tbl_ruangan = mysqli_fetch_assoc($result);
            // Akses array offset hanya jika variabel terdefinisi dan merupakan array
            $no_ruangan_sebelum = isset($tbl_ruangan['no_ruangan']) ? $tbl_ruangan['no_ruangan'] : '';
            $kapasitas_sebelum = isset($tbl_ruangan['kapasitas']) ? $tbl_ruangan['kapasitas'] : '';
        } else {
            // Handle case when no ruangan data is found
            die("Ruangan data not found for ID: $ruangan_id");
        }
    } else {
        // Handle case when there is an error in the query
        die("Error fetching ruangan data: " . mysqli_error($db_connect));
    }

    // Periksa apakah formulir telah dikirim
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Perbarui detail ruangan
        $no_ruangan_baru = $_POST['no_ruangan_baru'];
        $kapasitas_baru = $_POST['kapasitas_baru'];

        // Lakukan validasi untuk memastikan bahwa $ruangan_id memiliki nilai yang valid
        if (!empty($ruangan_id)) {
            $update_query = "UPDATE tbl_ruangan SET no_ruangan='$no_ruangan_baru', kapasitas='$kapasitas_baru' WHERE ruangan_id=$ruangan_id";
            if (mysqli_query($db_connect, $update_query)) {
                // Alihkan ke halaman utama setelah pengeditan
                header("Location: room.php");
                exit();
            } else {
                // Handle error jika kueri tidak berhasil
                die("Error updating ruangan: " . mysqli_error($db_connect));
            }
        } else {
            die("Invalid ruangan ID: $ruangan_id");
        }
    }
} else {
    // Alihkan ke halaman utama jika ID tidak disediakan
    die("Ruangan ID not provided");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Ruangan</title>
</head>
<body>
    <h1>Edit Ruangan</h1>
    <form method="POST">
        <label for="no_ruangan_baru">No Ruangan:</label>
        <input type="text" id="no_ruangan_baru" name="no_ruangan_baru" value="<?=$no_ruangan_sebelum?>" required>

        <label for="kapasitas_baru">Kapasitas:</label>
        <input type="number" id="kapasitas_baru" name="kapasitas_baru" value="<?=$kapasitas_sebelum?>" required>

        <button type="submit">Simpan</button>
    </form>
</body>
</html>
