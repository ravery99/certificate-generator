<?php

require_once __DIR__ . "/../components/createButton.php";
require_once __DIR__ . "/../components/deleteButton.php";
require_once __DIR__ . "/../components/actionButton.php";
require_once __DIR__ . "/../components/table.php";

?>

<!-- Content Area -->
<div class="flex flex-col overflow-y-auto h-full gap-5">
    <h1 class="text-3xl font-bold text-gray-700">
        <?= $page_title ?>
    </h1>

    <div>
        <?php createButton('Divisi', '/divisions/create') ?>
    </div>

    <div class="overflow-hidden rounded-lg shadow-lg bg-white p-6">

        <?php

        table('divisi', ['ID', 'Nama Divisi'], $divisions, function ($division) {
            return
                actionButton('edit', "/divisions/" . $division['id'] . "/edit", 'orange') .
                deleteButton('divisi', "/divisions/" . $division['id']);
        });
        ?>

    </div>

</div>