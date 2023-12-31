<?php include_once('../_header.php'); ?>
<div class="box">
<h1>Obat</h1>
    <h4>
        <small>Edit Data Obat</small>
        <div class="pull-right">
            <a href="data.php" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-chevron-left"></i>Kembali</a>
        </div>
    </h4>
    <div class="row">
        <div class="col-lg-6 col-lg-offset-3">
            <?php
            $id = @$_GET['id'];
            $sql_obat = mysqli_query($con, "SELECT * FROM tb_obat WHERE id_obat = '$id'") or die (mysqli_error($con));
            $data = mysqli_fetch_array($sql_obat);
            ?>
            <form action="proses.php" method="post">
                <div class="form-group">
                    <label for="nama">Nama Obat</label>
                    <input type="hidden" name="id" value="<?=$data['id_obat']?>">
                    <input type="text" name="nama" id="nama" value="<?=$data['nama_obat']?>" class="form-control" required autofocus>
                </div>
                <div class="form-group">
                     <label for="ket">Keterangan</label>
                     <textarea name="ket" id="key" class="form-control" required><?=$data['ket']?></textarea>
                </div>
                <div class="form-group">
                    <label for="jumlah_obat">Jumlah Obat</label>
                    <input type="text" name="jml_obat" id="jml_obat" class="form-control" value="<?=$data['jml_obat']?>" required>
                </div>
                <div class="form-group">
                    <label for="harga_obat">Harga Obat</label>
                    <input type="text" name="hrg_obat" id="hrg_obat" class="form-control" value="<?=$data['hrg_obat']?>" required>
                </div>
                <div class="form-group pull-right">
                    <input type="submit" name="edit" value="simpan" class="btn btn-success">
                </div>
            </form>
        </div>
    </div>
</div>
<?php include_once('../_footer.php'); ?>