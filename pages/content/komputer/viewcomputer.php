<?php
$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__) . $ds . '..' . $ds . '..' . $ds . '..') . $ds;
require_once("{$base_dir}pages{$ds}coreuser{$ds}header.php");
?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Data Komputer</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Data Komputer</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Datatables</h5>
                       
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Komputer</th>
                                    <th>Spesifikasi</th>
                                    <th>Status</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                require '../../../config/db.php';

                                $komputer = mysqli_query($db_connect, "SELECT * FROM tbl_komputer");
                                $no = 1;

                                while ($row = mysqli_fetch_assoc($komputer)) {
                                ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $row['nama_komputer']; ?></td>
                                        <td><?= $row['spesifikasi_komputer']; ?></td>
                                        <td><?= $row['status_komputer']; ?></td>
                                       
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
