<?php
require '../../../config/db.php';

if (isset($_GET['id_jadwal'])) {
    $id_jadwal = $_GET['id_jadwal'];
    
    // Ambil detail jadwal berdasarkan ID
    $result = mysqli_query($db_connect, "SELECT * FROM tbl_jadwal WHERE id_jadwal=$id_jadwal");
    $tbl_jadwal = mysqli_fetch_assoc($result);

    // Periksa apakah formulir telah dikirim
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Ambil nilai dari formulir
        $mapel_baru = $_POST['mapel_baru'];
        $guru_baru = $_POST['guru_baru'];
        $ruangan_baru = $_POST['ruangan_baru'];
        $kelas_baru = $_POST['kelas_baru'];
        $hari_baru = $_POST['hari_baru'];
        $waktu_baru = $_POST['waktu_baru'];

        // Validasi bentrokan jadwal
        $checkOverlapQuery = "SELECT COUNT(*) as count FROM tbl_jadwal WHERE
        id_jadwal <> $id_jadwal AND
        ruangan_id = '$ruangan_baru' AND
        hari_id = '$hari_baru' AND
        waktu_id = '$waktu_baru'";

        $overlapResult = mysqli_query($db_connect, $checkOverlapQuery);
        $overlapCount = mysqli_fetch_assoc($overlapResult)['count'];

        // Jika tidak ada bentrokan, lakukan update pada tbl_jadwal
        if ($overlapCount == 0) {
        mysqli_query($db_connect, "UPDATE tbl_jadwal SET mapel_id='$mapel_baru', guru_id='$guru_baru', ruangan_id='$ruangan_baru', kelas_id='$kelas_baru', hari_id='$hari_baru', waktu_id='$waktu_baru' WHERE id_jadwal=$id_jadwal");

        // Alihkan ke halaman utama setelah pengeditan
        header("Location: dashboard.php");
        exit();
        } else {
        echo "Bentrok jadwal terdeteksi. Silakan pilih waktu atau ruangan yang berbeda.";
        }

    }
} else {
    // Alihkan ke halaman utama jika ID tidak disediakan
    header("Location: dashboard.php");
    exit();
}
?>


<!-- ... Form HTML ... -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit jadwal</title>
</head>
<body>
    <h1>Edit jadwal</h1>
    <form method="POST">
        <label for="mapel_baru">Nama Mapel :</label>
        <input type="text" id="mapel_baru" name="mapel_baru" value="<?=$tbl_jadwal['mapel_id']?>" required>
        
        <label for="guru_baru">Nama Guru :</label>
        <input type="text" id="guru_baru" name="guru_baru" value="<?=$tbl_jadwal['guru_id']?>" required>

        <label for="ruangan_baru">Ruangan :</label>
        <input type="text" id="ruangan_baru" name="ruangan_baru" value="<?=$tbl_jadwal['ruangan_id']?>" required>

        <label for="kelas_baru">Nama Kelas :</label>
        <input type="text" id="kelas_baru" name="kelas_baru" value="<?=$tbl_jadwal['kelas_id']?>" required>

        <label for="hari_baru">Nama Hari :</label>
        <input type="text" id="hari_baru" name="hari_baru" value="<?=$tbl_jadwal['hari_id']?>" required>

        <label for="waktu_baru">Waktu :</label>
        <input type="text" id="waktu_baru" name="waktu_baru" value="<?=$tbl_jadwal['waktu_id']?>" required>

        <button type="submit">Simpan</button>
    </form>
</body>
</html>
