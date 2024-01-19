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
        <h1>Data Jadwal</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Data Jadwal</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          
          <div class="card">
            <div class="card-body">
                <h5 class="card-title">Datatables</h5>
                <?php
                    $isOperationSuccess = isset($_GET['success']) && $_GET['success'] === 'true';
                    $isDataEdited = isset($_GET['edited']) && $_GET['edited'] === 'true';
                    $isDataDeleted = isset($_GET['deleted']) && $_GET['deleted'] === 'true';
                ?>
                <?php if ($isOperationSuccess): ?>
                    <div class="alert alert-primary alert-dismissible fade show" role="alert">
                        <i class="bi bi-plus-circle me-1"></i>
                        Jadwal Berhasil Ditambahkan!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

                        <script>
                            const url = new URL(window.location.href);
                            url.searchParams.delete('success');
                            window.history.replaceState({}, document.title, url.href);

                            setTimeout(function() {
                                document.querySelector('.alert-primary').style.display = 'none';
                            }, 2000);
                        </script>

                    </div>
                <?php endif; ?>
                <!-- Start Alert Edit -->
                <?php if ($isDataEdited): ?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <i class="bi bi-pencil-square me-1"></i>
                        Jadwal Berhasil Diedit!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

                        <script>
                            const url = new URL(window.location.href);
                            url.searchParams.delete('edited');
                            window.history.replaceState({}, document.title, url.href);

                            setTimeout(function() {
                                document.querySelector('.alert-warning').style.display = 'none';
                            }, 2000);
                        </script>

                    </div>
                <?php endif; ?>
                <!-- End Alert Edit -->
                <!-- Start Alert Deleted -->
                <?php if ($isDataDeleted): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-trash-fill me-1"></i>
                        Jadwal Berhasil Dihapus!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

                        <script>
                            const url = new URL(window.location.href);
                            url.searchParams.delete('deleted');
                            window.history.replaceState({}, document.title, url.href);

                            setTimeout(function() {
                                document.querySelector('.alert-danger').style.display = 'none';
                            }, 2000);
                        </script>
                    </div>
                <?php endif; ?>
                            <!-- End Alert Delete -->  
              <!-- Formulir Generate -->
                <form method="post" action="gacha.php">
                    <button type="submit" class="btn btn-primary">><i class="bi bi-person-fill-add"></i>Generate</button>
                </form><br>
                <!-- Formulir Tambah Data -->
                <p>
                    <a href="tambah.php" type="submit" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#basicModal"><i class="bi bi-person-fill-add"></i>Tambah Data</a>
                    <div class="modal fade" id="basicModal" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Tambah Jadwal</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    apakah kamu ingin menambah data Jadwal?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                                    <a type="button" href="tambah.php" type="button" class="btn btn-primary">Ya</a>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Basic Modal-->
                </p>
              
                        <!-- Tabel Data Jadwal -->
                    <div class="table-responsive">
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
