<!-- 
    ini keknya ga perlu dipake lagi
    udah ada action button soalnya
    cuma kalo gitu berarti, posisi tombol create ini diatur ulang lagi
    gajadi diatas kiri tabel
    -->

<?php

use App\Config\Config;

function createButton(string $table_name, string $link)
{

?>
    <a href="<?= Config::BASE_URL . $link ?>"
        class="flex items-center justify-center gap-2 px-4 py-2 max-w-fit bg-gradient-to-r from-green-600 to-blue-950
                text-white rounded-md hover:opacity-90 transition duration-300 text-sm capitalize
                active:bg-green-800 font-semibold shadow-md">

        <span class="material-symbols-outlined">
            add
        </span>
        Tambah <?= ucfirst($table_name) ?>
    </a>

<?php } ?>