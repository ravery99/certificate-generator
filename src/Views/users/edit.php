<?php

use App\Config\Config;

$form_action = Config::BASE_URL . "/users/$id";
$button_text = "Simpan Perubahan";
$id = $id;
$username = $username;

include(__DIR__ . '/../partials/user_form.php');
