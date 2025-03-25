<?php

use App\Config\Config; ?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> <?= $page_title ?? '' ?> </title>
    <link href="<?= Config::BASE_URL ?>/../output.css" rel="stylesheet">
</head>

<body class="flex justify-center items-center h-screen md:p-6 overscroll-none bg-gray-100 ">

    <?php require_once "../src/Views/$view_path.php"; ?>

</body>

</html>