<?php

use App\Config\Config;

$form_action = Config::BASE_URL . "/divisions";
$placeholder = "Masukkan nama divisi";
$name_label = "Nama Divisi";
$button_text = "Simpan Divisi";

include(__DIR__ . '/../partials/division_facility_form.php');
?>

