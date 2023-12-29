<?php
// Pastikan bahwa skrip ini dipanggil setelah pengguna masuk dan sesi dimulai
session_start();

// Memeriksa apakah pengguna masuk atau tidak
if (!isset($_SESSION['email'])) {
    // Jika tidak, mungkin alihkan ke halaman login atau lakukan sesuatu yang sesuai
    header("Location: login.php");
    exit();
}

require '../../../config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari formulir
    $newFullName = $_POST['fullName'];
    $newAbout = $_POST['about'];
    $newCompany = $_POST['company'];

    // Memperbarui data profil pengguna di basis data
    $email = $_SESSION['email'];

    $updateQuery = "UPDATE tbl_users SET nama='$newFullName', alamat='$newAbout', no_hp='$newCompany' WHERE email='$email'";

    if (mysqli_query($db_connect, $updateQuery)) {
        // Jika pembaruan berhasil, perbarui juga sesi
        $_SESSION['nama'] = $newFullName;
        $_SESSION['alamat'] = $newAbout;
        $_SESSION['no_hp'] = $newCompany;

        echo "Data profil berhasil diperbarui";
        header("Location: profile.php");
        exit();
    } else {
        echo "Error updating profile: " . mysqli_error($db_connect);
        header("Location: profile.php");
        exit();
    }
}

// Tutup koneksi database
mysqli_close($db_connect);
?>
