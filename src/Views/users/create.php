<?php

use App\Config\Config;

$form_action = Config::BASE_URL . "/users";
$button_text = "Tambah Admin";

include(__DIR__ . '/../partials/user_form.php');
