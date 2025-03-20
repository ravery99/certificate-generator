<?php

use App\Config\Config;

$form_action = Config::BASE_URL . "/facilities/$id";
$placeholder = "Masukkan nama fasilitas";
$name_label = "Nama Fasilitas";
$value = $facility_name;


include(__DIR__ . '/../partials/dropdown_form.php');
