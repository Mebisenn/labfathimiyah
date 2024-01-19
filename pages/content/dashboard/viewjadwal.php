<?php
$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__) . $ds . '..' . $ds . '..' . $ds . '..') . $ds;
require_once("{$base_dir}pages{$ds}coreuser{$ds}header.php");
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
                                       
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </section>
</main><!-- End #main -->

<?php
require_once("{$base_dir}pages{$ds}coreuser{$ds}footer.php");
?>
