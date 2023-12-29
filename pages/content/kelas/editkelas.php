<!-- editkelas.php -->
<?php
require '../../../config/db.php';

// Inisialisasi variabel
$tbl_kelas = array();
$nama_kelas_sebelum = '';

// Periksa apakah ID kelas disediakan dalam URL
if (isset($_GET['id'])) {
    $kelas_id = intval($_GET['id']);

    // Ambil detail kelas berdasarkan ID
    $result = mysqli_query($db_connect, "SELECT * FROM tbl_kelas WHERE kelas_id=$kelas_id");

    // Pengecekan apakah ada hasil dari kueri
    if ($result) {
        // Pengecekan apakah ada data kelas ditemukan
        if (mysqli_num_rows($result) > 0) {
            $tbl_kelas = mysqli_fetch_assoc($result);
            // Akses array offset hanya jika variabel terdefinisi dan merupakan array
            $nama_kelas_sebelum = isset($tbl_kelas['nama_kelas']) ? $tbl_kelas['nama_kelas'] : '';
        } else {
            // Handle case when no kelas data is found
            die("Kelas data not found for ID: $kelas_id");
        }
    } else {
        // Handle case when there is an error in the query
        die("Error fetching kelas data: " . mysqli_error($db_connect));
    }

    // Periksa apakah formulir telah dikirim
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Perbarui detail kelas
        $nama_kelas_baru = $_POST['nama_kelas_baru'];

        // Lakukan validasi untuk memastikan bahwa $kelas_id memiliki nilai yang valid
        if (!empty($kelas_id)) {
            $update_query = "UPDATE tbl_kelas SET nama_kelas='$nama_kelas_baru' WHERE kelas_id=$kelas_id";
            if (mysqli_query($db_connect, $update_query)) {
                // Alihkan ke halaman utama setelah pengeditan
                header("Location: class.php");
                exit();
            } else {
                // Handle error jika kueri tidak berhasil
                die("Error updating kelas: " . mysqli_error($db_connect));
            }
        } else {
            die("Invalid kelas ID: $kelas_id");
        }
    }
} else {
    // Alihkan ke halaman utama jika ID tidak disediakan
    die("Kelas ID not provided");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kelas</title>
</head>
<body>
    <h1>Edit Kelas</h1>
    <form method="POST">
        <label for="nama_kelas_baru">Nama Kelas:</label>
        <input type="text" id="nama_kelas_baru" name="nama_kelas_baru" value="<?=$nama_kelas_sebelum?>" required>

        <button type="submit">Simpan</button>
    </form>
</body>
</html>
