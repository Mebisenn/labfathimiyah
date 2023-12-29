<?php
  // Mulai sesi jika belum dimulai
  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }

  // // Periksa apakah pengguna sudah login
  // if (!isset($_SESSION['role'])) {
  //   // Jika belum login, redirect ke halaman login
  //   header("Location: ../../../login.php");
  //   exit();
  // }

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