<?php

require_once __DIR__ . "/../components/createButton.php";
require_once __DIR__ . "/../components/actionButton.php";
require_once __DIR__ . "/../components/deleteButton.php";
require_once __DIR__ . "/../components/table.php";

?>

<div class=" bg-gray-100  space-y-6">
    <h1 class="text-3xl font-bold text-gray-700">
        <?=
        $page_title
        ?>
    </h1>

    <div class="w-fit">
        <?php
        createButton('Peserta', '/participants/create');
        ?>
    </div>


    <div class="overflow-x-auto rounded-lg shadow-lg bg-white p-6 mt-10 space-y-6">

        <!-- 
            ini testing doang
            kalo create buttonnya mau pake komponen actionButton() 
        -->
        <div class="flex justify-end">

            <?php
            actionButton('add', '/participants/create', 'green', 'buat sertifikat');
            ?>

        </div>

        <?php

        table(
            'peserta',
            [
                'ID',
                'Email',
                'Tanggal Pelatihan',
                'Nama Peserta',
                'Nomor HP',
                'Divisi',
                'Fasilitas',
            ],
            $participants,
            function ($participant) {
                return
                    deleteButton('peserta', "/participants/" . $participant['id']);
            },
            ['facility_id', 'division_id']
        );
        ?>

    </div>
</div>