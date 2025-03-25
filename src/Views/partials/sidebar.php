<?php

require_once __DIR__ . "/../components/sidebarItem.php";

?>

<div class="h-screen w-full bg-gradient-to-b from-[#071952] to-[#0B666A] flex flex-col overflow-auto px-3">

    <div class="flex items-center justify-center p-4">
        <span class="text-white font-bold uppercase tracking-wide text-lg">logo trustmedis</span>
    </div>

    <div class=" h-full overflow-y-auto flex flex-col">

        <!-- Load warna tailwind komponen sidebarItem -->
        <div class="hidden">
            bg-green-400 hover:bg-green-400
            bg-red-500 hover:bg-red-500
            text-black hover:text-black
            text-white hover:text-white
        </div>

        <nav class="p-4 space-y-3">

            <?php

            sidebarItem('Beranda', '/dashboard', 'home');
            sidebarItem('Manajemen Admin', '/users', 'person');
            sidebarItem('Manajemen Peserta', '/participants', 'badge');
            sidebarItem('Manajemen Sertifikat', '/certificates', 'clinical_notes');
            sidebarItem('Manajemen Divisi', '/divisions', 'work');
            sidebarItem('Manajemen Fasilitas', '/facilities', 'local_hospital');

            ?>

        </nav>


        <nav class="mt-auto p-4" id="logout-btn">
            <?php
            sidebarItem('Keluar', '/logout', 'logout', 'bg-red-500', 'text-white');
            ?>
        </nav>



    </div>



</div>