<?php

use App\Config\Config;

$form_action = Config::BASE_URL . "/divisions/$id";
$placeholder = "Masukkan nama divisi";
$name_label = "Nama Divisi";
$value = $division_name;

include(__DIR__ . '/../partials/division_facility_form.php');
?>