<!-- edit_mapel.php -->
<?php
require '../../../config/db.php';

// Inisialisasi variabel
$tbl_mapel = array();
$nama_mapel_sebelum = '';

// Periksa apakah ID mapel disediakan dalam URL
if (isset($_GET['id'])) {
    $mapel_id = intval($_GET['id']);

    // Ambil detail mapel berdasarkan ID
    $result = mysqli_query($db_connect, "SELECT * FROM tbl_mapel WHERE mapel_id=$mapel_id");

    // Pengecekan apakah ada hasil dari kueri
    if ($result) {
        // Pengecekan apakah ada data mapel ditemukan
        if (mysqli_num_rows($result) > 0) {
            $tbl_mapel = mysqli_fetch_assoc($result);
            // Akses array offset hanya jika variabel terdefinisi dan merupakan array
            $nama_mapel_sebelum = isset($tbl_mapel['nama_mapel']) ? $tbl_mapel['nama_mapel'] : '';
        } else {
            // Handle case when no mapel data is found
            die("Mapel data not found for ID: $mapel_id");
        }
    } else {
        // Handle case when there is an error in the query
        die("Error fetching mapel data: " . mysqli_error($db_connect));
    }

    // Periksa apakah formulir telah dikirim
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Perbarui detail mapel
        $nama_mapel_baru = $_POST['nama_mapel_baru'];

        // Lakukan validasi untuk memastikan bahwa $mapel_id memiliki nilai yang valid
        if (!empty($mapel_id)) {
            $update_query = "UPDATE tbl_mapel SET nama_mapel='$nama_mapel_baru' WHERE mapel_id=$mapel_id";
            if (mysqli_query($db_connect, $update_query)) {
                // Alihkan ke halaman utama setelah pengeditan
                header("Location: mapel.php");
                exit();
            } else {
                // Handle error jika kueri tidak berhasil
                die("Error updating mapel: " . mysqli_error($db_connect));
            }
        } else {
            die("Invalid mapel ID: $mapel_id");
        }
    }
} else {
    // Alihkan ke halaman utama jika ID tidak disediakan
    die("Mapel ID not provided");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Mata Pelajaran</title>
</head>
<body>
    <h1>Edit Mata Pelajaran</h1>
    <form method="POST">
        <label for="nama_mapel_baru">Nama Mata Pelajaran:</label>
        <input type="text" id="nama_mapel_baru" name="nama_mapel_baru" value="<?=$nama_mapel_sebelum?>" required>

        <button type="submit">Simpan</button>
    </form>
</body>
</html>
