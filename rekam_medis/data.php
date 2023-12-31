<?php include_once('../_header.php'); ?>
<div class="box">
    <h1>Rekam Medis</h1>
    <h4>
        <small>Data Rekam Medis
            <div class="pull-right">
                <a href="" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-refresh"></i></a>
                <a href="add.php" class="btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i>Tambah Rekam Medis</a>
            </div>
    </h4>



    <div id="content">

        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover" id="dokter">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Tanggal Periksa</th>
                        <th>Nama Pasien</th>
                        <th>Keluhan</th>
                        <th>Nama Dokter</th>
                        <th>Diagnosa</th>
                        <th>Poliklinik</th>
                        <th>Data Obat</th>
                        <th><i class="glyphicon glyphicon-cog"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $query = "SELECT * FROM tb_rekammedis
        INNER JOIN tb_pasien ON tb_rekammedis.id_pasien = tb_pasien.id_pasien
        INNER JOIN tb_dokter ON tb_rekammedis.id_dokter = tb_dokter.id_dokter
        INNER JOIN tb_poliklinik ON tb_rekammedis.id_poli = tb_poliklinik.id_poli";
                    $sql_rm = mysqli_query($con, $query) or die(mysqli_error($con));
                    while ($data = mysqli_fetch_array($sql_rm)) { ?>
                        <tr>
                            <td><?= $no++ ?>.</td>
                            <td><?= tgl_indo($data['tgl_periksa']) ?></td>
                            <td><?= $data['nama_pasien'] ?></td>
                            <td><?= $data['keluhan'] ?></td>
                            <td><?= $data['nama_dokter'] ?></td>
                            <td><?= $data['diagnosa'] ?></td>
                            <td><?= $data['nama_poli'] ?></td>
                            <td><?= $data['nama_obat'] ?></td>
                            <td>
                                <?php
                                $sql_obat = mysqli_query($con, "SELECT * FROM tb_rm_obat JOIN tb_obat ON tb_rm_obat.id_obat = tb_obat.id_obat WHERE id_rm = '$data[id_rm]'") or die(mysqli_error($con));
                                while ($data_obat = mysqli_fetch_array($sql_obat)) {
                                    echo $data_obat['nama_obat'] . "<br>";
                                } ?>
                            </td>
                            <td>
                            <a href="edit.php?id_rm=<?= $data['id_rm'] ?>" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-edit"></i></a>
                                <button class="print-btn" data-record-id="<?= $data['id_rm'] ?>" data-patient-id="<?= $data['id_pasien'] ?>">Print</button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var printButtons = document.querySelectorAll('.print-btn');

        printButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                var recordId = this.getAttribute('data-record-id');
                var patientId = this.getAttribute('data-patient-id');
                printRecord(recordId, patientId);
            });
        });
    });

    function printRecord(recordId, patientId) {
        var printWindow = window.open('print.php?id=' + recordId + '&patient=' + patientId, '_blank');
        printWindow.onload = function() {
            printWindow.print();
        };
    }
</script>






<?php include_once('../_footer.php'); ?>