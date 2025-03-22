<?php

use App\Config\Config;

$form_action = Config::BASE_URL . "/login";
$button_text = "Masuk";

include(__DIR__ . '/../partials/user_form.php');
