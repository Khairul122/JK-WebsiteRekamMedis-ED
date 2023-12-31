<?php
require_once "../_config/config.php";
require  "../_assets/libs/vendor/autoload.php";

use Ramsey\Uuid\uuid;
use Ramsey\Uuid\Exception\UnsatisFiedDependencyException;

if (isset($_POST['add'])) {  
    $total = $_POST['total'];

    for ($i = 1; $i <= $total; $i++) { 
        // Remove the $uuid variable as id_poli is now auto-incremented
        $nama = trim(mysqli_real_escape_string($con, $_POST['nama-' . $i]));
        $gedung = trim(mysqli_real_escape_string($con, $_POST['gedung-' . $i]));

        $sql = mysqli_query($con, "INSERT INTO tb_poliklinik (nama_poli, gedung) VALUES ('$nama', '$gedung')") or die(mysqli_error($con));
    }
    
    if ($sql) {
        echo "<script>alert('" . $total . " data berhasil ditambahkan'); window.location='data.php';</script>";
    } else {
        echo "<script>alert('Gagal tambah data, coba lagi'); window.location='generate.php';</script>";
    }  
}
 else if(isset($_POST['edit'])) {
    for ($i=0; $i<count($_POST['id']); $i++) { 
        $id = $_POST['id'][$i];
        $nama = $_POST['nama'][$i];
        $gedung =  $_POST['gedung'][$i];
        mysqli_query($con, "UPDATE tb_poliklinik SET nama_poli = '$nama', gedung = '$gedung' WHERE id_poli='$id'") or die (mysqli_error($con));
    }
    echo "<script>alert('Data Berhasil Di update'); window.location='data.php';</script>";
}
?>