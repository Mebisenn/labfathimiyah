<?php
// simpan.php

require '../../../config/db.php';

// Ambil nilai semester dari formulir (pastikan ada validasi dan pembersihan data yang memadai)
$semester_sekarang = $_POST['semester']; // Sesuaikan dengan nama input di formulir

// Mulai transaksi
mysqli_autocommit($db_connect, false);

// Ambil data jadwal dari tabel tbl_jadwal
$jadwal = mysqli_query($db_connect, "
    SELECT id_jadwal, mapel_id, guru_id, ruangan_id, kelas_id, hari_id, waktu_id
    FROM tbl_jadwal
");

// Ambil tahun saat ini (misalnya, tahun 2023)
$tahun_sekarang = date('Y');

while ($row = mysqli_fetch_assoc($jadwal)) {
    // Cek apakah data sudah ada untuk periode dan jadwal yang sama
    $check_query = mysqli_query($db_connect, "
        SELECT id_periode
        FROM tbl_periode
        WHERE id_jadwal = '{$row['id_jadwal']}' AND tahun = '$tahun_sekarang' AND semester = '$semester_sekarang'
    ");

    if (mysqli_num_rows($check_query) == 0) {
        // Jika belum ada, lakukan INSERT
        $insert_query = mysqli_query($db_connect, "
            INSERT INTO tbl_periode (id_jadwal, tahun, semester)
            VALUES ('{$row['id_jadwal']}', '$tahun_sekarang', '$semester_sekarang')
        ");

        // Hentikan loop jika ada kesalahan
        if (!$insert_query) {
            mysqli_rollback($db_connect);
            echo "Terjadi kesalahan saat menyimpan data di tbl_periode.";
            exit();
        }
        
    }
}

// Commit transaksi jika berhasil
mysqli_commit($db_connect);

// Hidupkan kembali otomatis commit
mysqli_autocommit($db_connect, true);

// Redirect kembali ke halaman sebelumnya atau halaman tertentu
header("Location: ".$_SERVER['HTTP_REFERER']);
exit();
?>
