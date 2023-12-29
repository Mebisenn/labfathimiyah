<!-- editguru.php -->
<?php
require '../../../config/db.php';

// Inisialisasi variabel
$tbl_guru = array();
$nama_guru_sebelum = '';

// Periksa apakah ID guru disediakan dalam URL
if (isset($_GET['id'])) {
    $guru_id = intval($_GET['id']);

    // Ambil detail guru berdasarkan ID
    $result = mysqli_query($db_connect, "SELECT * FROM tbl_guru WHERE guru_id=$guru_id");

    // Pengecekan apakah ada hasil dari kueri
    if ($result) {
        // Pengecekan apakah ada data guru ditemukan
        if (mysqli_num_rows($result) > 0) {
            $tbl_guru = mysqli_fetch_assoc($result);
            // Akses array offset hanya jika variabel terdefinisi dan merupakan array
            $nama_guru_sebelum = isset($tbl_guru['nama_guru']) ? $tbl_guru['nama_guru'] : '';
        } else {
            // Handle case when no guru data is found
            die("Guru data not found for ID: $guru_id");
        }
    } else {
        // Handle case when there is an error in the query
        die("Error fetching guru data: " . mysqli_error($db_connect));
    }

    // Periksa apakah formulir telah dikirim
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Perbarui detail guru
        $nama_guru_baru = $_POST['nama_guru_baru'];

        // Lakukan validasi untuk memastikan bahwa $guru_id memiliki nilai yang valid
        if (!empty($guru_id)) {
            $update_query = "UPDATE tbl_guru SET nama_guru='$nama_guru_baru' WHERE guru_id=$guru_id";
            if (mysqli_query($db_connect, $update_query)) {
                // Alihkan ke halaman utama setelah pengeditan
                header("Location: guru.php");
                exit();
            } else {
                // Handle error jika kueri tidak berhasil
                die("Error updating guru: " . mysqli_error($db_connect));
            }
        } else {
            die("Invalid guru ID: $guru_id");
        }
    }
} else {
    // Alihkan ke halaman utama jika ID tidak disediakan
    die("Guru ID not provided");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Guru</title>
</head>
<body>
    <h1>Edit Guru</h1>
    <form method="POST">
        <label for="nama_guru_baru">Nama Guru:</label>
        <input type="text" id="nama_guru_baru" name="nama_guru_baru" value="<?=$nama_guru_sebelum?>" required>

        <button type="submit">Simpan</button>
    </form>
</body>
</html>
