<!-- formnya panggil file /Views/partials/ -->

<?php
use App\Config\Config;
?>







<?php
$title = "Formulir Tambah Fasilitas Baru";
$placeholder = "Masukkan nama fasilitas";
$nameInput = "nama_fasilitas";
$submitText = "Simpan Fasilitas";
$formAction = Config::BASE_URL . "/facilities";
$isFacility = true;


include(__DIR__ . '/../partials/division_facility_form.php');
?>