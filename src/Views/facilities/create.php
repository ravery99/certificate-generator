<!-- formnya panggil file /Views/partials/ -->

<?php
use App\Config\Config;
?>







<?php
$title = "Formulir Tambah Fasilitas Baru";
$placeholder = "Masukkan nama fasilitas";
$nameInput = "nama_fasilitas"; // Harus pakai underscore, bukan spasi
$submitText = "Simpan Fasilitas";
$formAction = Config::BASE_URL . "/facilities";
$isFacility = true;


include(__DIR__ . '/../partials/dropdown_form.php');
?>