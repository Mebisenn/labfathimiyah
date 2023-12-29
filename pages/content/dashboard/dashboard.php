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
    if ($_SESSION['role'] !== 'super admin' && $_SESSION['role'] !== 'admin') {
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
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <h1>Data Lab</h1>

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Datatables</h5>
              <!-- Formulir Generate -->
                <form method="post" action="gacha.php">
                    <button type="submit" class="btn btn-primary">><i class="bi bi-person-fill-add"></i>Generate</button>
                </form><br>
                <!-- Formulir Tambah Data -->
                <form method="get" action="tambah.php">
                    <button type="submit" class="btn btn-primary"><i class="bi bi-person-fill-add"></i>Tambah Data</button>
                </form>
              
                        <!-- Tabel Data Jadwal -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Mapel</th>
                                    <th>Nama Guru</th>
                                    <th>Ruangan</th>
                                    <th>Nama Kelas</th>
                                    <th>Nama Hari</th>
                                    <th>Waktu</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                require '../../../config/db.php';

                                // Menggunakan JOIN untuk menggabungkan informasi dari tbl_hari, tbl_waktu, tbl_mapel, dan tbl_kelas
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
                                    WHERE jadwal.status_deleted = 0
                                ");
                                $no = 1;

                                while ($row = mysqli_fetch_assoc($jadwal)) {
                                ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $row['nama_mapel']; ?></td>
                                        <td><?= $row['nama_guru']; ?></td>
                                        <td><?= $row['no_ruangan']; ?></td>
                                        <td><?= $row['nama_kelas']; ?></td>
                                        <td><?= $row['nama_hari']; ?></td>
                                        <td><?= $row['waktu_mulai'] . " - " . $row['waktu_selesai']; ?></td>
                                        <td>
                                            <!-- Tautan Edit -->
                                            <a href="edit.php?id_jadwal=<?= $row['id_jadwal']; ?>" class="btn btn-warning btn-sm">Edit</a>

                                            <!-- Tautan Hapus -->
                                            <a href="delete.php?id_jadwal=<?= $row['id_jadwal']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus jadwal ini?')">Hapus</a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                            <!-- Contoh formulir untuk memasukkan atau memilih semester -->
                        </table>
                        <form method="post" action="savedata.php">
                            <label for="semester">Periode Semester:</label>
                            <input type="text" name="semester" id="semester" placeholder="Masukkan periode" required>
                            <button type="submit" class="btn btn-success"><i class="bi bi-file-earmark-plus"></i>Simpan</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>
</main><!-- End #main -->

<?php
require_once("{$base_dir}pages{$ds}core{$ds}footer.php");
?>
