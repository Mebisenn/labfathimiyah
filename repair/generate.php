<?php
// Konfigurasi koneksi database
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "jadwal_db";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Mengambil data jadwal dari database
$sql = "SELECT * FROM tbl_jadwal";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Mengambil data dan menyimpannya dalam array
    $schedule = array();
    while ($row = $result->fetch_assoc()) {
        $schedule[] = $row;
    }

    // Mengacak jadwal
    shuffle($schedule);

    // Menyimpan jadwal ke dalam tabel jadwal di database
    // foreach ($schedule as $item) {
    //     $mapel = $item['nama_mapel'];
    //     $hari = $item['nama_guru'];
    //     $waktu = $item['ruangan'];

    //     // Menyisipkan data ke dalam tabel jadwal
    //     $insert_sql = "INSERT INTO tbl_jadwal (nama_mapel, nama_guru, ruangan) VALUES ('$mapel', '$hari', '$waktu')";
    //     $conn->query($insert_sql);
    // }

    // Menampilkan jadwal yang diacak
    foreach ($schedule as $item) {
        echo "{$item['nama_mapel']}, {$item['nama_guru']}: {$item['ruangan']}<br>";
    }
} else {
    echo "Tidak ada jadwal tersedia.";
}

// Menutup koneksi database
$conn->close();
?>
