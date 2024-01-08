<?php
// simpan.php

require '../../../config/db.php';

// Ambil nilai semester dari formulir (pastikan ada validasi dan pembersihan data yang memadai)
$semester_sekarang = $_POST['semester']; // Sesuaikan dengan nama input di formulir

// Mulai transaksi
mysqli_autocommit($db_connect, false);

// Ambil data jadwal dari tabel tbl_jadwal
$jadwal = mysqli_query($db_connect, "
    SELECT 
        jadwal.id_jadwal,
        mapel.nama_mapel,
        guru.nama_guru,
        ruangan.no_ruangan,
        kelas.nama_kelas,
        hari.nama_hari,
        waktu.waktu_mulai,
        waktu.waktu_selesai
        FROM tbl_jadwal jadwal
        JOIN tbl_hari hari ON jadwal.hari_id = hari.hari_id
        JOIN tbl_waktu waktu ON jadwal.waktu_id = waktu.waktu_id
        JOIN tbl_mapel mapel ON jadwal.mapel_id = mapel.mapel_id
        JOIN tbl_kelas kelas ON jadwal.kelas_id = kelas.kelas_id
        JOIN tbl_guru guru ON jadwal.guru_id = guru.guru_id
        JOIN tbl_ruangan ruangan ON jadwal.ruangan_id = ruangan.ruangan_id
");

// Ambil tahun saat ini (misalnya, tahun 2023)
$tahun_sekarang = date('Y');

while ($row = mysqli_fetch_assoc($jadwal)) {
    // Cek apakah data sudah ada untuk periode dan jadwal yang sama
    $check_query = mysqli_query($db_connect, "
        SELECT id_periode
        FROM tbl_periode
        WHERE id_periode = '{$row['id_jadwal']}' AND tahun = '$tahun_sekarang' AND semester = '$semester_sekarang'
    ");

    if (mysqli_num_rows($check_query) == 0) {
        // Jika belum ada, lakukan INSERT
        $insert_query = mysqli_query($db_connect, "
            INSERT INTO tbl_periode (nama_mapel, nama_hari, nama_guru, nama_kelas, no_ruangan, waktu_mulai, waktu_selesai, tahun, semester)
            VALUES (
 
                '{$row['nama_mapel']}', 
                '{$row['nama_hari']}', 
                '{$row['nama_guru']}', 
                '{$row['nama_kelas']}', 
                '{$row['no_ruangan']}', 
                '{$row['waktu_mulai']}', 
                '{$row['waktu_selesai']}', 
                '$tahun_sekarang', 
                '$semester_sekarang'
            )
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
