<?php include_once('../_header.php'); ?>
<div class="box">
    <h1>Pasien</h1>
    <h4>
        <small>Data Pasien</small>
        <div class="pull-right">
            <a href="" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-refresh"></i></a>
            <a href="add.php" class="btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i>Tambah Pasien</a>
            <a href="import.php" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-plus"></i>Import Pasien</a>
        </div>
    </h4>
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover" id="pasien">
            <thead>
                <tr>
                    <th>Nomor Identitas</th>
                    <th>Nama Pasien</th>
                    <th>Jenis Kelamin</th>
                    <th>Alamat</th>
                    <th>No. Telepon</th>
                    <th>Lama Nginap</th>
                    <th>Status</th>
                    <th>Biaya</th>
                    <th><i class="glyphicon glyphicon-cog"></i></th>
                </tr>
            </thead>
        
        <tbody>
            <?php
            $no = 1;
            $sql_poli = mysqli_query($con, "SELECT * FROM tb_pasien") or die(mysqli_error($con));

            while ($data = mysqli_fetch_array($sql_poli)) { ?>
                <tr>
                    <td><?= $data['nomor_identitas'] ?></td>
                    <td><?= $data['nama_pasien'] ?></td>
                    <td><?= $data['jenis_kelamin'] ?></td>
                    <td><?= $data['alamat'] ?></td>
                    <td><?= $data['no_telp'] ?></td>
                    <td><?= $data['lama_nginap'] ?></td>
                    <td><?= $data['status'] ?></td>
                    <td><?= $data['biaya'] ?></td>
                 

                    <td align="center">
                        <a href="edit.php?id=<?= $data['id_pasien'] ?>" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-edit"></i></a>
                        <!-- <a href="del.php?id=<?= $data['id_pasien'] ?>" onclick="return confirm('Yakin Akan Menghapus Data?')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a> -->
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
        </table>


    </div>
    <!-- <script>
        $(document).ready(function() {
            $('#pasien').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "pasien_data.php",
                scrollY: '250px',
                dom: 'Bfrtip',
                buttons: [{
                        extend: 'pdf',
                        orientation: 'potrait',
                        pageSize: 'Legal',
                        title: 'Data Pasien',
                        download: 'open'
                    },
                    'csv', 'excel', 'print', 'copy'
                ],
                columnDefs: [{
                    "searchable": false,
                    "orderable": false,
                    "targets": 8,
                    "render": function(data, type, row) {
                        var btn = "<center><a href=\"edit.php?id_pasien=" + row.id_pasien + "\" class=\"btn btn-warning btn-xs\"><i class=\"glyphicon glyphicon-edit\"></i></a> <a href=\"del.php?id=" + row.id + "\" onclick=\"return confirm('Yakin menghapus data?')\" class=\"btn btn-danger btn-xs\"><i class=\"glyphicon glyphicon-trash\"></i></a></center>";
                        return btn;
                    }
                }]
            });
        });
    </script> -->
</div>

<?php include_once('../_footer.php'); ?>