<?php include_once('../_header.php'); ?>
<h1>Rekam Medis</h1>
<h4>
    <small>Edit Data Rekam Medis</small>
    <div class="pull-right">
        <a href="data.php" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-chevron-left"></i>Kembali</a>
    </div>
</h4>
<div class="row">
    <div class="col-lg-6 col-lg-offset-3">
        <?php
        // Mendapatkan ID dari URL
        $id_rm = @$_GET['id_rm'];

        // Query untuk mendapatkan informasi pasien dengan ID tertentu
        $sql_rm = mysqli_query($con, "SELECT * FROM tb_rekammedis WHERE id_rm = '$id_rm'") or die(mysqli_error($con));

        // Memeriksa apakah data ditemukan
        if ($data_rm = mysqli_fetch_array($sql_rm)) {
        ?>
            <form action="proses.php" method="post">
                <div class="form-group">
                    <label for="nama">Pasien</label>
                    <input type="hidden" name="id_rm" value="<?= $data_rm['id_rm'] ?>">
                    <input type="text" name="nama_pasien" id="nama_pasien" value="<?= $data_rm['nama_pasien'] ?>" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label for="keluhan">Keluhan</label>
                    <input type="text" name="keluhan" id="keluhan" value="<?= $data_rm['keluhan'] ?>" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="nama_dokter">Nama Dokter</label>
                    <input type="text" name="nama_dokter" id="nama_dokter" value="<?= $data_rm['nama_dokter'] ?>" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label for="diagnosa">Diagnosa</label>
                    <input type="text" name="diagnosa" id="diagnosa" value="<?= $data_rm['diagnosa'] ?>" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="nama_poli">Poliklinik</label>
                    <input type="text" name="nama_poli" id="nama_poli" value="<?= $data_rm['nama_poli'] ?>" class="form-control" readonly>
                </div>
                <div class="form-group">
    <label for="nama_obat">Nama Obat</label>
    <select name="obat" id="nama_obat" class="form-control">
        <option value="">- Pilih Obat -</option>
        <?php
        $sql_obat = mysqli_query($con, "SELECT * FROM tb_obat") or die(mysqli_error($con));
        while ($data_obat = mysqli_fetch_array($sql_obat)) {
            $selected = ($data_obat['id_obat'] == $data_rm['id_obat']) ? 'selected' : '';
            echo '<option value="' . $data_obat['id_obat'] . '" ' . $selected . '>' . $data_obat['nama_obat'] . '</option>';
        }
        ?>
    </select>
</div>

                <div class="form-group">
                    <label for="tgl">Tanggal Periksa</label>
                    <input type="date" name="tgl" id="tgl" value="<? date('Y-m-d') ?>" class="form-control" required>
                </div>

                <div class="form-group pull-right">
                    <input type="submit" name="edit" value="Simpan" class="btn btn-success">

                </div>
            </form>
        <?php
        } else {
            echo "Data tidak ditemukan";
        }
        ?>
    </div>
</div>
<?php include_once('../_footer.php'); ?>