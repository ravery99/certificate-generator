<?php

require_once __DIR__ . "/../components/pageTitleCard.php";
require_once __DIR__ . "/../components/statsCard.php";
require_once __DIR__ . "/../components/searchBar.php";
require_once __DIR__ . "/../components/actionButton.php";

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

    <div class="flex flex-col overflow-hidden rounded-lg shadow-lg bg-white p-6 mt-10 space-y-6 h-full">
        <div class="flex flex-row items-center space-x-6">
            <div class="flex w-full">
                <?php searchBar('/dashboard/search', 'Cari peserta berdasarkan ID, nama, email, atau nomor HP...',);
                ?>
            </div>

            <!-- 
                dibawah ini testing doang
                kalo seandainya tambah buttonnya mau pake komponen actionButton(), bukan yang createButton()
            -->

            <div class="hidden">
                <!-- Load warna komponen button create di output.css-->
                bg-green-300 hover:bg-green-500
                text-green-700
                text-green-900

                <!-- Load warna komponen button lihat sertifikat yang di table -->
                bg-blue-300 hover:bg-blue-500
                text-blue-700

                <!-- Load warna komponen button edit di table admin, divisi, fasilitas -->
                bg-orange-300 hover:bg-orange-500
                text-orange-700
            </div>
            <div class="flex h-full">
                <?php
                actionButton('add', '/participants/create', 'green', 'Buat Sertifikat');
                ?>
            </div>
        </div>

        <div class="flex h-full overflow-x-auto" id="table">
            <?php require_once __DIR__ . '/table.php'; ?>
        </div>

    </div>
</div>