<?php include_once('../_header.php'); ?>
<div class="box">
    <h1>Pasien</h1>
    <h4>
        <small>Tambah Data Pasien</small>
        <div class="pull-right">
            <a href="data.php" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-chevron-left"></i>Kembali</a>
        </div>
    </h4>
    <div class="row">
        <div class="col-lg-6 col-lg-offset-3">
            <form action="proses.php" method="post">
                <div class="form-group">
                    <label for="identitas">Nomor Identitas</label>
                    <input type="number" name="identitas" id="identitas" class="form-control" required autofocus>
                </div>
                <div class="form-group">
                    <label for="nama">Nama Pasien</label>
                    <input type="text" name="nama" id="nama" class="form-control">
                </div>
                <div class="form-group">
                    <label for="jk">Jenis Kelamin</label>
                    <div>
                        <label class="radio-inline">
                            <input type="radio" name="jk" id="jk" value="L" required>Laki-laki
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="jk" value="P">Perempuan
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <textarea name="alamat" id="alamat" class="form-control" required></textarea>
                </div>
                <div class="form-group">
                    <label for="telp">No Telepon</label>
                    <input type="number" name="telp" id="telp" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="telp">Lama Nginap</label>
                    <input type="number" name="lama_nginap" id="lama_nginap" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="">- Pilih -</option>
                        <option value="BPJS">BPJS</option>
                        <option value="Mandiri">Mandiri</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="telp">Biaya</label>
                    <input type="number" name="biaya" id="biaya" class="form-control" required>
                </div>
                <div class="form-group pull-right">
                    <input type="submit" name="add" value="Simpan" class="btn btn-success">
                </div>
                <script>
                    // Function to calculate and update the Biaya field
                    function updateBiaya() {
                        // Get the selected status and lama_nginap value
                        var status = document.getElementById('status').value;
                        var lama_nginap = document.getElementById('lama_nginap').value;

                        // Get the Biaya input element
                        var biayaInput = document.getElementById('biaya');

                        // Calculate the biaya based on the status
                        if (status === 'BPJS') {
                            // If status is BPJS, set the Biaya to 0
                            biayaInput.value = 0;
                        } else if (status === 'Mandiri') {
                            // If status is Mandiri, calculate the Biaya
                            biayaInput.value = 100000 * lama_nginap;
                        } else {
                            // For other status, set Biaya to 0 (or handle accordingly)
                            biayaInput.value = 0;
                        }
                    }

                    // Attach the updateBiaya function to the change event of the Status and Lama Nginap fields
                    document.getElementById('status').addEventListener('change', updateBiaya);
                    document.getElementById('lama_nginap').addEventListener('input', updateBiaya);
                </script>
            </form>
        </div>
    </div>
</div>
<?php include_once('../_footer.php'); ?>