<?php

use App\Config\Config;

$form_action = Config::BASE_URL . "/facilities";
$placeholder = "Masukkan nama fasilitas";
$name_label = "Nama Fasilitas";
$button_text = "Simpan Fasilitas";

include(__DIR__ . '/../partials/division_facility_form.php');
?>