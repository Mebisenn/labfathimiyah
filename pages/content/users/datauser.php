<?php
  // Mulai sesi jika belum dimulai
  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }

  // Periksa apakah pengguna memiliki peran super admin
  if ($_SESSION['role'] !== 'super admin') {
    // Jika bukan super admin, tampilkan pesan atau redirect ke halaman lain
    header("Location: ../../../login.php");
    exit();
  }
  $ds = DIRECTORY_SEPARATOR;
  $base_dir = realpath(dirname(__FILE__)  . $ds . '..' . $ds . '..'  . $ds . '..') . $ds;
  require_once("{$base_dir}pages{$ds}core{$ds}header.php");

?>
  <main id="main" class="main">
    
    <div class="pagetitle">
      <h1>Data Tables</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Tables</li>
          <li class="breadcrumb-item active">Data</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Data Tabel User</h5>
              <p>
              <a href="adduser.php" type="button" class="btn btn-primary"><i class="bi bi-person-fill-add"></i> Add User</a>
              <div class="modal fade" id="basicModal" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title">Basic Modal</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                    <div class="modal-body">
                                                        apakah kamu ingin menambah data mapel?
                                                    </div>
                                                <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                                            <a type="button" href="adduser.php" type="button" class="btn btn-primary">Ya</a>
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
                                    Berhasil Menambahkan User!
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
                                    User Berhasil Diedit!
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
                                    User Berhasil Dihapus!
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

              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Email</th>
                    <th scope="col">Jabatan</th>
                    <th scope="col">No. HP</th>
                    <th scope="col">Role</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  require '../../../config/db.php';
                  $products = mysqli_query($db_connect, "SELECT * FROM tbl_users");
                  $no = 1;
                  while ($row = mysqli_fetch_assoc($products)) {
                  ?>
                      <tr>
                          <td><?= $no++; ?></td>
                          <td><?= $row['nama']; ?></td>
                          <td><?= $row['email']; ?></td>
                          <td><?= $row['jabatan']; ?></td>
                          <td><?= $row['no_hp']; ?></td>
                          <td><?= $row['role']; ?></td>
                          <td>
                              <!-- Tautan Edit -->
                              <a href="edituser.php?id=<?= $row['user_id']; ?>" class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i> Edit</a>
                              
                              <!-- Formulir Hapus -->
                              <form method="POST" action="deleteuser.php">
                                  <input type="hidden" name="user_id" value="<?= $row['user_id']; ?>">
                                  <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')">
                                      <i class="bi bi-trash"></i> Hapus
                                  </button>
                              </form>
                          </td>
                      </tr>
                      <?php
                  }
                  ?>
              </tbody>

              </table>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>
      </div>
    </section>

</main><!-- End #main -->

<?php
  require_once("{$base_dir}pages{$ds}core{$ds}footer.php");
?> 