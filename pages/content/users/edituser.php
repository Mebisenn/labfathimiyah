<!-- edituser.php -->
<?php
require '../../../config/db.php';

// Inisialisasi variabel
$tbl_users = array();
$jabatan_sebelum = '';

// Periksa apakah ID pengguna disediakan dalam URL
if (isset($_GET['id'])) {
    $user_id = intval($_GET['id']);

    // Ambil detail pengguna berdasarkan ID
    $result = mysqli_query($db_connect, "SELECT * FROM tbl_users WHERE user_id=$user_id");

    // Pengecekan apakah ada hasil dari kueri
    if ($result) {
        // Pengecekan apakah ada data pengguna ditemukan
        if (mysqli_num_rows($result) > 0) {
            $tbl_users = mysqli_fetch_assoc($result);
            // Akses array offset hanya jika variabel terdefinisi dan merupakan array
            $jabatan_sebelum = isset($tbl_users['jabatan']) ? $tbl_users['jabatan'] : '';
        } else {
            // Handle case when no user data is found
            die("User data not found for ID: $user_id");
        }
    } else {
        // Handle case when there is an error in the query
        die("Error fetching user data: " . mysqli_error($db_connect));
    }

    // Periksa apakah formulir telah dikirim
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Perbarui detail pengguna
        $jabatan_baru = $_POST['jabatan_baru'];

        // Lakukan validasi untuk memastikan bahwa $user_id memiliki nilai yang valid
        if (!empty($user_id)) {
            $update_query = "UPDATE tbl_users SET jabatan='$jabatan_baru' WHERE user_id=$user_id";
            if (mysqli_query($db_connect, $update_query)) {
                // Alihkan ke halaman utama setelah pengeditan
                header("Location: datauser.php");
                exit();
            } else {
                // Handle error jika kueri tidak berhasil
                die("Error updating user: " . mysqli_error($db_connect));
            }
        } else {
            die("Invalid user ID: $user_id");
        }
    }
} else {
    // Alihkan ke halaman utama jika ID tidak disediakan
    die("User ID not provided");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
</head>
<body>
    <h1>Edit User</h1>
    <form method="POST">
        <label for="jabatan_baru">Jabatan User:</label>
        <input type="text" id="jabatan_baru" name="jabatan_baru" value="<?=$jabatan_sebelum?>" required>

        <button type="submit">Simpan</button>
    </form>
</body>
</html>
