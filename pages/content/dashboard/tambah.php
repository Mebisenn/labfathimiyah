<?php
    // Mulai sesi jika belum dimulai
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    // Periksa apakah pengguna sudah login
    if (!isset($_SESSION['role'])) {
        // Jika belum login, redirect ke halaman login
        header("Location: ../../../login.php");
        exit();
    }

    // Periksa apakah pengguna memiliki peran super admin atau admin
    if ($_SESSION['role'] !== 'admin') {
        // Jika bukan super admin atau admin, tampilkan pesan atau redirect ke halaman lain
        header("Location: ../../../login.php");
        exit();
    }

    $ds = DIRECTORY_SEPARATOR;
    $base_dir = realpath(dirname(__FILE__) . $ds . '..' . $ds . '..' . $ds . '..') . $ds;
    require_once("{$base_dir}pages{$ds}core{$ds}header.php");
?>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Tambah Data Jadwal</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Data Jadwal</a></li>
                <li class="breadcrumb-item active">Tambah Data Jadwal</li>
            </ol>
        </nav>
    </div>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Tambah Data Jadwal</h5>

            <form method="post" action="tambah.php">
                <div class="row mb-3">
                    <label for="tambah_guru" class="col-sm-2 col-form-label">Guru:</label>
                    <div class="col-sm-10">
                        <select id="tambah_guru" name="tambah_guru" required>
                            <?php
                            require '../../../config/db.php';
                            // Ambil data dari tabel tbl_guru
                            $guruQuery = "SELECT * FROM tbl_guru";
                            $guruResult = mysqli_query($db_connect, $guruQuery);

                            while ($row = mysqli_fetch_assoc($guruResult)) {
                                echo "<option value='{$row['guru_id']}'>{$row['nama_guru']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="tambah_hari" class="col-sm-2 col-form-label">Hari:</label>
                    <div class="col-sm-10">
                        <select id="tambah_hari" name="tambah_hari" required>
                            <?php
                            // Ambil data dari tabel tbl_hari
                            $hariQuery = "SELECT * FROM tbl_hari";
                            $hariResult = mysqli_query($db_connect, $hariQuery);

                            while ($row = mysqli_fetch_assoc($hariResult)) {
                                echo "<option value='{$row['hari_id']}'>{$row['nama_hari']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="tambah_ruangan" class="col-sm-2 col-form-label">Ruangan:</label>
                    <div class="col-sm-10">
                        <select id="tambah_ruangan" name="tambah_ruangan" required>
                            <?php
                            // Ambil data dari tabel tbl_ruangan
                            $ruanganQuery = "SELECT * FROM tbl_ruangan";
                            $ruanganResult = mysqli_query($db_connect, $ruanganQuery);

                            while ($row = mysqli_fetch_assoc($ruanganResult)) {
                                echo "<option value='{$row['ruangan_id']}'>{$row['no_ruangan']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="tambah_kelas" class="col-sm-2 col-form-label">Kelas:</label>
                    <div class="col-sm-10">
                        <select id="tambah_kelas" name="tambah_kelas" required>
                            <?php
                            // Ambil data dari tabel tbl_kelas
                            $kelasQuery = "SELECT * FROM tbl_kelas";
                            $kelasResult = mysqli_query($db_connect, $kelasQuery);

                            while ($row = mysqli_fetch_assoc($kelasResult)) {
                                echo "<option value='{$row['kelas_id']}'>{$row['nama_kelas']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="tambah_mapel" class="col-sm-2 col-form-label">Mapel:</label>
                    <div class="col-sm-10">
                        <select id="tambah_mapel" name="tambah_mapel" required>
                            <?php
                            // Ambil data dari tabel tbl_mapel
                            $mapelQuery = "SELECT * FROM tbl_mapel";
                            $mapelResult = mysqli_query($db_connect, $mapelQuery);

                            while ($row = mysqli_fetch_assoc($mapelResult)) {
                                echo "<option value='{$row['mapel_id']}'>{$row['nama_mapel']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="tambah_waktu" class="col-sm-2 col-form-label">Waktu:</label>
                    <div class="col-sm-10">
                        <select id="tambah_waktu" name="tambah_waktu" required>
                            <?php
                            // Ambil data dari tabel tbl_waktu
                            $waktuQuery = "SELECT * FROM tbl_waktu";
                            $waktuResult = mysqli_query($db_connect, $waktuQuery);

                            while ($row = mysqli_fetch_assoc($waktuResult)) {
                                echo "<option value='{$row['waktu_id']}'>{$row['waktu_mulai']}-{$row['waktu_selesai']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Tambah</button>
                        <a href="dashboard.php">Kembali</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php
    require '../../../config/db.php';

    // Check if the form is submitted
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nama_mapel = $_POST['tambah_mapel'];
        $nama_guru = $_POST['tambah_guru'];
        $ruangan = $_POST['tambah_ruangan'];
        $nama_kelas = $_POST['tambah_kelas'];
        $nama_hari = $_POST['tambah_hari'];
        $waktu = $_POST['tambah_waktu'];

        // Validasi untuk memeriksa apakah jadwal dengan parameter yang sama sudah ada
        $checkOverlapQuery = "SELECT COUNT(*) as count FROM tbl_jadwal WHERE
            ruangan_id = '$ruangan' AND
            hari_id = '$nama_hari' AND
            waktu_id = '$waktu'";

        $overlapResult = mysqli_query($db_connect, $checkOverlapQuery);
        $overlapCount = mysqli_fetch_assoc($overlapResult)['count'];

        // Jika tidak ada bentrok, lakukan penambahan data
        if ($overlapCount == 0) {
            $insert_query = "INSERT INTO tbl_jadwal (mapel_id, guru_id, ruangan_id, kelas_id, hari_id, waktu_id) VALUES ('$nama_mapel', '$nama_guru', '$ruangan', '$nama_kelas', '$nama_hari', '$waktu')";

            // Execute the insertion query
            $result = mysqli_query($db_connect, $insert_query);

            // Check if the insertion was successful
            if ($result) {
                echo "Data jadwal berhasil ditambahkan.";
            } else {
                echo "Error: " . mysqli_error($db_connect);
            }
        } else {
            echo "Bentrok jadwal terdeteksi. Silakan pilih waktu atau ruangan yang berbeda.";
        }
    }
?>

</main><!-- End #main -->

<?php
require_once("{$base_dir}pages{$ds}core{$ds}footer.php");
?>

