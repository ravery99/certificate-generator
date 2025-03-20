<?php

require_once __DIR__ . "/../components/pageTitleCard.php";
require_once __DIR__ . "/../components/createButton.php";
require_once __DIR__ . "/../components/deleteButton.php";
require_once __DIR__ . "/../components/actionButton.php";
require_once __DIR__ . "/../components/table.php";

?>

<!-- Content Area -->
<div class=" grow overflow-y-auto  bg-gray-100  space-y-6">

    <!-- testing, mending yg mana? -->
    <?php
    pageTitleCard($page_title);
    ?>

    <!-- Tombol Tambah Admin -->
    <div class="w-fit">
        <?php
        createButton('admin', '/users/create');
        ?>
    </div>


    <!-- Tabel Admin -->
    <div class="overflow-hidden rounded-lg shadow-lg bg-white p-4 mt-6 space-y-6">

        <!--
            ini testing doang
            kalo create buttonnya mau pake komponen actionButton() 
        -->
        <div class="flex justify-end">
            <!-- Load warna komponen button create di output.css-->
            <div class="hidden">
                bg-green-300 hover:bg-green-500
                text-green-700
                text-green-900
            </div>
            <?php
            actionButton('add', '/users/create', 'green', 'Tambah Admin');
            ?>
        </div>


        <?php
        table('admin', ['ID', 'Nama Pengguna'], $users, function ($user) {
            return
                actionButton('edit', "/users/" . $user['id'] . "/edit", 'orange') .
                deleteButton('admin', "/users/" . $user['id']);
        });
        ?>

    </div>
</div>