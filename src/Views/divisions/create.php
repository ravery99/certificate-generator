<!-- formnya panggil file /Views/partials/ -->

<?php
use App\Config\Config;
?>


<?php

$title = "Tambah Divisi Baru";
$placeholder = "Masukkan nama divisi";
$nameInput = "nama_Divisi";
$submitText = "Simpan Divisi";
$formAction = Config::BASE_URL . "/divisions";
$isFacility = false;


include(__DIR__ . '/../partials/division_facility_form.php');
?>

