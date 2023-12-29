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

// Query untuk mengambil data dari tabel waktu, hari, dan mapel
$query = "SELECT * FROM tbl_waktu
          JOIN tbl_hari ON tbl_waktu.id_hari_mapel = tbl_hari.id_hari_mapel
          JOIN tbl_mapel ON tbl_hari.id_hari_mapel = tbl_mapel.mapel_id";
$result = $conn->query($query);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tampilan Jadwal</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h2>Tabel Jadwal</h2>
    <table>
        <thead>
            <tr>
                <th>Waktu</th>
                <th>Hari</th>
                <th>Mata Pelajaran</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['jam_mulai'] . " - " . $row['jam_selesai'] . "</td>";
                    echo "<td>" . $row['nama_hari'] . "</td>";
                    echo "<td>" . $row['nama_mapel'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>Tidak ada data</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>

</html>

<?php
// Menutup koneksi database
$conn->close();
?>
