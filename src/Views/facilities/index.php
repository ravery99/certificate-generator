<?php

use App\Config\Config;

require_once __DIR__ . "/../components/createButton.php";
require_once __DIR__ . "/../components/deleteButton.php";
require_once __DIR__ . "/../components/actionButton.php";
require_once __DIR__ . "/../components/table.php";

?>

<div class="flex flex-col overflow-y-auto h-full gap-5">
    <h1 class="text-3xl font-bold text-gray-700">
        <?= $page_title ?>
    </h1>


    <div>
        <?php createButton('Fasilitas', '/facilities/create') ?>
    </div>

    <div class="overflow-hidden rounded-lg shadow-lg bg-white p-6 mt-6">

        <!-- Load warna komponen button edit di output.css-->
        <div class="hidden">
            bg-orange-300 hover:bg-orange-500
            text-orange-700
        </div>

        <?php
        table('fasilitas', ['ID', 'Nama Fasilitas'], $facilities, function ($facility) {
            return
                actionButton('edit', "/facilities/" . $facility['id'] . "/edit", 'orange') .
                deleteButton('fasilitas', "/facilities/" . $facility['id']);
        });
        ?>

    </div>
</div>