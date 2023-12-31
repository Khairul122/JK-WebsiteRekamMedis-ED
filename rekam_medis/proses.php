<?php
require_once "../_config/config.php";
require  "../_assets/libs/vendor/autoload.php";

use Ramsey\Uuid\uuid;
use Ramsey\Uuid\Exception\UnsatisFiedDependencyException;

if (isset($_POST['add'])) {
    $pasienId = trim(mysqli_real_escape_string($con, $_POST['pasien']));
    $keluhan = trim(mysqli_real_escape_string($con, $_POST['keluhan']));
    $dokterId = trim(mysqli_real_escape_string($con, $_POST['dokter']));
    $diagnosa = trim(mysqli_real_escape_string($con, $_POST['diagnosa']));
    $poliId = trim(mysqli_real_escape_string($con, $_POST['poli']));
    $tgl = trim(mysqli_real_escape_string($con, $_POST['tgl']));

    // Mendapatkan nama dokter berdasarkan id_dokter
    $resultDokter = mysqli_query($con, "SELECT nama_dokter, keterangan FROM tb_dokter WHERE id_dokter = '$dokterId'");
    $rowDokter = mysqli_fetch_assoc($resultDokter);
    $namaDokter = $rowDokter['nama_dokter'];
    $keteranganDokter = $rowDokter['keterangan'] + 1; // Tambah 1 untuk setiap pemilihan dokter baru

    $obat = $_POST['obat'];

    // Mendapatkan informasi obat pertama dari form (jika ada)
    $resultObat = mysqli_query($con, "SELECT * FROM tb_obat WHERE id_obat = '$obat[0]'");
    $rowObat = mysqli_fetch_assoc($resultObat);
    $idObat = $rowObat['id_obat'];
    $namaObat = $rowObat['nama_obat'];

    // Mendapatkan nama pasien berdasarkan id_pasien
    $resultPasien = mysqli_query($con, "SELECT nama_pasien FROM tb_pasien WHERE id_pasien = '$pasienId'");
    $rowPasien = mysqli_fetch_assoc($resultPasien);
    $namaPasien = $rowPasien['nama_pasien'];

    // Mendapatkan nama poliklinik berdasarkan id_poli
    $resultPoli = mysqli_query($con, "SELECT nama_poli FROM tb_poliklinik WHERE id_poli = '$poliId'");
    $rowPoli = mysqli_fetch_assoc($resultPoli);
    $namaPoli = $rowPoli['nama_poli'];

    mysqli_query($con, "INSERT INTO tb_rekammedis (id_pasien, nama_pasien, keluhan, id_dokter, nama_dokter, diagnosa, id_poli, nama_poli, tgl_periksa, id_obat, nama_obat) VALUES ('$pasienId', '$namaPasien', '$keluhan', '$dokterId', '$namaDokter', '$diagnosa', '$poliId', '$namaPoli', '$tgl', '$idObat', '$namaObat')") or die(mysqli_error($con));

    mysqli_query($con, "UPDATE tb_dokter SET keterangan = '$keteranganDokter' WHERE id_dokter = '$dokterId'") or die(mysqli_error($con));

    mysqli_query($con, "UPDATE tb_obat SET jml_obat = jml_obat - 1 WHERE id_obat = '$idObat'") or die(mysqli_error($con));

    // Menambah jumlah pasien pada tb_poliklinik
    mysqli_query($con, "UPDATE tb_poliklinik SET jumlah_pasien = jumlah_pasien + 1 WHERE id_poli = '$poliId'") or die(mysqli_error($con));

    echo "<script>window.location='data.php';</script>";
}
else if (isset($_POST['edit'])) {
    $id_rm = trim(mysqli_real_escape_string($con, $_POST['id_rm']));
    $keluhan = trim(mysqli_real_escape_string($con, $_POST['keluhan']));
    $diagnosa = trim(mysqli_real_escape_string($con, $_POST['diagnosa']));
    $id_obat = trim(mysqli_real_escape_string($con, $_POST['obat']));
    $tgl = trim(mysqli_real_escape_string($con, $_POST['tgl']));

    // Ambil informasi obat berdasarkan id_obat
    $resultObat = mysqli_query($con, "SELECT * FROM tb_obat WHERE id_obat = '$id_obat'");
    $rowObat = mysqli_fetch_assoc($resultObat);

    // Perbarui data rekam medis
    mysqli_query($con, "UPDATE tb_rekammedis SET keluhan = '$keluhan', diagnosa = '$diagnosa', id_obat = '$id_obat', nama_obat = '" . $rowObat['nama_obat'] . "', tgl_periksa = '$tgl' WHERE id_rm = '$id_rm'") or die(mysqli_error($con));

    // Tambahkan kode lain yang diperlukan, seperti mengupdate jumlah obat, dll.

    echo "<script>alert('Data berhasil diupdate.'); window.location='data.php';</script>";
}

