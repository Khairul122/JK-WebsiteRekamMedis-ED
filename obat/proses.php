<?php
require_once "../_config/config.php";
require  "../_assets/libs/vendor/autoload.php";

use Ramsey\Uuid\uuid;
use Ramsey\Uuid\Exception\UnsatisFiedDependencyException;

if(isset($_POST['add'])) {  
    $uuid = Uuid::uuid4()->toString();
    $nama = isset($_POST['nama']) ? trim(mysqli_real_escape_string($con, $_POST['nama'])) : '';
    $ket = isset($_POST['ket']) ? trim(mysqli_real_escape_string($con, $_POST['ket'])) : '';
    $jml_obat = isset($_POST['jml_obat']) ? trim(mysqli_real_escape_string($con, $_POST['jml_obat'])) : '';
    $hrg_obat = isset($_POST['hrg_obat']) ? trim(mysqli_real_escape_string($con, $_POST['hrg_obat'])) : '';
    
    mysqli_query($con, "INSERT INTO tb_obat (id_obat, nama_obat, ket, jml_obat, hrg_obat) 
        VALUES ('$uuid', '$nama', '$ket', '$jml_obat', '$hrg_obat')") or die(mysqli_error($con));

    echo "<script>window.location='data.php';</script>";
}
else if(isset($_POST['edit'])) {
    $id = $_POST['id'];
    $nama = trim(mysqli_real_escape_string($con, $_POST['nama']));
    $ket = trim(mysqli_real_escape_string($con, $_POST['ket']));
    $jml_obat = trim(mysqli_real_escape_string($con, $_POST['jml_obat']));
    $hrg_obat = trim(mysqli_real_escape_string($con, $_POST['hrg_obat']));
    
    mysqli_query($con, "UPDATE tb_obat SET nama_obat = '$nama', ket = '$ket', jml_obat = '$jml_obat', hrg_obat = '$hrg_obat' WHERE id_obat = '$id'") or die (mysqli_error($con));
    echo "<script>alert('Data berhasil diupdate'); window.location='data.php';</script>";
}

?>