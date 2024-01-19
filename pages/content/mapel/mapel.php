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
        <h1>Data Mapel</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Data Mapel</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Datatables</h5>
                        <p>
                        <a href="addmapel.php" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#basicModal"><i class="bi bi-person-fill-add"></i> Add Mapel</a>
                        <div class="modal fade" id="basicModal" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title">Tambah  Data Mapel</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                    <div class="modal-body">
                                                        apakah kamu ingin menambah data mapel?
                                                    </div>
                                                <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                                            <a type="button" href="addmapel.php" type="button" class="btn btn-primary">Ya</a>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- End Basic Modal-->
                            <?php
                                $isOperationSuccess = isset($_GET['success']) && $_GET['success'] === 'true';
                                $isDataEdited = isset($_GET['edited']) && $_GET['edited'] === 'true';
                                $isDataDeleted = isset($_GET['deleted']) && $_GET['deleted'] === 'true';
                            ?>
                            <?php if ($isOperationSuccess): ?>
                                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                    <i class="bi bi-plus-circle me-1"></i>
                                    Berhasil Menambahkan Mapel!
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
                                    Mapel Berhasil Diedit!
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
                                    Mapel Berhasil Dihapus!
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
                        </p>
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Mapel</th>
                                    <th>Action</th> <!-- Kolom tambahan untuk aksi -->
                                </tr>
                            </thead>
                            <tbody>
                                <!-- data_mapel.php -->
                                <?php
                                require '../../../config/db.php';
                                $mapels = mysqli_query($db_connect, "SELECT * FROM tbl_mapel WHERE status_deleted = 0");

                                $no = 1;
                                while ($row = mysqli_fetch_assoc($mapels)) {
                                    ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $row['nama_mapel']; ?></td>
                                        <td>
                                            <div style="display: inline-block;">
                                                <!-- Tautan Edit -->
                                                <a href="edit_mapel.php?id=<?= $row['mapel_id']; ?>" class="btn btn-warning btn-sm">Edit</a>

                                                <a href="delete_mapel.php?id=<?=$row['mapel_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus jadwal ini?')">Hapus</a>
                                                <!-- Formulir Hapus -->
                                                <!-- <form method="POST" action="delete_mapel.php">
                                                    <input type="hidden" name="mapel_id" value="<?= $row['mapel_id']; ?>">
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus mata pelajaran ini?')">
                                                        Hapus
                                                    </button>
                                                </form> -->
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </section>

  </main><!-- End #main -->


  <?php
  require_once("{$base_dir}pages{$ds}core{$ds}footer.php");
?>