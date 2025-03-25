<?php

use App\Config\Config; ?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $page_title ?></title>
    <link href="<?= Config::BASE_URL ?>/../output.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL,GRAD@400,0,0">
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body class="overscroll-none bg-gradient-to-b from-[#071952] to-[#0B666A]" x-data="{ sidebarOpen: false }">

    <div class="flex flex-row">

        <div x-show=" sidebarOpen" class="fixed inset-0 bg-opacity-50 z-10 xl:hidden" @click="sidebarOpen = false">
        </div>

        <!-- Sidebar -->
        <div class="fixed xl:w-1/4 xl:flex h-screen shadow-md transition-transform duration-300 ease-out xl:translate-x-0 z-50 "
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full xl:translate-x-0'">
            <?php require_once __DIR__ . '../../partials/sidebar.php'; ?>
        </div>

        <!-- Konten utama -->
        <div class="xl:ml-[25%] flex flex-col min-h-screen w-full overflow-hidden">

            <!-- Navbar -->
            <div class="sticky top-0">
                <?php require_once __DIR__ . '../../partials/navbar.php'; ?>
            </div>

            <!-- View -->
            <div class="h-full p-6 sm:p-12 bg-gray-100">
                <?php require_once "../src/Views/$view_path.php"; ?>
            </div>

        </div>
    </div>

    <?php require_once __DIR__ . '/../partials/modal.php'; ?>

</body>

</html>