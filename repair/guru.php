<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari formulir
    $nama_guru = $_POST['nama_guru'];
    $mapel = $_POST['mapel'];
    $hari = $_POST['hari'];
    $waktu = $_POST['waktu'];
    $ruangan = $_POST['ruangan'];

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

    // Mulai transaksi
    $conn->begin_transaction();

    try {
        // Sisipkan data ke tbl_guru
        $insert_guru = "INSERT INTO tbl_guru (nama_guru) VALUES ('$nama_guru')";
        $conn->query($insert_guru);

        // Ambil id_guru yang baru saja dimasukkan
        $id_guru = $conn->insert_id;

        // Sisipkan data ke tbl_jadwal dengan menggunakan id_guru
        $insert_jadwal = "INSERT INTO tbl_jadwal (guru_id, mapel_id, hari_id, waktu_id, ruangan_id) 
                          VALUES ('$id_guru', '$mapel', '$hari', '$waktu', '$ruangan')";
        $conn->query($insert_jadwal);

        // Commit transaksi
        $conn->commit();

        echo "Data berhasil disimpan ke dalam tbl_guru dan tbl_jadwal.";
    } catch (Exception $e) {
        // Rollback transaksi jika terjadi kesalahan
        $conn->rollback();
        echo "Transaksi Gagal: " . $e->getMessage();
    }

    // Menutup koneksi database
    $conn->close();
} else {
    echo "Metode request tidak diizinkan.";
}
?>
