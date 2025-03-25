<?php

function pageTitleCard(string $page_title)
{ ?>
    <div class="flex items-center justify-between bg-white border-b border-gray-200 p-5 shadow-md rounded-lg">
        <h1 class="text-2xl font-semibold text-green-700 capitalize">
            <?= $page_title ?>
        </h1>
    </div>
<?php } ?>






