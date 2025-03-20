<?php

use App\Config\Config;

function deleteButton(string $table_name, string $link)
{

?>
    <form
        action='<?= Config::BASE_URL . $link ?>'
        method='POST'
        onsubmit='return confirm("Apakah Anda yakin ingin menghapus <?= $table_name ?> ini?");'
        class="flex h-full">

        <input type="hidden" name="_method" value="DELETE">

        <button type='submit'
            class='bg-red-300 text-red-700 px-4 py-2 rounded-md hover:bg-red-500 hover:text-white shadow-md cursor-pointer flex items-center '>

            <span class="material-symbols-outlined">
                delete
            </span>

        </button>

    </form>

<?php } ?>