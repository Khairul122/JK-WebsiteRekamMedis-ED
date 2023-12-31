<?php include_once('../_header.php'); ?>

<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <?php
            $recordId = isset($_GET['id']) ? $_GET['id'] : null;
            $patientId = isset($_GET['patient']) ? $_GET['patient'] : null;
            if ($recordId !== null && $patientId !== null) {

                $query = "SELECT * FROM tb_rekammedis
                          INNER JOIN tb_pasien ON tb_rekammedis.id_pasien = tb_pasien.id_pasien
                          INNER JOIN tb_dokter ON tb_rekammedis.id_dokter = tb_dokter.id_dokter
                          INNER JOIN tb_poliklinik ON tb_rekammedis.id_poli = tb_poliklinik.id_poli
                          WHERE tb_rekammedis.id_rm = '$recordId' AND tb_pasien.id_pasien = '$patientId'";

                $result = mysqli_query($con, $query);

                if (!$result) {
                    die("Query error: " . mysqli_error($con));
                }

                if (mysqli_num_rows($result) > 0) {

                    $data = mysqli_fetch_array($result);
            ?>
                    <div class="card">
                        <div class="card-header">
                        <h3 class="card-title text-center">RUMAH SAKIT UMUM SAYANG BUNDA</h3>

                            <hr>
                        </div>
                        <div class="card-body">
                            <p>Tanggal      : <?php echo $data['tgl_periksa']; ?></p>
                            <p>Nama Pasien  : <?php echo $data['nama_pasien']; ?></p>
                            <p>Keluhan      : <?php echo $data['keluhan']; ?></p>
                            <p>Nama Dokter  : <?php echo $data['nama_dokter']; ?></p>
                            <p>Diagnosa     : <?php echo $data['diagnosa']; ?></p>
                            <p>Poliklinik   : <?php echo $data['nama_poli']; ?></p>
                            <p>Obat         : <?php echo $data['nama_obat']; ?></p>
                        </div>
                    </div>
            <?php
                } else {
                    echo "<p class='alert alert-danger'>Data rekam medis tidak ditemukan.</p>";
                }
            } else {
                echo "<p class='alert alert-danger'>ID Rekam Medis atau ID Pasien tidak valid.</p>";
            }
            ?>
        </div>
    </div>
</div>

<?php include_once('../_footer.php'); ?>
