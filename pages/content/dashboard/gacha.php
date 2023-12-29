<?php
require '../../../config/db.php';

function isJadwalBentrok($guru_id, $hari_id, $waktu_id, $db_connect)
{
    $query = "SELECT COUNT(*) as count
              FROM tbl_jadwal
              WHERE guru_id = $guru_id
                AND hari_id = '$hari_id'
                AND waktu_id = $waktu_id";

    $result = mysqli_query($db_connect, $query);
    $count = mysqli_fetch_assoc($result)['count'];

    return $count > 0;
}

function generateRandomDataFromDatabase($db_connect)
{
    // Mendapatkan data guru acak
    $guruQuery = mysqli_query($db_connect, "SELECT guru_id, nama_guru FROM tbl_guru ORDER BY RAND() LIMIT 1");
    $guruData = mysqli_fetch_assoc($guruQuery);
    $guru_id = $guruData['guru_id'];

    // Mendapatkan data mapel acak yang belum diambil oleh guru lain
    $mapelQuery = mysqli_query($db_connect, "
        SELECT m.mapel_id, m.nama_mapel
        FROM tbl_mapel m
        LEFT JOIN tbl_jadwal j ON m.mapel_id = j.mapel_id AND j.guru_id = $guru_id
        WHERE j.guru_id IS NULL
        ORDER BY RAND()
        LIMIT 1
    ");
    $mapelData = mysqli_fetch_assoc($mapelQuery);
    $mapel_id = $mapelData['mapel_id'];

    // Mendapatkan data ruangan, kelas, hari, dan waktu secara acak
    $ruanganQuery = mysqli_query($db_connect, "SELECT no_ruangan FROM tbl_ruangan ORDER BY RAND() LIMIT 1");
    $no_ruangan = mysqli_fetch_assoc($ruanganQuery)['no_ruangan'];

    $kelasQuery = mysqli_query($db_connect, "SELECT nama_kelas FROM tbl_kelas ORDER BY RAND() LIMIT 1");
    $nama_kelas = mysqli_fetch_assoc($kelasQuery)['nama_kelas'];

    $hariQuery = mysqli_query($db_connect, "SELECT nama_hari FROM tbl_hari ORDER BY RAND() LIMIT 1");
    $nama_hari = mysqli_fetch_assoc($hariQuery)['nama_hari'];

    $waktuQuery = mysqli_query($db_connect, "SELECT waktu_id FROM tbl_waktu ORDER BY RAND() LIMIT 1");
    $waktuData = mysqli_fetch_assoc($waktuQuery);
    $waktu_id = $waktuData['waktu_id'];

    $tryCount = 0;
    // Cek apakah jadwal bentrok
    while (isJadwalBentrok($guru_id, $nama_hari, $waktu_id, $db_connect)) {
        // Jika bentrok, ambil data baru
        $ruanganQuery = mysqli_query($db_connect, "SELECT no_ruangan FROM tbl_ruangan ORDER BY RAND() LIMIT 1");
        $no_ruangan = mysqli_fetch_assoc($ruanganQuery)['no_ruangan'];

        $kelasQuery = mysqli_query($db_connect, "SELECT nama_kelas FROM tbl_kelas ORDER BY RAND() LIMIT 1");
        $nama_kelas = mysqli_fetch_assoc($kelasQuery)['nama_kelas'];

        $hariQuery = mysqli_query($db_connect, "SELECT nama_hari FROM tbl_hari ORDER BY RAND() LIMIT 1");
        $nama_hari = mysqli_fetch_assoc($hariQuery)['nama_hari'];

        $waktuQuery = mysqli_query($db_connect, "SELECT waktu_id FROM tbl_waktu ORDER BY RAND() LIMIT 1");
        $waktuData = mysqli_fetch_assoc($waktuQuery);
        $waktu_id = $waktuData['waktu_id'];

        $tryCount++;
        if ($tryCount >= 15) {
            // Handle kondisi di mana tidak dapat menemukan jadwal yang tidak bentrok setelah sejumlah percobaan
            // Misalnya, throw exception atau berikan pesan kesalahan
            break;
        }
    }

    return compact('mapel_id', 'guru_id', 'no_ruangan', 'nama_kelas', 'nama_hari', 'waktu_id');
}

// Mendapatkan data acak dari database
$randomDataArray = array();
for ($i = 0; $i < 10; $i++) {
    $randomDataArray[] = generateRandomDataFromDatabase($db_connect);
}

// ...

// Menyimpan data ke dalam database
foreach ($randomDataArray as $randomData) {
    $sql = "INSERT INTO tbl_jadwal (mapel_id, guru_id, ruangan_id, kelas_id, hari_id, waktu_id)
            SELECT '$randomData[mapel_id]', '$randomData[guru_id]', r.ruangan_id, k.kelas_id, h.hari_id, '$randomData[waktu_id]'
            FROM tbl_ruangan r, tbl_kelas k, tbl_hari h
            WHERE r.no_ruangan = '$randomData[no_ruangan]'
              AND k.nama_kelas = '$randomData[nama_kelas]'
              AND h.nama_hari = '$randomData[nama_hari]'";

    // Eksekusi query
    mysqli_query($db_connect, $sql);
}

// Redirect kembali ke halaman sebelumnya (dashboard)
header("Location: {$_SERVER['HTTP_REFERER']}");
exit();
?>
