<?php
$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__) . $ds . '..' . $ds . '..' . $ds . '..') . $ds;
require_once("{$base_dir}pages{$ds}coreuser{$ds}header.php");
?>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>History</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">History</li>
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
                                    <th>Periode</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                require '../../../config/db.php';

                                $periode_jadwal = mysqli_query($db_connect, "SELECT * FROM tbl_periode");

                            $no = 1;
                            
                            while ($row = mysqli_fetch_assoc($periode_jadwal)) {
                                ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $row['nama_mapel']; ?></td>
                                    <td><?= $row['nama_guru']; ?></td>
                                    <td><?= $row['no_ruangan']; ?></td>
                                    <td><?= $row['nama_kelas']; ?></td>
                                    <td><?= $row['nama_hari']; ?></td>
                                    <td><?= $row['waktu_mulai'] . " - " . $row['waktu_selesai']; ?></td>
                                    <td><?= $row['semester']; ?></td>
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
