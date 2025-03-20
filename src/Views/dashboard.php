<?php

require_once __DIR__ . "../components/pageTitleCard.php";
require_once __DIR__ . "../components/statsCard.php";

?>

<div class="flex flex-col overflow-y-auto h-full">

    <?php
    pageTitleCard('beranda');
    ?>

    <!-- Card Welcome -->
    <div class="bg-gradient-to-r from-green-400 to-green-600 p-6 rounded-lg shadow-md mt-6 text-white">
        <h2 class="text-2xl font-bold">Selamat datang, <?= $_SESSION['user']['username'] ?>! 🎉</h2>
        <p class="mt-2">Kelola data user, partisipan, dan sertifikat dengan mudah di dashboard ini.</p>
    </div>

    <!-- Card Statistik -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">

        <div class="hidden">
            border-green-500 text-green-500 text-green-700
            border-yellow-500 text-yellow-500 text-yellow-700
            border-blue-500 text-blue-500 text-blue-700
        </div>

        <?php

        statsCard('Admin', $data["total_users"], 'group', 'green');
        statsCard('Peserta', $data["total_participants"], 'groups', 'yellow');
        statsCard('Sertifikat', $data["total_certificates"], 'history_edu', 'blue');

        ?>

    </div>
</div>