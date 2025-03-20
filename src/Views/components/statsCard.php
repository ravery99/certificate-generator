<?php

function statsCard(string $table_name, string $total, string $icon, string $color)
{ ?>
    <div
        class="bg-white p-6 rounded-lg shadow-md flex items-center justify-between border-l-8 border-<?= $color ?>-500">
        <div>
            <h3 class="text-lg font-semibold text-gray-700 capitalize">Jumlah <?= $table_name ?></h3>
            <p class="text-3xl font-bold text-<?= $color ?>-700">
                <?= $total ?>
            </p>
        </div>
        <div class="text-<?= $color ?>-500">
            <span class="material-symbols-outlined !text-5xl">
                <?= $icon ?>
            </span>
        </div>
    </div>
<?php } ?>