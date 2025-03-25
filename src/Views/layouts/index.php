<?php

require_once __DIR__ . "/../components/pageTitleCard.php";
require_once __DIR__ . "/../components/createButton.php";
// require_once __DIR__ . "/../components/deleteButton.php";
require_once __DIR__ . "/../components/actionButton.php";
// require_once __DIR__ . "/../components/table.php";
require_once __DIR__ . "/../components/searchBar.php";

?>

<div class="flex flex-col h-full space-y-4">
    <!-- <h1 class="text-3xl font-bold text-gray-700">
        <?=
            $page_title
            ?>
    </h1> -->

    <!-- testing, mending yg atas atau bawah? -->
    <?php
    pageTitleCard($page_title);
    ?>


<div>
    <div class="hidden">
            bg-gradient-to-b from-green-500 to-emerald-400
            bg-gradient-to-b from-red-500 to-rose-400
            text-green-600
            text-red-600
        </div>
        
        <?php require_once __DIR__ . "/../partials/flash_message.php"; ?>
    </div>
    
    <div class="flex flex-col overflow-hidden rounded-lg shadow-lg bg-white p-3 mt-0 space-y-4">

        <div class="flex flex-row items-center space-x-6">
            <div class="flex w-full">
                <?php searchBar($search_link, $search_bar_placeholder);
                ?>
            </div>
            
            <?php if (isset($create_link)): ?>
                <div class="flex h-full">
                    <?php
                    actionButton('add', $create_link, 'green', $button_text);
                    ?>
                </div>
            <?php endif ?>
        </div>

        <div class="flex h-full overflow-x-auto" id="table">
            <?php require_once __DIR__ . "$table_path.php"; ?>
        </div>



    </div>

</div>