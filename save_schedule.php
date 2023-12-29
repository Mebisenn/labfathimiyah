<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
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

    // Mengambil data jadwal dari tabel kelas_a
    $sql_a = "SELECT * FROM tbl_jadwal";
    $result_a = $conn->query($sql_a);

    // Menyimpan jadwal ke dalam tabel jadwal di database
    while ($row = $result_a->fetch_assoc()) {
        $mapel = $row['nama_mapel'];
        $hari = $row['nama_guru'];
        $waktu = $row['ruangan'];

        // Menjalankan query UPDATE, menggunakan klausa WHERE untuk mengidentifikasi baris yang akan diperbarui
        $update_sql = "UPDATE tbl_jadwal SET nama_guru = '$hari', ruangan = '$waktu' WHERE nama_mapel = '$mapel'";
        $conn->query($update_sql);
    }

    // Menutup koneksi database
    $conn->close();

    echo "Jadwal telah diperbarui di dalam database.";
} else {
    // Menangani metode request selain GET
    http_response_code(405); // Method Not Allowed
    echo "Metode request tidak diizinkan.";
}
?>
