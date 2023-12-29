<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="proses_tambah_data.php" method="post">
    <label for="jam_mulai">Jam Mulai:</label>
    <input type="text" name="jam_mulai" required>

    <label for="jam_selesai">Jam Selesai:</label>
    <input type="text" name="jam_selesai" required>

    <label for="nama_hari">Nama Hari:</label>
    <input type="text" name="nama_hari" required>

    <label for="nama_mapel">Nama Mata Pelajaran:</label>
    <input type="text" name="nama_mapel" required>

    <button type="submit">Tambah Data</button>
</form>

</body>
</html>