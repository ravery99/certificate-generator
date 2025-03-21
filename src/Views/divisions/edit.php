<?php
use App\Config\Config;
?>

<?php


$title = "Edit Divisi";
$formAction = Config::BASE_URL . "/divisions/$id";
$nameInput = "nama_divisi";
$placeholder = "Masukkan nama divisi";
$submitText = "Update Divisi";
$divisiValue = 'nama_divisi'; // Ambil nama divisi dari database
$isFacility = false;

include(__DIR__ . '/../partials/division_facility_form.php');
?>