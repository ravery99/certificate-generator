<?php
use App\Config\Config;
?>

<?php

// Set variabel untuk form.php
$title = "Edit Fasilitas";
$formAction = Config::BASE_URL . "/facilities/$id";      
$nameInput = "nama_fasilitas";
$placeholder = "Masukkan nama fasilitas";
$submitText = "Update Fasilitas";
$divisiValue = 'nama_fasilitas'; 
$isFacility = true; 

include(__DIR__ . '/../partials/division_facility_form.php');
?>





