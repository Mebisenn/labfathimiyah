<?php
session_start();
require_once("../../../config/db.php");

// Pastikan pengguna sudah login
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $password = $_POST['password'];
    $password_baru = $_POST['password_baru'];
    $ulang_password_baru = $_POST['ulang_password_baru'];

    // Pastikan kata sandi baru dan konfirmasi kata sandi baru sesuai
    if ($password_baru !== $ulang_password_baru) {
        echo "Kata sandi baru dan konfirmasi kata sandi tidak cocok.";
        exit();
    }

    // Ambil data pengguna dari sesi
    $email = $_SESSION['email'];
    $user = mysqli_query($db_connect, "SELECT * FROM tbl_users WHERE email = '$email'");

    if (mysqli_num_rows($user) > 0) {
        $data = mysqli_fetch_assoc($user);

        // Periksa kecocokan kata sandi saat ini
        if (password_verify($password, $data['password'])) {
            // Ganti kata sandi dalam basis data
            $hashedNewPassword = password_hash($password_baru, PASSWORD_DEFAULT);
            $updateQuery = "UPDATE tbl_users SET password='$hashedNewPassword' WHERE email='$email'";

            if (mysqli_query($db_connect, $updateQuery)) {
                echo "Kata sandi berhasil diperbarui.";
                header("Location: profile.php?success=true");
        exit();
            } else {
                echo "Error updating password: " . mysqli_error($db_connect);
            }
        } else {
            echo "Kata sandi saat ini salah.";
        }
    } else {
        echo "Pengguna tidak ditemukan.";
    }
}

// Tutup koneksi database
mysqli_close($db_connect);
?>
