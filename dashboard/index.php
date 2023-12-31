<?php include_once('../_header.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Dashboard</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="../plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="../plugins/summernote/summernote-bs4.min.css">
</head>

<body>
    <div class="row">
        <div class="col-lg-12">
            <h1>Dashboard</h1>
            <p>Selamat Datang <mark><?= $_SESSION['user']; ?></mark> di website Rumah Sakit (Rekam Medis)</p>

            
        </div>

        <div class="col-lg-3 col-6">
    <?php
    // Query untuk mendapatkan data nama poliklinik dan jumlah pasien
    $sql_poli_info = mysqli_query($con, "SELECT nama_poli, jumlah_pasien FROM tb_poliklinik") or die(mysqli_error($con));
    
    // Loop untuk menampilkan data pada kotak informasi
    while ($data_poli = mysqli_fetch_array($sql_poli_info)) {
    ?>
        <div class="small-box bg-info">
            <div class="inner">
                <h3 style="font-size: 30px;"><?= $data_poli['nama_poli'] ?></h3>
                <p style="font-size: 20px;">Jumlah Pasien = <?= $data_poli['jumlah_pasien'] ?> </p>
            </div>
        </div>
    <?php
    }
    ?>
</div>


        <?php include_once('../_footer.php'); ?>
</body>

</html>