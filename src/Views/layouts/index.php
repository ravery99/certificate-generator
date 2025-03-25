<?php

require_once __DIR__ . "/../components/pageTitleCard.php";
require_once __DIR__ . "/../components/createButton.php";
// require_once __DIR__ . "/../components/deleteButton.php";
// require_once __DIR__ . "/../components/actionButton.php";
// require_once __DIR__ . "/../components/table.php";
require_once __DIR__ . "/../components/searchBar.php";

?>

<div class="flex flex-col h-full space-y-6">
    <!-- <h1 class="text-3xl font-bold text-gray-700">
        <?=
        $page_title
        ?>
    </h1> -->

    <!-- testing, mending yg atas atau bawah? -->
    <?php
    pageTitleCard($page_title);
    ?>

    <?php if (isset($create_link)): ?>
        <div class="w-full sm:w-fit">
            <?php createButton($table_name, $create_link) ?>
        </div>
    <?php endif ?>

    <div>
        <div class="hidden">
            bg-red-100
            bg-green-100
        </div>
        <?php
        include __DIR__ . "/../partials/flash_message.php";
        ?>
    </div>
    <div class="flex flex-col overflow-hidden rounded-lg shadow-lg bg-white p-6 mt-10 space-y-6">

        <div class="flex flex-row items-center space-x-6">
            <div class="flex w-full">
                <?php searchBar($search_link, $search_bar_placeholder);
                ?>
            </div>

            <!-- barangkali ada tombol di sebelah kanan search bar -->
            <!-- buat div baru disini -->
        </div>

        <div class="flex h-full overflow-x-auto" id="table">
            <?php require_once __DIR__ . "$table_path.php"; ?>
        </div>

    </div>

</div>