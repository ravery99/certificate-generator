<?php

use App\Config\Config;

$form_action = Config::BASE_URL . "/register";
$button_text = "Daftar";

include(__DIR__ . '/../partials/user_form.php');
