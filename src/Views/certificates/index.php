<?php

use App\Config\Config;

require_once __DIR__ . "/../components/deleteButton.php";
require_once __DIR__ . "/../components/actionButton.php";
require_once __DIR__ . "/../components/table.php";

?>


<div class="overflow-y-auto  bg-gray-100">
    <h1 class="text-3xl font-bold text-gray-700">
        <?= $page_title ?>
    </h1>
    
    <div class="overflow-hidden rounded-lg shadow-lg bg-white p-4 mt-6">
        <!-- Load warna komponen button lihat sertifikat  -->
        <div class="hidden">
            bg-blue-300 hover:bg-blue-500
            text-blue-700
        </div>

        <?php

        table(
            'sertifikat',
            ['Nama Sertifikat'],
            $certificates,
            function ($certificate) {
                return
                    actionButton('visibility', $certificate['certificate_link'], 'blue') .
                    deleteButton('sertifikat', "/certificates/" . $certificate['participant_id']);
            },
            ['participant_id', 'certificate_link'],
        );
        ?>

    </div>
</div>